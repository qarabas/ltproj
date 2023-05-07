<?php

namespace App\Services;

use App\Interfaces\ContactEntitiesActions;

class ContactEntitiesHandler
{
    private ContactEntitiesActions $contactActions;

    public function __construct(ContactEntitiesActions $contactActions)
    {
        $this->contactActions = $contactActions;
    }

    public function saveEntity() : bool
    {
        return $this->contactActions->saveEntity();
    }

    public function deleteEntity() : bool
    {
        return $this->contactActions->deleteEntity();
    }
}
