<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Buyer;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends ApiController
{
    public function __construct()
    {
        $this->name ='user';
        $this->model = new User();
        $this->namePlural = 'users';
        $this->rules=[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
            'role'=>'required|'];


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->_showAll();

    }
    public function show($id){
        return $this->_showOne($id);

    }
    public function store(Request $request){
        return $this->_store($request);

    }
    public function update(Request $request,$id){
        return $this->_update($request,$id);
    }
    public function destroy($id){
        return $this->_delete($id);
    }




}
