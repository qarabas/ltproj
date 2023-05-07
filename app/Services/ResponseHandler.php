<?php


namespace App\Services;


use Illuminate\Http\Exceptions\HttpResponseException;

class ResponseHandler
{
    public function createResponse(bool $success, string $message, object $data = null) : object
    {
        throw new HttpResponseException(response()->json([
            'success'   => $success,
            'message'   => $message,
            'data'      => $data
        ]));
    }
}
