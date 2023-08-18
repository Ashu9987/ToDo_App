<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
            'email' => [
                'required',
                'email:filter',
                Rule::exists('users', 'email'),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'メールアドレス',
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'このメールアドレスは存在していません。',
            'email.email' => '正しいメールアドレスの形式で入力してください。',
            'email.required' => ' :attribute を入力してください。'
        ];
    }
}
