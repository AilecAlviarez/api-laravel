<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveries extends Model
{
    use HasFactory;
    protected $primaryKey='delivery_id';
    protected $table='deliveries';
    protected $fillable=['delivery_address','date_come'];
   /* public function expence(){
        return $this->hasOne(Expence::class,'delivery_id','delivery_id');
    }*/
}
