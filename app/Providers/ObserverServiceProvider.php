<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\CoachType;
use App\Observers\CoachTypeObserve;

use App\Models\Student;
use App\Observers\StudentObserver;

use App\Models\RatingCategory;
use App\Observers\RatingCategoryObserve;

use App\Models\RatingLevel;
use App\Observers\RatingLevelObserve;

use App\Models\Coach;
use App\Observers\CoachObserve;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
