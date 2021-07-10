<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pengumuman
 * @package App\Models
 * @version July 10, 2021, 4:24 am WIB
 *
 * @property string title
 * @property string content
 * @property integer status
 */
class Pengumuman extends Model
{
    use SoftDeletes;

    public $table = 'pengumumen';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'content',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'content' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'content' => 'required'        
    ];

    
}
