<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class MessageReplyRequest extends FormRequest
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
            "replyId" => [
                "required",
                "numeric",
                "exists:messages,id"
            ],
            "subject" => [
                "required",
                "string"
            ],
            "description" => [
                "required",
                "string"
            ]
        ];
    }
}
