<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Claims\Collection;

trait ApiResponser
{
    public function showOne(Model $instance,$code=200){
        return $this->responseSuccesfully($instance,$code);
    }
    public function responseSuccesfully($data,$code){
        return response()->json($data,$code);
    }
    public function showAll(Collection $collection,$code=200){
        return $this->responseSuccesfully($collection,$code);
    }
    public function errorResponse($error,$code=500){
        return $this->responseSuccesfully($error,$code);
    }

}
