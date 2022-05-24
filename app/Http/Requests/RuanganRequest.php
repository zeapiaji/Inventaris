<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuanganRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ruangan' => 'required|min:5|max:20|unique:ruangan,nama',
        ];
    }

    public function messages()
    {
        return [
            'ruangan.required' => 'nama ruangan barang diperlukan!',
            'ruangan.unique' => 'nama sudah digunakan!',
            'ruangan.min' => 'minimal 5 huruf diperlukan!',
            'ruangan.max' => 'nama terlalu ruangan panjang!',
        ];
    }
}
