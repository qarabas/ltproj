<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\SearchContactRequest;
use App\Models\Contact;
use App\Services\ChildrenActionsHandler;
use App\Services\EntitySearchHandler;
use App\Services\ResponseHandler;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Get contacts by user_id
     */
    public function contactList(Request $request): object
    {
        $contact = new Contact();
        $contact->user_id = $request->request->get('user_id');
        $contactHandler = new ChildrenActionsHandler($contact);

        $responseHandler = new ResponseHandler();
        return $responseHandler->createResponse(
            true,
            'success',
            $contactHandler->getListByParentId()
        );
    }

    /**
     * search by full name
     */
    public function search(SearchContactRequest $request): object
    {
        $searchModel = new Contact();
        $searchModel->full_name = $request->input('full_name');
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
