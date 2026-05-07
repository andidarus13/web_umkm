<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;

class StoreController extends Controller
{
    public function index()
    {
        $merchant = auth()->user()->merchant;
        return view('merchant.store.index', compact('merchant'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'store_name' => 'required',
            'city' => 'required',
            'whatsapp_number' => 'required',
        ]);

        Merchant::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'store_name' => $request->store_name,
                'city' => $request->city,
                'whatsapp_number' => $request->whatsapp_number,
                'description' => $request->description,
            ]
        );

        return back()->with('success','Toko berhasil disimpan');
    }
}