<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Perm
 * @package App\Models
 * @version October 24, 2017, 1:42 am UTC
 *
 */
class Perm extends Model
{

    public $table = 'perms';
    


    public $fillable = [
        'name', 'permission'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'          => 'required|unik',
    ];

    public static function cekUnik($val)
    {
        list(, $action) = explode('@', \Route::getCurrentRoute()->getActionName());
        if($action == 'store'){
            $kueri = DB::table('perms')->where('name',$val)->get();
            if(count($kueri) > 0){
                return FALSE;
            }else{
                return TRUE;
            }
        } else {
            return TRUE;
        }    
    }
}
