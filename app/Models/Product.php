<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['product_id','product_name','product_price','product_description','category_id'];
    public function detail_expences(){
        return $this->hasMany(Detail_Expence::class,'product_id','product_id');
    }
    public function category(){
        return $this->hasOne(Category::class);
    }
}
