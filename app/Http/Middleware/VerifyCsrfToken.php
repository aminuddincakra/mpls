<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'dashboard/user_status',
        'dashboard/copy_soal',
        'dashboard/get_share',
        'dashboard/subscribe',
        'dashboard/simpan-jawaban',
        'dashboard/selesai-ujian',
        'dashboard/simpan-waktu',
        'siswa/cek-sesi',
        'cbt/simpan-sinkron',
        'cbt/reg-server',
        'cbt/save-nilai',
        'api/login',
        'waktu-selesai'
    ];
}
