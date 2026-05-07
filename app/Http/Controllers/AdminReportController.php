<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Merchant;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    // ================= PRODUK =================
    public function produk()
    {
        $categories = Category::withCount('products')->get();
        $totalProduk = Product::count();

        return view('admin.reports.produk', compact('categories','totalProduk'));
    }

    // ================= MERCHANT =================
    public function merchant(Request $request)
{
    $query = Merchant::withCount('products');

    // SEARCH
    if ($request->search) {
        $query->where('store_name','like','%'.$request->search.'%');
    }

    // FILTER
    if ($request->merchant_id) {
        $query->where('id', $request->merchant_id);
    }

    if ($request->from && $request->to) {
        $query->whereBetween('created_at', [$request->from, $request->to]);
    }

    $merchants = $query->orderByDesc('products_count')->paginate(5);
    $totalMerchant = $query->count();

    $topMerchants = Merchant::withCount('products')
        ->orderByDesc('products_count')
        ->take(5)
        ->get();

    $allMerchants = Merchant::all();

    return view('admin.reports.merchant', compact(
        'merchants',
        'totalMerchant',
        'topMerchants',
        'allMerchants'
    ));
    }

    // ================= EXPORT MERCHANT =================
    public function exportMerchantCsv(Request $request)
    {
        $query = Merchant::withCount('products');

        if ($request->merchant_id) {
            $query->where('id', $request->merchant_id);
        }

        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $merchants = $query->get();

        return response()->streamDownload(function () use ($merchants) {

            echo "Nama Toko,Status,Total Produk\n";

            foreach ($merchants as $m) {
                $status = $m->is_verified ? 'Verified' : 'Pending';
                echo "{$m->store_name},{$status},{$m->products_count}\n";
            }

        }, "laporan_merchant.csv");
    }

    public function exportMerchantPdf(Request $request)
    {
        $query = Merchant::withCount('products');

        if ($request->merchant_id) {
            $query->where('id', $request->merchant_id);
        }

        if ($request->from && $request->to) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $merchants = $query->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'admin.reports.merchant_pdf',
            compact('merchants')
        );

        return $pdf->download('laporan_merchant.pdf');
    }

    // ================= STATISTIK =================
    public function statistik()
    {
        return view('admin.reports.statistik', [
            'totalProduk' => Product::count(),
            'totalKategori' => Category::count(),
            'totalMerchant' => Merchant::count(),
        ]);
    }

    // ================= "PENJUALAN" (VERSI WA) =================
    public function penjualan()
    {
        $products = Product::with(['merchant','category'])
            ->latest()
            ->get();

        $totalProduk = $products->count();

        // ambil top produk (misal berdasarkan harga dulu)
        $topProducts = $products->sortByDesc('price')->take(5);

        return view('admin.reports.penjualan', compact(
            'products',
            'totalProduk',
            'topProducts'
        ));
    }

    // ================= EXPORT PRODUK =================
    public function exportPenjualanCsv()
    {
        $products = Product::with(['merchant','category'])->get();

        return response()->streamDownload(function () use ($products) {

            echo "Produk,Merchant,Kategori,Harga\n";

            foreach ($products as $p) {
                $merchant = $p->merchant->store_name ?? '-';
                $category = $p->category->name ?? '-';

                echo "{$p->name},{$merchant},{$category},{$p->price}\n";
            }

        }, "laporan_produk.csv");
    }

    public function exportPenjualanPdf()
    {
        $products = Product::with(['merchant','category'])->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            'admin.reports.penjualan_pdf',
            compact('products')
        );

        return $pdf->download('laporan_produk.pdf');
    }
}