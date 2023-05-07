<?php


namespace App\Http\Requests\Contact;


use App\Http\Requests\BaseRequest;

class SearchEmailRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'email' => 'string|required|max:30',
        ];
    }
}
