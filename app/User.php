<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permission;


class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','foto','perfil'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function usuario()
    {
        return $this->belongsTo('App\User','users_id');
    }

    public function perfil()
    {
        return $this->belongsTo('App\Perfil_user','perfil_users_id');
    }

    public function roles()
    {
     return  $this->belongsToMany('App\Role');

    }

    public function hasPermission(Permission $permission){
      return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles){
      if(is_array($roles) || is_object($roles)){
          foreach ($roles as $role){
           //return $this->hasAnyRoles($role);
          return $this->roles->contains('name', $role->name);
          }
      }
      return $this->roles->contains('name',$roles);
    }

}
