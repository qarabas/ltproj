<?php


namespace App\Interfaces;


interface ContactEntitiesActions
{
    public function saveEntity() : bool;

    public function deleteEntity() : bool;
}
