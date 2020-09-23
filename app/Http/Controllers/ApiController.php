<?php

namespace App\Http\Controllers;

use App\interfaces\Idelete;
use App\interfaces\Ishow;
use App\interfaces\IshowAll;
use App\interfaces\Istore;
use App\interfaces\Iupdate;
use App\Traits\ApiResponser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ApiController extends Controller implements Istore,IshowAll,Ishow,Iupdate,Idelete
{
    //
    use ApiResponser;
    public $model;
    public $name;
    public $nameplural;
    //public $data=[];
    public $request;



    public function _store($request)
    {
        // TODO: Implement _store() method.
    }

    public function _showAll()
    {
       $collection= $this->model->all();
        // TODO: Implement _showAll() method.
        return $this->showAll($collection);
    }

    public function _delete(Model $model)
    {
        // TODO: Implement _delete() method.
    }
    public function _update(Model $model)
    {
        // TODO: Implement _update() method.
    }
    public function _showOne(Model $instance)
    {
        // TODO: Implement _showOne() method.
        return $this->showOne($instance);
    }
}
