<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TweetRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'profile' => 'max:200',
            'body' => 'required|max:200',
        ];
    }

    public function messages()
    {
        return [
            'profile.max' => '200文字以内で入力してください。',
            'body.required' => '入力してください。',
            'body.max' => '200文字以内で入力してください。',
        ];
    }
}
