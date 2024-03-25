<?php

namespace App\Providers;

use App\Models\Administrador;
use App\Models\Centro;
use App\Models\Proyecto;
use App\Models\Profesor;
use App\Models\Provedor;
use App\Models\TipoPago;
use App\Models\TipoProyecto;
use App\Models\Ubpp;
use App\Models\User;
use App\Policies\AdministradorPolicy;
use App\Policies\CentroPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\ProyectoPolicy;
use App\Policies\ProfesorPolicy;
use App\Policies\RolePolicy;
use App\Policies\TipoProyectoPolicy;
use App\Policies\UbppPolicy;
use App\Policies\UserPolicy;
use App\Policies\ProvedorPolicy;
use App\Policies\TipoPagoPolicy;

use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Contracts\Role;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Permission::class => PermissionPolicy::class,
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        
        Centro::class => CentroPolicy::class,
        Ubpp::class => UbppPolicy::class,
        TipoProyecto::class => TipoProyectoPolicy::class,
        Profesor::class => ProfesorPolicy::class,
        Proyecto::class => ProyectoPolicy::class,
        Provedor::class => ProvedorPolicy::class,
        Recibo::class => ReciboPolicy::class,
        TipoPago::class => TipoPagoPolicy::class,
        Administrador::class => AdministradorPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
