<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider', 'provider_id', 'perm_id', 'alamat', 'jk', 'tempat_lahir', 'tgl_lahir', 'kelas', 'jurusan', 'wali_kelas', 'link', 'jurusan_id', 'aktifkan'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function perm()
    {
        return $this->belongsTo('App\Models\Perm', 'perm_id');
    }

    public function jurusane()
    {
        return $this->belongsTo('App\Models\Jurusan', 'jurusan_id');
    }

    public function ujiane()
    {
        return $this->hasMany('App\Models\Ujian');
    }

    public function materies()
    {
        return $this->hasMany('App\Models\Materi');
    }

    public function servers()
    {
        return $this->hasMany('App\Models\Server');
    }

    public function siswas()
    {
        return $this->hasMany('App\Models\Siswa');
    }

    public function identitas()
    {
        return $this->hasOne('App\Models\Identitas');
    }

    public function pengaturans()
    {
        return $this->hasOne('App\Models\Pengaturan');
    }

    public function sesis()
    {
        return $this->hasMany('App\Models\Sesi');
    }    
}
