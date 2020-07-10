<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * @package App\Models
 * @version July 10, 2020, 7:25 am WIB
 *
 * @property string name
 * @property string text
 * @property integer status
 * @property integer pinned
 * @property string embed
 */
class Post extends Model
{
    //use SoftDeletes;

    public $table = 'posts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'text',
        'status',
        'pinned',
        'embed',
        'jurusan_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'text' => 'string',
        'status' => 'integer',
        'pinned' => 'integer',
        'embed' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',        
    ];

    
}
