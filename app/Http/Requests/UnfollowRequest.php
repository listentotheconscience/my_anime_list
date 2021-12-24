<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnfollowRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge(['followed_id' => $this->route('id')]);
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
            'followed_id' => 'required|exists:users,id'
        ];
    }
}
