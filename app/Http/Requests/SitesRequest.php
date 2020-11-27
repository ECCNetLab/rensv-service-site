<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SitesRequest extends FormRequest
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
            'name' => 'required|min:3|max:32',
            'domain' => 'required|unique:rental_servers,domain|regex:/^[a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]$/',
            'ftpPassword' => 'required|confirmed|min:8|max:32',
            'frpPassword_confirmation' => 'required',
            'plan' => 'required',
        ];
    }
}
