<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

use App\Models\Branch;
use App\Models\System;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $setups = System::get();
            $arrSetups = [];
            if ($setups != null) {
                foreach ($setups as $setup) {
                    $arrSetups[$setup->key] = $setup->content;
                }
            }

            // User permistion
            $userPermissions = [];
            if (Auth::check()) {
                $userPermissions =
                    Auth::user()->getAllCheckPermissions()->toArray();
            }
            $composerSystem = [
                'arrSetups' => $arrSetups,
                'userPermissions' => $userPermissions,
                'auth' => Auth::user()
            ];

            $view->with($composerSystem);
        });
    }
}
