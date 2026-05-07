<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductPublicController extends Controller
{
    // ================= HOME =================
    public function home(Request $request)
    {
        $query = Product::with(['merchant','category'])->latest();

        // 🔍 SEARCH
        if ($request->search) {
            $query->where('name','like','%'.$request->search.'%');
        }

        // 🏷️ FILTER KATEGORI
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $products = $query->take(8)->get();
        $categories = Category::all();

        return view('welcome', compact('products','categories'));
    }

    // ================= CATALOG =================
    public function catalog(Request $request)
    {
        $query = Product::with(['merchant','category'])->latest();

        if ($request->search) {
            $query->where('name','like','%'.$request->search.'%');
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('catalog', compact('products','categories'));
    }

    // ================= DETAIL =================
    public function show($slug)
    {
        $product = Product::with(['merchant','category'])
            ->where('slug',$slug)
            ->firstOrFail();

        return view('product_detail', compact('product'));
    }
}