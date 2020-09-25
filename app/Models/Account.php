<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $primaryKey='account_id';
    protected $table='accounts';
    protected $fillable=['bank_id','account_number','user_id','saldo'];
    public function bank(){
        return $this->hasOne(Bank::class,'bank_id','bank_id');
    }
    public function Buyer(){
        return $this->hasOne(Buyer::class,'user_id','user_id');
    }
}
