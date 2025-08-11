<?php

namespace App\Providers;

use App\Repositories\BranchRepository;
use App\Repositories\BranchRepositoryInterface;
use Illuminate\Support\ServiceProvider;

use App\Repositories\System\SystemRepository;
use App\Repositories\System\SystemRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\RoleRepository;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\ImageRepository;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\PageRepository;
use App\Repositories\PageRepositoryInterface;
use App\Repositories\PrivacyPolicyRepository;
use App\Repositories\PrivacyPolicyRepositoryInterface;
use App\Repositories\CommitRepository;
use App\Repositories\CommitRepositoryInterface;
use App\Repositories\GalleryRepository;
use App\Repositories\GalleryRepositoryInterface;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\NewsRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\ServiceRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(SystemRepositoryInterface::class, SystemRepository::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(SystemRepositoryInterface::class, SystemRepository::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BranchRepositoryInterface::class, BranchRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);

        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);

        $this->app->bind(CommitRepositoryInterface::class, CommitRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class, GalleryRepository::class);
        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
