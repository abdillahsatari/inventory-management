<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "user_name" => "required",
            // "user_username" => "required|unique:users,username",
            // "user_email" => "required|email|unique:users,email",
            "user_status" => "required",
            "user_role_id" => "required"
        ];
    }
}
