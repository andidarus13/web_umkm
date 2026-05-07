<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;

class MerchantController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 🔥 AUTO CREATE MERCHANT BIAR NGGAK NULL
        if (!$user->merchant) {
            Merchant::create([
                'user_id' => $user->id,
                'store_name' => 'Toko Saya',
                'city' => '',
                'whatsapp_number' => '',
                'description' => ''
            ]);
        }

        $merchant = $user->merchant;

        return view('merchant.store.index', compact('merchant'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $merchant = $user->merchant;

        // 🔥 JAGA-JAGA kalau masih null
        if (!$merchant) {
            $merchant = Merchant::create([
                'user_id' => $user->id,
                'store_name' => 'Toko Saya'
            ]);
        }

        $data = $request->only([
            'store_name',
            'city',
            'whatsapp_number',
            'description'
        ]);

        // 🔥 UPLOAD LOGO
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $path;
        }

        $merchant->update($data);

        return back()->with('success','Toko berhasil disimpan');
    }
}