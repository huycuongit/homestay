<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    //Lê Minh Đường cập nhật ngày 25/01/2024
    //Lê Minh Đường cập nhật ngày 29/01/2024
    protected $except = [
        //
        '/contentblogmain/*',
        '/contentheadermain/*',
		'/contentfootermain/*',
        '/contentelementmain/*',
        '/contentpagemain/*',
		'/contentsubmissionmain/*',
        'ckfinder/*',
    ];
}
