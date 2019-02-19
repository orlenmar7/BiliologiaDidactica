<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;

class UserUpdateRequest extends FormRequest
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
                'name' => [
                    'required',
                    Rule::unique('users')->ignore($this->route('user'))
                ],
                'birthdate' => 'required|string',
                'status' => [
                    'required',
                    Rule::in(['active', 'deactivated'])
                ],
                'email' => [
                    'required','string','email','max:255',
                    Rule::unique('users')->ignore($this->route('user'))
                ],
                'password' => '',
                'password_confirmation' => 'same:password|required_with:password',
            ];
    }
}
