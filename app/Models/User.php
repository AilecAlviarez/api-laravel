<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    const ADMIN='1';
    const NOADMIN='0';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey='user_id';
    protected $fillable = [
        'user_name', 'user_email', 'user_password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function expences(){
        $this->hasMany(Expence::class,'user_id','user_id');
    }

}
