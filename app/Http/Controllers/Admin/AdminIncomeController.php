<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminIncomeController extends ApiController
{
    //
    public function __construct()
    {
        $this->name ='user';
        $this->model = new Admin();
        $this->namePlural = 'users';

    }
    public function index($id){
        $admin=$this->_getInstance($id);

        $incomes=$admin->incomes()->with('detail_income')->get();
        return $this->responseSuccesfully($incomes,200);


    }
}
