<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Expence extends Model
{
    use HasFactory;
    protected $primaryKey='detail_expence_id';
    protected $fillable=['id_product','quantity','price','expence_id'];

}
