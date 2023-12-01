<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoriler = Category::all();
        return view('kategori.index', compact('kategoriler'));
    }

    public function kategoriEkleForm()
    {
        return view('kategori.ekle');
    }

    public function kategoriEkle(Request $request)
    {
        $request->validate([
            'ad' => 'required',
            'status' => 'in:1,0',
        ]);
        try {
            Category::create([
                'ad' => $request->ad,
                'status' => $request->status,
            ]);
            $request->session()->flash('message', 'Kategori başarıyla eklendi.');
        } catch (\Exception $e) {
            $request->session()->flash('message', 'Kategori eklenirken bir hata oluştu.');
        }
        return redirect()->route('kategoriler');
    }

    public function kategoriDuzenleForm($id)
    {
        $kategori = Category::find($id);
        if (!$kategori) {
            return redirect()->route('kategoriler')->with('message', 'Kategori bulunamadı.');
        }
        return view('kategori.duzenle', compact('kategori'));
    }

    public function kategoriDuzenleKaydet(Request $request, $id)
    {
        $kategori = Category::find($id);
        if (!$kategori) {
            return redirect()->route('kategoriler')->with('message', 'Kategori bulunamadı.');
        }
        $request->validate([
            'ad' => 'required',
            'status' => 'in:0,1',
        ]);
        $kategori->update([
            'ad' => $request->ad,
            'status' => $request->status,
        ]);
        return redirect()->route('kategoriler')->with('message', 'Kategori başarıyla güncellendi.');
    }

    public function kategoriSil($id)
    {
        $kategori = Category::find($id);
        if (!$kategori) {
            return redirect()->route('kategoriler')->with('message', 'Kategori bulunamadı.');
        }
        $kategori->delete();
        return redirect()->route('kategoriler')->with('message', 'Kategori başarıyla silindi.');
    }
}
