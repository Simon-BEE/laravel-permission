<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
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
                'string',
                'between:3,255',
            ],
            'slug' => [
                'required',
                'string',
                'between:3,255',
            ],
            'roles' => [
                'nullable',
                'exists:roles,id',
            ],
        ];
    }
}
