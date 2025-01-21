<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'publication_year' => 'required|numeric|min:1500|max:' . date('Y'),
            'book_file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:2048',
        ];
    }
}
