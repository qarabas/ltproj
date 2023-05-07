<?php


namespace App\Services;


use App\Interfaces\SearchEntity;

class EntitySearchHandler
{
    private SearchEntity $searchEntity;

    public function __construct(SearchEntity $searchEntity)
    {
        $this->searchEntity = $searchEntity;
    }

    public function searchEntity() : object
    {
        return $this->searchEntity->searchEntity();
    }

}
