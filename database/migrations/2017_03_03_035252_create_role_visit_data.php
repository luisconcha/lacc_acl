<?php
use Illuminate\Database\Migrations\Migration;
use LaccUser\Models\Role;
use LaccUser\Models\User;

class CreateRoleVisitData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleVisitant = Role::create( [
          'name'        => config( 'laccuser.acl.role_visitant' ),
          'cor'         => '#155b2a',
          'description' => 'Role of the visiting system user',
        ] );
        $user         = User::where( 'email', config( 'laccuser.user_default.email' ) )->first();
        $user->roles()->save( $roleVisitant );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleVisitant = Role::where( 'name', config( 'laccuser.acl.role_visitant' ) )->first();
        $user         = User::where( 'email', config( 'laccuser.user_default.email' ) )->first();
        $user->roles()->detach( $roleVisitant->id );
        //desabilita os relacionamento entre role admin e todas as permissões
        $roleVisitant->permissions()->detach();
        $roleVisitant->users()->detach();
        $roleVisitant->delete();
    }
}
