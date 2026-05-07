<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'users' => User::count(),
            'merchants' => Merchant::count(),
            'products' => Product::count(),
        ]);
    }

    // ================= USERS =================

    public function users(Request $request)
    {
        $query = User::query();

        // 🔍 SEARCH (dibungkus biar tidak bentrok OR)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name','like','%'.$request->search.'%')
                  ->orWhere('email','like','%'.$request->search.'%');
            });
        }

        // 🎯 FILTER ROLE
        if ($request->role) {
            $query->where('role',$request->role);
        }

        // 🔥 LIMIT (INI YANG KAMU MINTA)
        $limit = $request->limit ?? 5;

        $users = $query->latest()->paginate($limit);

        return view('admin.users', compact('users'));
    }

    public function updateRole($id, Request $request)
    {
        $user = User::findOrFail($id);

        $user->update([
            'role' => strtolower($request->role)
        ]);

        return back()->with('success','Role diupdate');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'role'=>'required'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>strtolower($request->role)
        ]);

        return back()->with('success','User ditambahkan');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id == auth()->id()) {
            return back()->with('error','Tidak bisa hapus diri sendiri');
        }

        $user->delete();

        return back()->with('success','User dihapus');
    }

    // ================= MERCHANT =================

    public function merchants(Request $request)
    {
        $query = Merchant::with('user');

        // SEARCH
        if ($request->search) {
            $query->where('store_name', 'like', '%'.$request->search.'%');
        }

        // FILTER STATUS
        if ($request->status !== null && $request->status !== '') {
            $query->where('is_verified', $request->status);
        }

        // 🔥 LIMIT (BIAR KONSISTEN)
        $limit = $request->limit ?? 5;

        $merchants = $query->latest()->paginate($limit);

        return view('admin.merchants', compact('merchants'));
    }

    public function verify($id)
    {
        $merchant = Merchant::find($id);

        if (!$merchant) {
            return back()->with('error','Merchant tidak ditemukan');
        }

        $merchant->is_verified = 1;
        $merchant->save();

        return back()->with('success','Merchant berhasil diverifikasi');
    }

    public function destroyMerchant($id)
    {
        $merchant = Merchant::findOrFail($id);

        $merchant->products()->delete();
        $merchant->delete();

        return back()->with('success','Merchant dihapus');
    }

    // ================= REPORT =================

    public function reportProduk()
    {
        $categories = Category::withCount('products')->get();
        $totalProduk = Product::count();

        return view('admin.reports.produk', compact('categories','totalProduk'));
    }

    public function reportMerchant()
    {
        $merchants = Merchant::withCount('products')
            ->orderByDesc('products_count')
            ->get();

        return view('admin.reports.merchant', compact('merchants'));
    }

    public function reportPenjualan()
    {
        $products = Product::with(['merchant','category'])->latest()->get();

        return view('admin.reports.penjualan', compact('products'));
    }

    public function statistik()
    {
        return view('admin.reports.statistik', [
            'totalProduk'=>Product::count(),
            'totalKategori'=>Category::count(),
            'totalMerchant'=>Merchant::count(),
        ]);
    }
}