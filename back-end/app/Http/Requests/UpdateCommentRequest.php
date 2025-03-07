<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
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
            'content' => 'sometimes|required|string', // Le contenu est requis s'il est fourni
            'user_id' => 'nullable|exists:users,id', // L'utilisateur doit exister (facultatif)
            'article_id' => 'nullable|exists:articles,id', // L'article doit exister (facultatif)
        ];
    }
}
