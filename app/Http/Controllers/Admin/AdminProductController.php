<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Detail_Income;
use App\Models\Income;
use App\Models\Inventary;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->name ='user';
        $this->model = new Admin();
        $this->namePlural = 'users';

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin=$this->_getInstance(58);
      // $dataProducts=$this->getArrayProduct($request);
       //$dataInventaries=$this->getDataInventaries($request);
       $products=$this->_getProducts($request,$admin);


        return $this->responseSuccesfully($products);
    }
  /*  private function getDataInventaries($request){

        return $request->only(['cant_product_current','stock_max','stock_min']);
        return $data;
    }
    private function getArrayProduct($request){
        return $request->except('cant_product_current','stock_max','stock_min');
    }*/
    public function _getProducts($request,$admin){
        $productsCreatesInventary=[];
        $income=Income::create(['user_id'=>$admin->user_id]);
        for($i=0;$i<=count($request->all());$i++){
            $dataProduct=$request[$i]->except('cant_product_current','stock_max','stock_min');
            $dataInventary=$request[$i]->only(['cant_product_current','stock_max','stock_min']);
            $newProduct=Product::create($dataProduct);

            $dataInventary['product_id']=$newProduct->product_id;

            $newInventary=Inventary::create($dataInventary);
            $dataDetail=[
                'product_id'=>$newProduct->product_id,
                'quantity'=>$newInventary->request->cant_product_current,
                'price'=>$newProduct->product_price,
                'income_id'=>$income->income_id
            ];
          //  $newInventary->update(['cant_product_current'=>$income->cant_product_id]);
           // $newInventary->save();

            $detailIncome=Detail_Income::create($dataDetail);
            array_push($productsCreatesInventary,$dataDetail);
            array_push($productsCreatesInventary,$income);

        }
        return $productsCreatesInventary;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $admin=$this->_getInstance($id);

        $inventaries=$this->_GetRelations($admin->detail_incomes,'inventary');
        $products=$this->_GetRelations($inventaries,'product');
        return $this->responseSuccesfully();

    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
