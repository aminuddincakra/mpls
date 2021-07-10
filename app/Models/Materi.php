<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Materi
 * @package App\Models
 * @version July 10, 2021, 9:06 am WIB
 *
 * @property string title
 * @property string content
 * @property date date
 */
class Materi extends Model
{
    use SoftDeletes;

    public $table = 'materis';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'content',
        'date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'content' => 'string',
        'date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'content' => 'required',
        'date' => 'required'
    ];

    
}
