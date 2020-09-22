<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Income extends Model
{
    use HasFactory;
    protected $primaryKey='detail_income_id';
    protected $fillable=['product_id','quantity','price','income_id'];
}
