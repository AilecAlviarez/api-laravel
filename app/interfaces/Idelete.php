<?php


namespace App\interfaces;


use Illuminate\Database\Eloquent\Model;

interface Idelete
{
    public function _delete(Model $model);
}
