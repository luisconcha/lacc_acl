<?php
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\LaccUser\Models\User::class)->create(
            [
                'name' => 'Luis Alberto Concha Curay',
                'email' => 'luvett11@gmail.com',
                'password' => $password = bcrypt('123456'),
                'num_cpf' => '12345678955',
                'remember_token' => str_random(100),
            ]
        );

        factory(\LaccUser\Models\User::class)->create(
            [
                'name' => 'Visitant',
                'email' => 'visitant@gmail.com',
                'password' => $password = bcrypt('123456'),
                'num_cpf' => '55545678955',
                'remember_token' => str_random(100),
            ]
        );


        //factory(\LaccUser\Models\User::class, 5)->create();
    }
}
