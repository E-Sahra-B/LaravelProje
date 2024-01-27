<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'baslik' => 'required',
            'icerik' => 'required',
            'kategori_id' => 'required|exists:categories,id',
            'status' => 'required|in:0,1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'baslik.required' => "Başlık alanı boş bırakılamaz",
            'icerik.required'  => "İçeriği boş bırakamazsınız",
            'kategori_id.required' => "Kategorilerden birini seçmeden kaydettiremezsiniz",
            'kategori_id.exists' => "Seçilen Kategori Mevcut Değil",
            'status.required' => "Durumu Seçmeden Kaydetmeye Çalıştınız",
            'status.in' => "Hatalı Durum Seçiminde Bulundunuz",
            'image.required' => "Lütfen Resim Yükleyiniz",
            'image.image' => "Yüklenecek Dosya Bir Resim Olmalıdır.",
            'image.mimes' => "Resimler için İzin Verilen Türler jpeg, png, jpg ve gif olmalıdır",
            'image.max' => "Yüklemeye Çalıştığınız Resim 2MB'tan Büyük"
        ];
    }
}
