<?php

namespace App\Http\Requests;

use App\Enums\MangaStatus;
use App\Enums\MangaTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateMangaRequest extends FormRequest
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
            'name' => 'required',
            'chapters' => 'required|integer',
            'image' => 'required|image',
            'mangaka' => 'required|exists:mangakas,id',
            'genres' => 'required',
            'year' => 'required|integer',
            'type' => ['required', Rule::in(MangaTypes::asArray())],
            'status' => ['required', Rule::in(MangaStatus::asArray())]
        ];
    }
}
