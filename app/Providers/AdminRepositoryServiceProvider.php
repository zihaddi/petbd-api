<?php

namespace App\Providers;

use App\Interfaces\Admin\AuthRepositoryInterface;
use App\Repositories\Admin\AuthClientRepository as AdminAuthClientRepository;
use App\Interfaces\Admin\AuthClientRepositoryInterface as AdminAuthClientRepositoryInterface;
use App\Interfaces\Admin\RolePermissionRepositoryInterface;
use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Interfaces\Admin\TreeEntityRepositoryInterface;
use App\Interfaces\Admin\UserRepositoryInterface;
use App\Repositories\Admin\AuthRepository;
use App\Repositories\Admin\RolePermissionRepository;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\TreeEntityRepository;
use App\Repositories\Admin\UserRepository;




use Illuminate\Support\ServiceProvider;
use App\Interfaces\Admin\PetRepositoryInterface;
use App\Repositories\Admin\PetRepository;
use App\Interfaces\Admin\OrganizationRepositoryInterface;
use App\Repositories\Admin\OrganizationRepository;
use App\Interfaces\Admin\GroomerProfileRepositoryInterface;
use App\Repositories\Admin\GroomerProfileRepository;
use App\Interfaces\Admin\ServiceRepositoryInterface;
use App\Repositories\Admin\ServiceRepository;
use App\Interfaces\Admin\AppointmentRepositoryInterface;
use App\Repositories\Admin\AppointmentRepository;


class AdminRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(AdminAuthClientRepositoryInterface::class, AdminAuthClientRepository::class);
        $this->app->bind(TreeEntityRepositoryInterface::class, TreeEntityRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(RolePermissionRepositoryInterface::class, RolePermissionRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        // Event Management Bindings


         $this->app->bind(PetRepositoryInterface::class, PetRepository::class);
        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
        $this->app->bind(GroomerProfileRepositoryInterface::class, GroomerProfileRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
