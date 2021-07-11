<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $table = 'activities';

    public $fillable = [
        'post_id', 'user_id', 'date'
    ];
}
