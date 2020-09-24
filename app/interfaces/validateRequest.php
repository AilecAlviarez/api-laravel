<?php


namespace App\interfaces;


interface IValidateRequest
{
    public function validateRequest($request,$rules);
}
