<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;

class AccountRequest extends FormRequest
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
    public function rules(Request $request)
    {


        if ($request->get('current_password') || $request->get('password')) {
            $validations = [
                'name' => [
                    'required',
                    Rule::unique('users')->ignore($this->route('user'))
                ],
                'birthdate' => 'required|string',
                'email' => [
                    'required','string','email','max:255',
                    Rule::unique('users')->ignore($this->route('user'))
                ],
                'password' => 'required|min:6',
                'password_confirmation' => 'same:password|required_with:password',
                'current_password' => 'required_with:password|current_password',
            ];
        }else{
            $validations = [
                'name' => [
                    'required',
                    Rule::unique('users')->ignore($this->route('user'))
                ],
                'birthdate' => 'required|string',
                'email' => [
                    'required','string','email','max:255',
                    Rule::unique('users')->ignore($this->route('user'))
                ]
            ];
        }

        return $validations;
    }

    public function messages()
    {
        return [
            'current_password.current_password' => 'El contraseña actual es incorrecta.',
        ];
    }
}
