<?php

namespace App\Http\Controllers;

use App\interfaces\Idelete;
use App\interfaces\IGetTableThrough;
use App\interfaces\Ishow;
use App\interfaces\IshowAll;
use App\interfaces\Istore;
use App\interfaces\Iupdate;
use App\interfaces\IValidateRequest;
use App\Models\Detail_Income;
use App\Models\Income;
use App\Traits\ApiResponser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller implements Istore,IshowAll,Ishow,Iupdate,Idelete,IGetTableThrough,IValidateRequest
{
    //
    use ApiResponser;
    public $model;
    public $name;
    public $nameplural;
    public $rules=[];
    public $request;

    public function _getTableThrough($table,$through,$ForeignTrough,$ForeignTable){
        return $this->model->hasManyThrough($table,$through,$ForeignTrough,$ForeignTable);

    }
   public function _validate($request){
        $validator=Validator::make($request->all(),$this->rules);
        if($validator->fails()){
            return $this->errorResponse($validator->errors());
        }
        return false;
   }
    public function _validateRequest($request, $rules)
    {
        $validator=Validator::make($request,$rules);
        if($validator->fails()){
            //return $this->errorResponse($validator->errors(),401);
            return $validator->errors();
        }
        return false;

    }

    public function _store($request,$rules)
    {
        // TODO: Implement _store() method.
        $this->_validateRequest($request,$rules);
        $instance=$this->model->create($request->all());
        return $instance;
    }
    public function _validateError($validations)
    {
        // TODO: Implement _validateError() method.
        foreach ($validations as $validation){
            if(!!$validation){
                 return $this->errorResponse($validation);

            }
        }

    }

    public function _showAll()
    {
       $collection= $this->model->all();
        // TODO: Implement _showAll() method.
        return $this->showAll($collection);
    }

    public function _delete($id)
    {
        $instance=$this->_getInstance($id);
        //$this->model->delete($model);
        $instance->delete();
        return $this->responseSuccesfully(['message'=>"deleted from {$this->nameplural} "]);
        // TODO: Implement _delete() method.
    }
    public function _update(  $request,$id)
    {
        // TODO: Implement _update() method.
        $instance=$this->_getInstance($id);
        $instance->update($request->all());
        //$instance->save();

        return $this->responseSuccesfully(["message"=>"product from {$this->nameplural}","update {$this->name}"=>$instance]);
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
