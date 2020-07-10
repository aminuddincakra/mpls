<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $table = 'logs';
    public $timestamps = true;
   
    public $fillable = [
        'user_id', 'text', 'created_at'
    ];
}
