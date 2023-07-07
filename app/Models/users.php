<?php

namespace App\Models;

use App\Models\account;
use App\Models\loan;
use Illuminate\Database\Eloquent\Model;


class users extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'lastname',
        'email',
        'phoneNumber',
        'password',
        'remember_token',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 
    ];
    public function loans(){
        return $this->hasMany(loan::class);
    }
    public function account(){
        return $this->hasOne(account::class);
    }
}
