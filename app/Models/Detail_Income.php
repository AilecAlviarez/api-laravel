<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Income extends Model
{
    use HasFactory;
    protected $primaryKey='detail_income_id';
    protected $table='detail_incomes';
    protected $fillable=['product_id','quantity','price','income_id'];
    public function inventary(){
        return $this->hasOneThrough(Inventary::class,Product::class,'product_id','product_id');
    }
}
