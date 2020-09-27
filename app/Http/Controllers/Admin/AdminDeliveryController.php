<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDeliveryController extends ApiController
{
    //
    public function __construct()
    {
        $this->name ='user';
        $this->model = new Admin();
        $this->namePlural = 'users';

    }
    public function show($id){
        $admin=$this->_getInstance($id);
        $inventaries=$this->_GetRelations($admin->detail_incomes,'inventary');
        $products=$this->_GetRelations($inventaries,'product');
         $deliveries=$this->getDelivery($products);
        $detail_expences=$this->_GetRelations($products,'detail_expences');

        return $this->responseSuccesfully($deliveries);


    }
    public function getDelivery($products){
        $detail_expences=$this->_GetRelations($products,'detail_expences');

        $expences=$this->_GetRelations($detail_expences[0],'expence');
        $deliveries=$this->_GetRelations($expences,'delivery');



        return $deliveries;
    }
}
