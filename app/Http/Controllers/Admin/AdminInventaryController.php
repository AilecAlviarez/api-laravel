<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminInventaryController extends ApiController
{
    //
    public function __construct()
    {
        $this->name ='inventary';
        $this->model = new Admin();
        $this->namePlural = 'inventaries';


    }
    public function index($id){
        $admin=$this->_getInstance($id);
        $inventaries=$this->_GetRelations($admin->detail_incomes,'inventary');
        return $this->responseSuccesfully($inventaries);

    }
}
