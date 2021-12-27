<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FollowRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'follower_id' => auth()->id(),
            'followed_id' => $this->route('id')
        ]);
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
            'follower_id' => 'required|exists:users,id',
            'followed_id' => ['required', 'exists:users,id', Rule::notIn([auth()->id()])]
        ];
    }
}
