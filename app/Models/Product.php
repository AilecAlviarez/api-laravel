<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $primaryKey='product_id';
    protected $fillable=['product_name','product_price','product_description','category_id'];
    public function detail_expences(){
        return $this->hasMany(Detail_Expence::class,'product_id','product_id');
    }
    public function category(){
        return $this->hasOne(Category::class);
    }
    public function inventary(){
        return $this->hasOne(Inventary::class,'product_id','product_id');
    }
}
