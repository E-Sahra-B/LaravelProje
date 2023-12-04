<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KategoriController extends Controller
{
    public function index()
    {
        //$kategoriler = Category::all();
        //Cache::put('kategoriler', $kategoriler, 120);
        $kategoriler = Cache::remember('kategoriler', 120, function () {
            return Category::all();
        });
        return view('kategori.index', compact('kategoriler'));
    }

    public function clearCache(Request $request)
    {
        //Cache::forget('kategoriler');
        Cache::flush();
        $request->session()->flash('message', 'Cache başarıyla temizlendi.');
        return redirect()->route('kategoriler');
    }

    public function kategoriEkleForm()
    {
        return view('kategori.ekle');
    }

    public function kategoriEkle(CreateCategoryRequest $request)
    {
        // $request->validate();
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
