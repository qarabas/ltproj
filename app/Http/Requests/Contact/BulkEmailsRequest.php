<?php

namespace App\Http\Requests\Contact;

use App\Http\Requests\BaseRequest;

class BulkEmailsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'emails' => 'array|required',
            'emails.*.email' => 'email|unique:emails|required|max:30',
            'emails.*.contact_id' => 'required|integer|exists:contacts,id',
        ];
    }
}
