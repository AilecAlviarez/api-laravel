<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->name ='category';
        $this->model = new Category();
        $this->namePlural = 'categories';


    }
    public function index()
    {
        return $this->_showAll();
    }


}
