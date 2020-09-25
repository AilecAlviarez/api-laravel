<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $primaryKey='bank_id';
    protected $table='banks';
    protected $fillable=['bank_name','method_pay_id'];
    public function accounts(){
        return $this->hasMany(Account::class,'bank_id','bank_id');
    }
}
