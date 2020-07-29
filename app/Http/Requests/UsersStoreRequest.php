<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersStoreRequest extends FormRequest
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
            'nama' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|unique:users,email',
            'phone' => 'required|numeric',
            'nama_rs' => 'required|regex:/^[\pL\s\-]+$/u',
            'role' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'nama'      => 'Nama',
            'email'     => 'Email',
            'phone'     => 'No Telepon',
            'nama_rs'   => 'Nama Rumah Sakit',
            'role'      => 'Role',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => ':attribute harus diisi',
            'nama.regex' => ':attribute harus berupa karakter alphabet',
            'email.required' => ':attribute harus diisi',
            'email.unique' => ':attribute telah digunakan',
            'phone.required' => ':attribute harus diisi',
            'phone.numeric' => ':attribute harus berupa angka',
            'nama_rs.required' => ':attribute harus diisi',
            'nama_rs.regex' => ':attribute harus berupa karakter alphabet',
            'role.required' => ':attribute harus diisi',
        ];
    }

}
