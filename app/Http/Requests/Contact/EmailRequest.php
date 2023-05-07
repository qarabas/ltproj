<?php


namespace App\Http\Requests\Contact;

use App\Http\Requests\BaseRequest;

class EmailRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'email_id' => 'integer|required',
        ];
    }
}
