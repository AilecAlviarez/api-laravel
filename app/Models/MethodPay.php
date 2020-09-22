<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodPay extends Model
{
    use HasFactory;
    protected $primaryKey='method_pay_id';
    protected $fillable=['type','description','date_come'];
    protected $casts=[
        'date_come'=>'datetime:Y-m-d'
    ];
}
