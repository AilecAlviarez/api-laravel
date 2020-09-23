<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expence extends Model
{
    use HasFactory;
    protected $table='expences';
    protected $primaryKey='expence_id';
    protected $fillable=['user_id','status_id','total','method_pay_id'];
    public function detail_expences(){
        return $this->hasMany(Detail_Expence::class,'expence_id','expence_id');
    }
    public function status(){
        return $this->hasOne(Status::class);
    }
    public function buyer(){
        return $this->hasOne(Buyer::class,'user_id','user_id');
    }
    public function MethodPay(){
        return $this->hasOne(MethodPay::class);
    }
}
