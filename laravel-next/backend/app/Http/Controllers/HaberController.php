<?php

namespace App\Http\Controllers;

use App\Events\NewsAddedEvent;
use App\Http\Requests\CreateNewsRequest;
use App\Models\Haber;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Backtrace\File;

class HaberController extends Controller
{
    public function index()
    {
        // $data['haberler'] = Haber::getAllHaber();
        // $data['kategoriler'] = Category::where('status', 1)->get();
        // $haberler = Haber::with(['kategori:id,ad'])
        //     ->where('status', 1)
        //     ->get();
        $haberler = Haber::with(['kategori:id,ad'])->get();
        return view('haber.index', compact('haberler'));
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
        // $kategoriler = Category::where('status', 1)->get();
        // return view('haber.haber-ekle', ['kategoriler' => $kategoriler]);
        // $kategorilerOptions = Category::where('status', 1)->pluck('ad', 'id');
        // return view('haber.haber-ekle', compact('kategorilerOptions'));
        return view('haber.haber-ekle');
    }

    public function haberEkle(CreateNewsRequest $request)
    {
        $user = new User();
        try {
            $imagePath = $request->file('image')->store('public/haber');
            $haber = Haber::create($request->except('image') + [
                'image' => $imagePath
            ]);
            //event(new NewsAddedEvent($haber, $user));
            $request->session()->flash('message', 'Haber eklendi ve bildirim gönderildi.');
        } catch (\Exception $e) {
            $request->session()->flash('message', 'Haber eklenirken bir hata oluştu.');
        }
        return redirect()->route('haberler');
    }

    public function haberDuzenleForm($id)
    {
        // $data['kategoriler'] = Category::where('status', 1)->get();
        $data['haber'] = Haber::find($id);
        return view('haber.duzenle', $data);
    }

    public function haberDuzenleKaydet(Request $request, $id)
    {
        try {
            $haber = Haber::find($id);
            $oldImagePath = $request->input('oldimage');
            if ($request->hasFile('image')) {
                $newImagePath = $request->file('image')->store('public/haber');
                if ($oldImagePath && Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
                $haber->update(['image' => $newImagePath]);
            }
            $haber->update($request->except('image'));
            $request->session()->flash('message', 'Haber başarıyla düzenlendi.');
        } catch (\Exception $e) {
            $request->session()->flash('message', 'Haber güncellenirken bir hata oluştu.');
        }
        return redirect()->route('haberler');
    }

    public function haberSil($id)
    {
        try {
            $haber = Haber::find($id);

            $imagePath = $haber->image;
            if ($imagePath && Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }

            $haber->delete();
            return redirect()->route('haberler')->with('message', 'Haber başarıyla silindi.');
        } catch (\Exception $e) {
            return redirect()->route('haberler')->with('message', 'Haber silinirken bir hata oluştu.');
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            $haberID = $request->id;
            $haber = Haber::findOrFail($haberID);
            $status = $haber->status;
            $haber->status = $status ? 0 : 1;
            $haber->save();
            return response()->json(['message' => 'Başarılı', 'status' => $haber->status], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Hatalı Server'], 500);
        }
    }
}
