<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AuthRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:6'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'errors' => $validator->errors()
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
