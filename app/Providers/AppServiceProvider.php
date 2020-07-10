<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['app.locale' => 'id']);
        \Carbon\Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        Validator::extend('cek',function($attribute,$value,$parameters) {
            $user = User::where('email',$value)->first();
            if($user === null){
                return TRUE;
            }else{
                return FALSE;
            }
        });

        Validator::extend('check',function($attribute,$value,$parameters) {
            $user = User::where('email',$value)->first();
            if($user === null){
                return FALSE;
            }else{
                return TRUE;
            }
        });
        
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
            return \Hash::check($value, current($parameters));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
