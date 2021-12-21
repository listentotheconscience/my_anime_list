<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetAnimeCommentRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
        $this->merge(['page' => $this->query('page')]);
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
            'page' => 'required|integer'
        ];
    }
}
