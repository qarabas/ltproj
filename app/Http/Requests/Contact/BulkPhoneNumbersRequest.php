<?php

namespace App\Http\Requests\Contact;

use App\Http\Requests\BaseRequest;

class BulkPhoneNumbersRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'phone_numbers' => 'array|required',
            'phone_numbers.*.phone' => 'unique:phone_numbers|required|numeric|digits:12',
            'phone_numbers.*.contact_id' => 'required|integer|exists:contacts,id'
        ];
    }
}
