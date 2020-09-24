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




}
