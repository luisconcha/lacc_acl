<?php

//namespace LaccUser\Models;
//
//use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
//
//class User extends Authenticatable
//{
//    use Notifiable;
//
//    /**
//     * The attributes that are mass assignable.
//     *
//     * @var array
//     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];
//
//    /**
//     * The attributes that should be hidden for arrays.
//     *
//     * @var array
//     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];
//}

namespace LaccUser\Models;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticable
{
    use FormAccessible, Notifiable, SoftDeletes;

    protected $dates = [ 'deleted_at' ];

    protected $fillable = [
      'name',
      'email',
      'num_cpf',
      'password',
    ];

    protected $hidden = [
      'password',
      'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany( Role::class );
    }

    /**
     * @param $role
     * Collection / String
     *
     * @return boolean
     */
    public function hasRole( $role )
    {
        return is_string( $role ) ?
          $this->roles->contains( 'name', $role ) :
          (boolean)$role->intersect( $this->roles )->count();
    }

    public function isAdmin()
    {
        return $this->hasRole( config( 'laccuser.acl.role_admin' ) );
    }

}