<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestStoreRequest extends FormRequest
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
            'history_id'    => 'required',
            'tests'         => 'required|array',
            'tests.*.question'  => 'required|string|min:3',
            'tests.*.options'   => 'required|array',
            'tests.*.options.*.op'  => 'required|string',
            'tests.*.options.*.check'  => 'required',
        ];
    }
}
