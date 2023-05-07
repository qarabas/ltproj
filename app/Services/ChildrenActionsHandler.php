<?php


namespace App\Services;


use App\Interfaces\ChildrensActions;

class ChildrenActionsHandler
{
    private ChildrensActions $childrensActions;

    public function __construct(ChildrensActions $childrensActions)
    {
        $this->childrensActions = $childrensActions;
    }

    public function getListByParentId() : object
    {
        return $this->childrensActions->getListByParentId();
    }
}
