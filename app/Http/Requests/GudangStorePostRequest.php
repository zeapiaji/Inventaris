<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GudangStorePostRequest extends FormRequest
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
            'nama_brg' => 'required|max:255',
            'jumlah'   => 'required|integer|min:1',
            'kode_brg' => 'required',
            'status'   => 'required',
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
            'kode_brg.required' => 'Kode barang diperlukan!',
            'status.required' => 'Status barang diperlukan!',
            'jumlah.min' => 'Jumlah aset harus lebih dari 1!'
        ];
    }

}
