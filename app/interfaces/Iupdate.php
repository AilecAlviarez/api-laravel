<?php


namespace App\interfaces;


use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

interface Iupdate
{
    public function _update(Model $model,Request $request);
}
