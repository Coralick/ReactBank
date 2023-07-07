<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'cash',
        'users_id',
    ];
    public function user(){
        return $this->belongsTo(users::class);
    }
}
