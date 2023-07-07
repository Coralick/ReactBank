<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'sum',
        'users_id',
    ];
    public function user(){
        return $this->belongsTo(users::class);
    }
}
