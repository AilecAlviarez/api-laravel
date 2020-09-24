<?php


namespace App\interfaces;


interface IValidateRequest
{
    public function _validateRequest($request,$rules);
    public function _validateError($validations);
}
