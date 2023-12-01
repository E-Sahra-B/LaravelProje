<?php

namespace App\Http\Controllers;

use App\Events\YeniHaberEklendi;
use App\Models\Haber;
use App\Models\Category;
use Illuminate\Http\Request;
use Mail;

class HaberController extends Controller
{
    public function index()
    {
        $data['haberler'] = Haber::getAllHaber();
        $data['kategoriler'] = Category::all();
        return view('haber.index', $data);
    }

    public function haberEkleForm()
    {
        $kategoriler = Category::where('status', 1)->get();
        return view('haber.haber-ekle', ['kategoriler' => $kategoriler]);
    }

    public function haberEkle(Request $request)
    {
        $request->validate([
            'baslik' => 'required',
            'icerik' => 'required',
            'kategori_id' => 'required|exists:categories,id',
            'status' => 'required|in:0,1',
        ]);
        $haber = Haber::create([
            'baslik' => $request->input('baslik'),
            'icerik' => $request->input('icerik'),
            'kategori_id' => $request->input('kategori_id'),
            'status' => $request->input('status'),
        ]);
        Mail::send(
            'mail.template',
            ['request' => $request],
            function ($message) use ($request) {
                $message->from('blank@blank.com', 'Esma Balcı');
                $message->to('blank@gmail.com', 'Sahra Balcı');
                $message->subject('Subject');
            }
        );
        //// event(new YeniHaberEklendi($haber));
        $request->session()->flash('message', 'Haber eklendi ve bildirim gönderildi.');
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
        // Düzenleme başarıyla gerçekleştirildiğini kullanıcıya bildirmek için bir mesaj ekleyebilirsiniz.
        $request->session()->flash('message', 'Haber başarıyla düzenlendi.');
        return redirect()->route('haberler');
    }

    public function haberSil($id)
    {
        $haber = Haber::find($id);
        if (!$haber) {
            // Haber bulunamadıysa hata mesajı veya başka bir işlem gerçekleştirilebilir.
            return redirect()->route('haberler')->with('message', 'Haber bulunamadı.');
        }
        $haber->delete();
        // Silme işlemi başarıyla gerçekleştirildiğini kullanıcıya bildirmek için bir mesaj ekleyebilirsiniz.
        return redirect()->route('haberler')->with('message', 'Haber başarıyla silindi.');
    }
}
