<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ACH extends MethodPay
{
    use HasFactory;
    protected $table='method_pays';

    public function banks(){
        return $this->hasMany(Bank::class,'method_pay_id',$this->primaryKey);
    }
}
