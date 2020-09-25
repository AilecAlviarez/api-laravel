<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodPay extends Model
{
    use HasFactory;
    const ACH='1';
    const NOACH='0';
    protected $table='method_pays';
    protected $primaryKey='method_pay_id';
    protected $fillable=['type','description'];

}
