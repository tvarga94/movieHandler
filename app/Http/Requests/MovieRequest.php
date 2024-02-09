<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'min:3'],
            'director' => ['required', 'string', 'max:255', 'min:3'],
            'cast' => ['required', 'string', 'max:255', 'min:3'],
            'category' => ['required', 'string', 'max:255', 'min:3'],
            'releaseDate' => ['required', 'string', 'max:255', 'min:3'],
        ];
    }
}
