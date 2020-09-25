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
    public function store(Request $request,$id)
    {
        $buyer=$this->_getInstance($id);
        $rulesDelivery=['delivery_address'=>'required|string','account_number'];

        $validations=$this->validateColumns($request,$this->rules);
        $getErrorsValidations=$this->_validateError($validations);
        if($getErrorsValidations)return $getErrorsValidations;
        $expence=$this->_order($request,$buyer);

        return $this->responseSuccesfully($expence);


    }
    public function validateNumberAccount($request,$buyer){
        $account=$request['account_number'];
        $accounts=$buyer->account()->get();
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
        $data['delivery_address']=$request['delivery_address'];


        return $data;
    }
    public function getDataDetail($request){
        $data=[];
        $data['quantity']=$request['quantity'];
        $data['product_id']=$request['product_id'];

        return $data;
    }
    public function methodPay($request){
        if(!$request['account_number'])return MethodPay::NOACH;
        return MethodPay::ACH;
    }
    public function updateSaldo($buyer,$saldo,$newSaldo){
       foreach ($buyer->accounts as $acc){
           if($acc->saldo==$saldo){
               $acc->saldo=$newSaldo;
               $acc->save();
           }
       }

    }
    public function saveDetails($request,$total,$saldo,$expence,$buyer,$type){

        $detail_expences=[];
        for ($i = 0; $i < count($request->all); $i++) {
            $dataDetail = $this->getDataDetail($request[$i]);
            $inventary = Inventary::find($dataDetail['product_id']);
            $verifiedStock = $inventary->cant_current_product;
            $verifiedStock -= $dataDetail['quantity'];
            if ($verifiedStock < $inventary->stock_min) {
                return $this->errorResponse('no se puede realizar el pedido porque supera el stock minimo');

            }
            $product = Product::find($dataDetail['product_id']);

            $total += $product->product_price;
            if($saldo<$total){
                return $this->errorResponse('saldo insuficiente');
            }else{
                $saldoNew=$saldo-$total;
                $expence_detail = Detail_Expence::create(array_merge($dataDetail, ['price' => $product->product_price, 'expence_id' => $expence->expence_id]));
                if($type==MethodPay::ACH){
                    $saldoRestante=$this->updateSaldo($buyer,$saldo,$saldoNew);
                }

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
        if($typeMethodPay==MethodPay::ACH){
            $saldo=$this->validateNumberAccount($request,$buyer);
            if($saldo) {
                $dataExpence = ['user_id' => $buyer->user_id, 'status' => Status::find(0), 'total' => 0];
                $expence = Expence::create($dataExpence);
                $dataDelivery = $this->getDataDelivery($request);
                $Delivery = Deliveries::create($dataDelivery);
                $total = $expence->total;
                $detail_expences=$this->saveDetails($request,$total,$saldo,$expence,$buyer,MethodPay::ACH);
                return $this->storeSuccesfully($detail_expences,$expence);




            }
            else{
                return $this->errorResponse('number account invalid');
            }
        }
        else{
            $dataExpence = ['user_id' => $buyer->user_id, 'status' => Status::find(0), 'total' => 0];
            $expence = Expence::create($dataExpence);
            $dataDelivery = $this->getDataDelivery($request);
            $Delivery = Deliveries::create($dataDelivery);
            $total = $expence->total;
            $detail_expences=$this->saveDetailsDelivery($request,$total,$expence,$buyer,MethodPay::NOACH);
            return $this->storeSuccesfully($detail_expences,$expence);

        }



    }
public function saveDetailsDelivery($request,$total,$expence,$buyer,$type){
    $detail_expences=[];
    for ($i = 0; $i < count($request->all); $i++) {
        $dataDetail = $this->getDataDetail($request[$i]);
        $inventary = Inventary::find($dataDetail['product_id']);
        $verifiedStock = $inventary->cant_current_product;
        $verifiedStock -= $dataDetail['quantity'];
        if ($verifiedStock < $inventary->stock_min) {
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
