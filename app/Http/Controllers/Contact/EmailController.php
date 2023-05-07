<?php

namespace App\Http\Controllers\Contact;

use App\Entities\Emails;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\BulkEmailsRequest;
use App\Http\Requests\Contact\EmailRequest;
use App\Http\Requests\Contact\SearchEmailRequest;
use App\Models\StaticMethods;
use App\Services\ContactEntitiesHandler;
use App\Services\EntitySearchHandler;
use App\Services\ResponseHandler;


class EmailController extends Controller
{
    /**
     * Bulk creation of emails for a contact
     */
    public function bulkCreate(BulkEmailsRequest $request): object
    {
        $emails = StaticMethods::array_unique_key($request->all()['emails'], 'email');
        foreach ($emails as $email){
            $contactHandler = new ContactEntitiesHandler(new Emails($email));
            $contactHandler->saveEntity();
        }
        $responseHandler = new ResponseHandler();
        return $responseHandler->createResponse(
            true,
            'success',
        );
    }

    /**
     * email deleting by id
     */
    public function destroy(EmailRequest $request): object
    {
        $message = 'The email you are looking for is not in your book';
        $email = Emails::find($request->request->get('email_id')) ?? null;
        if ($email && $email->contact->user->id === $request->request->get('user_id')){
            $message = $email->email . ' with id=' . $email->id . ' deleted';
            $email->delete();
        }

        $responseHandler = new ResponseHandler();
        return $responseHandler->createResponse(
            !empty($email),
            $message,
        );
    }

    /**
     * search by email
     */
    public function search(SearchEmailRequest $request): object
    {
        $searchModel = new Emails();
        $searchModel->email = $request->input('email');
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
