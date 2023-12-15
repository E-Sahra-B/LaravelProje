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
            'status.in' => "Hatalı Durum Seçiminde Bulundunuz"
        ];
    }
}
