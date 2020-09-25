<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerController extends ApiController
{
    public function __construct()
    {
        $this->name ='buyer';
        $this->model = new Buyer();
        $this->namePlural = 'buyers';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function orders($id){
        $buyer=$this->_getInstance($id);
        $data=[];
        $data['orders']=$buyer->expences()->with('status')->get();
        $data['order_details']=$buyer->detail_expences;
        $data['saldo']=$buyer->account()->get();
        return $this->responseSuccesfully($data);

    }


}
