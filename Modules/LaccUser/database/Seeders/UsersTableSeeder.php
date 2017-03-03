<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use LaccUser\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //        Model::unguard();
        factory( User::class )->create(
          [
            'name'           => 'Luis Alberto Concha Curay',
            'email'          => 'luvett11@gmail.com',
            'num_cpf'        => '12345678911',
            'password'       => bcrypt( '123456' ),
            'remember_token' => str_random( 10 ),
          ]
        );
        factory( User::class, 5 )->create();
    }
}
