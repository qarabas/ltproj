<?php


namespace App\Http\Requests;


use App\Services\ResponseHandler;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        $response = new ResponseHandler();
        $response->createResponse(!$validator->fails(), 'Validation errors', $validator->errors());
    }
}
