<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventary extends Model
{
    use HasFactory;
    protected $table='inventary';
    protected $primaryKey='inventary_id';
    protected $fillable=['product_id','cant_product','stock_max','stock_min'];
    public function product(){
        return $this->hasOne(Product::class);
    }
}
