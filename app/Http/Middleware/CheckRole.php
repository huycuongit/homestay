<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::guard('admin')->check() || !$request->user('admin')->hasRole($role)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
