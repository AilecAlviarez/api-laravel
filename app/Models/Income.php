<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $primaryKey='income_id';
    protected $fillable=['user_id'];
    public function provider(){
        return $this->hasOne(User::class,'user_id','user_id');
    }
    public function detail_income(){
        return $this->hasMany(Detail_Income::class,'income_id','income_id');
    }
}
