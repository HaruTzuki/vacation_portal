<?php

namespace VacationPortal\Data\Model\Responses;

class ResponseObject{
    
    public int $status;
    public string $message;
    public $object;
    
    function __construct(int $status, string $message, $object = null){
        $this->status = $status;
        $this->message = $message;
        $this->object = $object;
    }

}