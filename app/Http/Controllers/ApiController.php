<?php

namespace App\Http\Controllers;

use App\interfaces\Idelete;
use App\interfaces\IGetTableThrough;
use App\interfaces\Ishow;
use App\interfaces\IshowAll;
use App\interfaces\Istore;
use App\interfaces\Iupdate;
use App\Models\Detail_Income;
use App\Models\Income;
use App\Traits\ApiResponser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ApiController extends Controller implements Istore,IshowAll,Ishow,Iupdate,Idelete,IGetTableThrough
{
    //
    use ApiResponser;
    public $model;
    public $name;
    public $nameplural;
    //public $data=[];
    public $request;

    public function _getTableThrough($table,$through,$ForeignTrough,$ForeignTable){
        return $this->model->hasManyThrough($table,$through,$ForeignTrough,$ForeignTable);

    }

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
        $this->model->delete($model);
        return $this->responseSuccesfully(['message'=>"deleted from {$this->nameplural} "]);
        // TODO: Implement _delete() method.
    }
    public function _update(Model $model,  $request)
    {
        // TODO: Implement _update() method.
    }

    public function _showOne( $id)
    {
        $instance=$this->model->findOrFail($id);
        // TODO: Implement _showOne() method.
        return $this->showOne($instance);
    }
    public function _GetRelations($array_collection,$property){
        $data=[];

       if(method_exists($array_collection[0],$property)){
            foreach ($array_collection as $instance){
                if($instance[$property]!=null){
                    array_push($data,$instance[$property]);

                }
            }
            return $data;

        }
        return 'method no exist';


    }
    public function _getInstance($id)
    {
        // TODO: Implement _getInstance() method.
        return $this->model->findOrFail($id);

    }
}
