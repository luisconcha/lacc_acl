<?php
use Illuminate\Database\Migrations\Migration;
use LaccUser\Models\User;

class CreateUsersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        User::create( [
          'name'     => config( 'laccuser.user_default.name' ),
          'email'    => config( 'laccuser.user_default.email' ),
          'num_cpf'  => config( 'laccuser.user_default.num_cpf' ),
          'password' => bcrypt( config( 'laccuser.user_default.password' ) ),
        ] );
        \Illuminate\Database\Eloquent\Model::reguard();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::disableForeignKeyConstraints();
        $user = User::where( 'email', config( 'laccuser.user_default.email' ) )->first();
        $user->forceDelete();
        \Schema::enableForeignKeyConstraints();
    }
}
