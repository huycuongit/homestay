<?php

// app/Http/Middleware/CheckPermissions.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermissions
{
    protected $actionMap = [
        'index' => [
            'index',
            'datatables',
            'active',
            'all',
            'post-command',
            'get-command',
            'shareholders',
            'checkin-datatables',
            'burnshow-datatables',
            'shareholder-datatables',
            'available-spots',
            'calendars',
            'instruments',

            'students',
            'classrooms',
            'filter',
            'filters',
            'coaches',

            'import',
            'view-import',

            'promotion-detail',
            'get-date',
            'get-status',
            'product-detail',
            'get-members'
        ],

        'create' => [
            'create',
            'store',
            'permissions',
            'create-student',
            'create-client'
        ],

        'edit' => [
            'edit',
            'update',
            'histories',
            'instruments',
            'class-lessons',
            'shareholders',
            'show',
            'confirm-in-class',
            'confirm-not-yet-class',
            'cancel',
            'shareholder-history',
            'shareholder-practice-history',
            'update-session'
        ],

        'destroy' => ['destroy'],
        'generals' => ['generals'],
        'services' => ['services'],
        'socials' => ['socials'],
        'contacts' => ['contacts'],
        'opengraphs' => ['opengraphs'],
        'pages' => ['pages'],
        'consoles' => ['consoles', 'run'],
        'config-shareholders' => ['config-shareholders'],
        'opts' => ['opts'],
        'notifications' => ['notifications']
    ];

    public function handle($request, Closure $next)
    {
        $routeName = $request->route()->getName();
        $segments = explode('.', $routeName);

        if (count($segments) < 3) {
            abort(403, 'Unauthorized action.');
        }

        $resource = $segments[1];
        $action = $segments[2];

        $permission = $this->getMappedPermission($resource, $action);

        $admin = Auth::user();

        if (!$admin || !$admin->hasPermission($permission)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

    protected function getMappedPermission($resource, $action)
    {
        foreach ($this->actionMap as $key => $actions) {
            if (in_array($action, $actions)) {
                return "admin.{$resource}.{$key}";
            }
        }
        return "admin.{$resource}.{$action}";
    }
}
