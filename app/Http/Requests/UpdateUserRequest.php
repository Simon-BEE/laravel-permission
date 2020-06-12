<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    protected int $userId;

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
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->userId),
                'max:255',
            ],
            'roles' => [
                'required',
                'array',
                'min:1',
                'exists:roles,slug',
            ],
            'permissions' => [
                'nullable',
                'array',
                'exists:permissions,slug',
            ],
        ];
    }

    /**
    * Check if user is in url, otherwise use auth id
    *  /!\
    *
    * @return void
    */
   public function prepareForValidation()
   {
        $this->userId = $this->route()->user->id;
   }
}
