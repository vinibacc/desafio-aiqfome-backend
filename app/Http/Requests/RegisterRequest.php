<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="RegisterRequest",
 *     type="object",
 *     required={"name", "email", "password", "password_confirmation"},
 *     @OA\Property(property="name", type="string", example="Vinicius Bacchieri"),
 *     @OA\Property(property="email", type="string", format="email", example="vinicius@example.com"),
 *     @OA\Property(property="password", type="string", format="password", example="StrongP@ss1"),
 *     @OA\Property(property="password_confirmation", type="string", format="password", example="StrongP@ss1")
 * )
 */
class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Oops! This email is already in use.',
            'password.confirmed' => 'Please make sure your password confirmation matches.',
        ];
    }
}
