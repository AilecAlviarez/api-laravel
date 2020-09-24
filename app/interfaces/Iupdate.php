<?php


namespace App\interfaces;



use Illuminate\Database\Eloquent\Model;

interface Iupdate
{
    public function _update(Request $request,$ids);
}
