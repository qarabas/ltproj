<?php

namespace App\Http\Controllers\Contact;

use App\Entities\PhoneNumbers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\BulkPhoneNumbersRequest;
use App\Http\Requests\Contact\PhoneRequest;
use App\Http\Requests\Contact\SearchPhoneRequest;
use App\Models\StaticMethods;
use App\Services\ContactEntitiesHandler;
use App\Services\EntitySearchHandler;
use App\Services\ResponseHandler;

class PhoneController extends Controller
{
    /**
     * Bulk creation of phone numbers for a contact
     */
    public function bulkCreate(BulkPhoneNumbersRequest $request): object
    {
        $phoneNumbers = StaticMethods::array_unique_key($request->all()['phone_numbers'], 'phone');
        foreach ($phoneNumbers as $phone){
            $contactHandler = new ContactEntitiesHandler(new PhoneNumbers($phone));
            $contactHandler->saveEntity();
        }
        $response = new ResponseHandler();
        return $response->createResponse(
            true,
            'success',
        );
    }

    /**
     * phone deleting by id
     */
    public function destroy(PhoneRequest $request): object
    {
        $phone = new PhoneNumbers();
        $phone->id = $request->request->get('phone_id');
        $phone->user_id = $request->request->get('user_id');
        $contactHandler = new ContactEntitiesHandler($phone);
        $isDeleted = $contactHandler->deleteEntity();
        $message = $isDeleted ? 'deleted' : 'The phone number you are looking for is not in your book';

        $responseHandler = new ResponseHandler();
        return $responseHandler->createResponse(
            $isDeleted,
            $message,
        );
    }

    /**
     * search by phone
     */
    public function search(SearchPhoneRequest $request): object
    {
        $searchModel = new PhoneNumbers();
        $searchModel->phone = $request->input('phone');
        $searchModel->user_id = $request->request->get('user_id');
        $contactHandler = new EntitySearchHandler($searchModel);

        $responseHandler = new ResponseHandler();
        return $responseHandler->createResponse(
            true,
            'success',
            $contactHandler->searchEntity()
        );
    }
}
