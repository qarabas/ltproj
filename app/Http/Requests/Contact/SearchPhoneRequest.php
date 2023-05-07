<?php


namespace App\Http\Requests\Contact;


use App\Http\Requests\BaseRequest;

class SearchPhoneRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'phone' => 'numeric|min:12|required',
        ];
    }
}
