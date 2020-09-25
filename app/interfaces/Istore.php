<?php


namespace App\interfaces;


use http\Env\Request;

interface Istore
{
    public function _store(Request $request);
}
