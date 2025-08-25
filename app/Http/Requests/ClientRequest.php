<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="ClientRequest",
 *     type="object",
 *     required={"name", "email"},
 *     @OA\Property(property="name", type="string", example="João da Silva"),
 *     @OA\Property(property="email", type="string", format="email", example="joao@example.com")
 * )
 */
class ClientRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:clients,email',
        ];
    }
}
