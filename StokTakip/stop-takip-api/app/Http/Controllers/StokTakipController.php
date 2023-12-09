<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\stoktakip;

class StokTakipController extends Controller
{
    public function __construct()
    {
    }

    public function read()
    {
        return stoktakip::where('user_id', '=', Auth::User()->id)->get();
        // return stoktakip::get();
    }

    public function create(Request $request)
    {
        try {
            $stoktakip = new stoktakip();
            $stoktakip->urun_adi = $request->urun_adi;
            $stoktakip->urun_fiyati = $request->urun_fiyati;
            $stoktakip->urun_stok = $request->urun_stok;
            $stoktakip->user_id = Auth::user()->id;
            $stoktakip->save();
            return response()->json(['status' => 'success', 'message' => 'Ekleme İşlemi Başarılı.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Hatalı İşlem.']);
        }
    }

    public function update(Request $request)
    {
        try {
            $stoktakip = stoktakip::where('id', '=', $request->id)->first();
            $stoktakip->urun_adi = $request->urun_adi;
            $stoktakip->urun_fiyati = $request->urun_fiyati;
            $stoktakip->urun_stok = $request->urun_stok;
            $stoktakip->user_id = Auth::user()->id;
            $stoktakip->save();
            return response()->json(['status' => 'success', 'message' => 'Güncelleme İşlemi Başarılı.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Hatalı İşlem.']);
        }
    }

    public function delete(Request $request)
    {
        $stoktakip = stoktakip::where('id', '=', $request->id)->first();
        if (!$stoktakip) {
            return response()->json(['status' => 'error', 'message' => 'Hatalı İşlem ID.']);
        } else {
            try {
                $stoktakip->delete();
                return response()->json(['status' => 'success', 'message' => 'Silme İşlemi Başarılı.']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Hatalı İşlem.']);
            }
        }
    }
}
