<?php

namespace App\Http\Requests;

use App\Models\Gudang;
use Illuminate\Foundation\Http\FormRequest;

class RuanganFormRequest extends FormRequest
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
            'nama_brg' => 'required',
            'jumlah' => 'required',
            'status' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nama_brg.required' => 'Barang diperlukan!',
            'jumlah.required' => 'Jumlah barang diperlukan!',
            'status.required' => 'Status barang diperlukan!',
            'jumlah.min' => 'Jumlah aset harus lebih dari 0!'
        ];
    }
}
