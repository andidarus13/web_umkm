<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ProductController extends Controller
{
    // 🔥 helper biar gak ulang2
    private function getMerchant()
    {
        $merchant = auth()->user()->merchant;

        if (!$merchant) {
            abort(redirect('/merchant/store')
                ->with('error','Isi data toko dulu'));
        }

        return $merchant;
    }

    public function index()
    {
        $merchant = auth()->user()->merchant;

        if (!$merchant) {
            return redirect('/merchant/store')
                ->with('error','Silakan isi data toko dulu');
        }

        $products = $merchant->products()->with('category')->latest()->get();

        return view('merchant.products.index', compact('products'));
    }

    public function create()
    {
        $merchant = auth()->user()->merchant;

        if (!$merchant) {
            return redirect('/merchant/store')
                ->with('error','Isi data toko dulu');
        }

        $categories = Category::all();
        return view('merchant.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $merchant = auth()->user()->merchant;

        if (!$merchant) {
            return redirect('/merchant/store')
                ->with('error','Isi data toko dulu');
        }

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $path = null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'merchant_id' => $merchant->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock_status' => 'available',
            'image' => $path
        ]);

        return redirect()->route('products.index')->with('success','Produk berhasil ditambah');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('merchant.products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return redirect()->route('products.index')->with('success','Produk diupdate');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success','Produk dihapus');
    }

    // ================= EXPORT =================

    public function exportCsv()
    {
        $merchant = auth()->user()->merchant;

        if (!$merchant) {
            return redirect('/merchant/store')
                ->with('error','Isi data toko dulu');
        }

        $products = Product::with('category')
            ->where('merchant_id', $merchant->id)
            ->get();

        return response()->streamDownload(function () use ($products) {

            echo "Nama Produk,Kategori,Harga\n";

            foreach ($products as $p) {
                $kategori = $p->category->name ?? '-';
                echo "{$p->name},{$kategori},{$p->price}\n";
            }

        }, "laporan_produk.csv");
    }

    public function exportPdf()
    {
        $merchant = auth()->user()->merchant;

        if (!$merchant) {
            return redirect('/merchant/store')
                ->with('error','Isi data toko dulu');
        }

        $products = Product::with('category')
            ->where('merchant_id', $merchant->id)
            ->get();

        $pdf = Pdf::loadView('merchant.products.pdf', compact('products'));

        return $pdf->download('laporan_produk.pdf');
    }
}