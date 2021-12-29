<?php

namespace App\Http\Requests;

use App\Enums\Status;
use App\Enums\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAnimeRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }
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
            'id' => 'required|exists:animes,id',
            'name' => 'required',
            'episodes' => 'required|integer',
            'image' => 'required|image',
            'licensor' => 'required|exists:licensors,id',
            'studio' => 'required|exists:studios,id',
            'producer' => 'required|exists:producers,id',
            'genres' => 'required',
            'season' => 'required',
            'type' => ['required', Rule::in(Type::asArray())],
            'status' => ['required', Rule::in(Status::asArray())]
        ];
    }
}
