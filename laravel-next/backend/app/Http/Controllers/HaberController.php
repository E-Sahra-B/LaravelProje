<?php

namespace App\Http\Controllers;

use App\Events\NewsAddedEvent;
use App\Http\Requests\CreateNewsRequest;
use App\Models\Haber;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class HaberController extends Controller
{
    public function index()
    {
        $data['haberler'] = Haber::getAllHaber();
        $data['kategoriler'] = Category::where('status', 1)->get();
        return view('haber.index', $data);
    }

    public function getNews()
    {
        return Haber::get();
    }

    public function apiDetail($id)
    {
        return Haber::find($id);
    }

    public function haberEkleForm()
    {
        $kategoriler = Category::where('status', 1)->get();
        return view('haber.haber-ekle', ['kategoriler' => $kategoriler]);
    }

    public function haberEkle(CreateNewsRequest $request)
    {
        $user = new User();
        try {
            $haber = Haber::create([
                'baslik' => $request->input('baslik'),
                'icerik' => $request->input('icerik'),
                'kategori_id' => $request->input('kategori_id'),
                'status' => $request->input('status'),
            ]);
            event(new NewsAddedEvent($haber, $user));
            $request->session()->flash('message', 'Haber eklendi ve bildirim gönderildi.');
        } catch (\Exception $e) {
            $request->session()->flash('message', 'Haber eklenirken bir hata oluştu.');
        }
        return redirect()->route('haberler');
    }

    public function haberDuzenleForm($id)
    {
        $data['kategoriler'] = Category::where('status', 1)->get();
        $data['haber'] = Haber::find($id);
        return view('haber.duzenle', $data);
    }

    public function haberDuzenleKaydet(Request $request, $id)
    {
        $haber = Haber::find($id);
        $haber->update([
            'baslik' => $request->input('baslik'),
            'icerik' => $request->input('icerik'),
            'kategori_id' => $request->input('kategori_id'),
            'status' => $request->input('status'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $request->session()->flash('message', 'Haber başarıyla düzenlendi.');
        return redirect()->route('haberler');
    }

    public function haberSil($id)
    {
        $haber = Haber::find($id);
        if (!$haber) {
            return redirect()->route('haberler')->with('message', 'Haber bulunamadı.');
        }
        $haber->delete();
        // Silme işlemi başarıyla gerçekleştirildiğini kullanıcıya bildirmek için bir mesaj ekleyebilirsiniz.
        return redirect()->route('haberler')->with('message', 'Haber başarıyla silindi.');
    }
}
