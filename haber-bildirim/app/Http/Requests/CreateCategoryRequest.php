<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ad' => 'required',
            'status' => 'in:1,0',
        ];
    }
    public function messages()
    {
        return [
            'ad.required' => "Kategori adı boş bırakılamaz",
            'status.in' => "Durum değeri 1 veya 0 olmalıdır."
        ];
    }
}
