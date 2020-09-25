<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Buyer;
use App\Models\Deliveries;
use App\Models\Detail_Expence;
use App\Models\Expence;
use App\Models\Inventary;
use App\Models\MethodPay;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BuyerController extends ApiController
{
    public function __construct()
    {
        $this->name ='buyer';
        $this->model = new Buyer();
        $this->namePlural = 'buyers';
        $this->rules=[
            'product_id'=>'required|integer',
            'quantity'=>'required|integer|max:5'
        ];

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
    public function arrayProducts($request){
    $arrayAux=$request->all();
    unset($arrayAux[0]);
    $data=array_values($arrayAux);
    return $data;
  }
    public function store(Request $request,$id)
    {
        $buyer=$this->_getInstance($id);
        //$rulesDelivery=['delivery_address'=>'required|string','account_number'];
        $requestProducts=$this->arrayProducts($request);
        $validations=$this->validateColumns($requestProducts,$this->rules);
        $getErrorsValidations=$this->_validateError($validations);
        if($getErrorsValidations)return $getErrorsValidations;
        $expence=$this->_order($request,$buyer);

        return $this->responseSuccesfully($expence);


    }
    public function validateNumberAccount($request,$buyer){
        $account=$request[0]['account_number'];
        $accounts=$buyer->account;
        $account_verified=$this->validateIfExistInAccounts($accounts,$account);
        if($account_verified)return $account_verified;
        return false;


    }

    public function validateIfExistInAccounts($accounts,$account_verified){
        foreach ($accounts as $key=>$value){
            if($accounts['account_number']==$account_verified){
                return $accounts['saldo'];

            }
        }
        return false;
    }
    public function getDataDelivery($request){
        $data=[];
        $data['delivery_address']=$request[0]['delivery_address'];


        return $data;
    }
    public function getDataDetail($request){
        $data=[];
        $data['quantity']=$request['quantity'];
        $data['product_id']=$request['product_id'];

        return $data;
    }
    public function methodPay($request){
        if(count($request[0])==1)return MethodPay::NOACH;
        return MethodPay::ACH;
    }
    public function updateSaldo($buyer,$saldo,$newSaldo){
       foreach ($buyer->account() as $acc){
           if($acc->saldo==$saldo){
               $acc->saldo=$newSaldo;
               $acc->save();
           }
       }

    }
    public function saveDetails($request,$total,$saldo,$expence,$buyer){

        $detail_expences=[];
        for ($i = 1;$i<count($request->all());$i++) {
            $dataDetail = $this->getDataDetail($request[$i]);
            $inventary = Inventary::find($dataDetail['product_id']);
            $verifiedStock = $inventary->cant_current_product;
            $verifiedStock =$verifiedStock- $dataDetail['quantity'];
            if ($verifiedStock >= $inventary->stock_min) {
                return $this->errorResponse('no se puede realizar el pedido porque supera el stock minimo');

            }
            $product = Product::find($dataDetail['product_id']);

            $total += $product->product_price;
            if($saldo<$total){
                return $this->errorResponse('saldo insuficiente');
            }else{
                $saldoNew=$saldo-$total;
                $expence_detail = Detail_Expence::create(array_merge($dataDetail, ['price' => $product->product_price, 'expence_id' => $expence->expence_id]));

                $this->updateSaldo($buyer,$saldo,$saldoNew);


                $expence->update(['total'=>$total]);

                array_push($detail_expences,$expence_detail);


            }

        }
        return $detail_expences;

    }
    public function storeSuccesfully($details,$expence){
        $data=[];
        $data['detail_expences']=$details;
        $data['expence']=$expence;
        return $this->responseSuccesfully($data);
    }



    public function _order($request,$buyer){
        $typeMethodPay=$this->methodPay($request);
        if($typeMethodPay=='1'){
            $saldo=$this->validateNumberAccount($request,$buyer);
            if($saldo) {
                $dataDelivery = $this->getDataDelivery($request);
                $Delivery = Deliveries::create(array_merge($dataDelivery,['date_come'=>'1991-02-19']));
                $dataExpence = ['user_id' => $buyer->user_id,
                    'status_id' => Status::find(1)->status_id, 'total' => 0,'delivery_id'=>$Delivery->delivery_id,
                    'method_pay_id'=>MethodPay::find(1)->method_pay_id];
                $expence = Expence::create($dataExpence);

                $total = $expence->total;
                $detail_expences=$this->saveDetails($request,$total,$saldo,$expence,$buyer);
                return $this->storeSuccesfully($detail_expences,$expence);




            }
            else{
                return $this->errorResponse('number account invalid');
            }
        }
        else{
            $dataDelivery = $this->getDataDelivery($request);
            $Delivery = Deliveries::create(array_merge($dataDelivery,['date_come'=>'1991-02-19']));
            $dataExpence = ['user_id' => $buyer->user_id,
                'status_id' => Status::find(1)->status_id, 'total' => 0,'delivery_id'=>$Delivery->delivery_id,
                'method_pay_id'=>MethodPay::find(2)->method_pay_id];
            $expence = Expence::create($dataExpence);

            $total = $expence->total;
            $detail_expences=$this->saveDetailsDelivery($request,$total,$expence,$buyer,MethodPay::NOACH);
            return $this->storeSuccesfully($detail_expences,$expence);

        }



    }
public function saveDetailsDelivery($request,$total,$expence,$buyer,$type){
    $detail_expences=[];
    for ($i = 1; $i < count($request->all()); $i++) {
        $dataDetail = $this->getDataDetail($request[$i]);
        $inventary = Inventary::find($dataDetail['product_id']);
        $verifiedStock = $inventary->cant_current_product;
        $verifiedStock = $verifiedStock-$dataDetail['quantity'];
        if ($verifiedStock >= $inventary->stock_min) {
            return $this->errorResponse('no se puede realizar el pedido porque supera el stock minimo');

        }
        $product = Product::find($dataDetail['product_id']);

        $total += $product->product_price;


            $expence_detail = Detail_Expence::create(array_merge($dataDetail, ['price' => $product->product_price, 'expence_id' => $expence->expence_id]));


            $expence->update(['total'=>$total]);

            array_push($detail_expences,$expence_detail);


        }


    return $detail_expences;

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
