<?php

namespace App\Providers;

use App\User;
use App\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Notificacao;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
       // 'App\Model' => 'App\Policies\ModelPolicy',
       // 'App\Legislacao' => 'App\Policies\AdminPolicy',
       // 'App\Legislacao' => 'App\Policies\ProfessorPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('edit-comentario',function (User $user, Notificacao $post){
                return $user->id == $post->users_id;
        });


       $permissions = Permission::with('roles')->get();
       foreach ($permissions as $permission){
           $gate->define($permission->name,function (User $user) use ($permission){
               return $user->hasPermission($permission);
           });
       }

       $gate->before(function(User $user, $ability){
         return  $user->hasAnyRoles('administrador');
       }

       );
    }
}
