<?php

namespace App\Models;

use App\Scopes\AdminScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends User
{
    use HasFactory;
   protected $table='users';
   protected static function boot()
   {
       parent::boot();
       // TODO: Change the autogenerated stub
       static::addGlobalScope(new AdminScope);
   }
    public function incomes(){
        return $this->hasMany(Income::class,'user_id','user_id');
    }


}
