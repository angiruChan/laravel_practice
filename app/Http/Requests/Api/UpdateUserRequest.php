<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:64'],
            'last_name' => ['required', 'string', 'max:64'],
            'email' => ['required', 'email', Rule::unique(User::class, 'email')->ignore($this->route('user'))],
            'password' => ['required', 'min:8'],
            'birthdate' => ['required', 'date_format:m/d/Y'],
            'address' => ['required', 'string', 'max:200'],
        ];
    }
}
