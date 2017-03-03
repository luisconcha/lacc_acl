<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define( \LaccUser\Models\User::class, function ( Faker\Generator $faker ) {
    static $password;
    return [
      'name'           => 'Luis Alberto Concha Curay',
      'email'          => 'luvett11@gmail.com',
      'password'       => $password ? : $password = bcrypt( '123456' ),
      'num_cpf'        => '12345678955',
      'remember_token' => str_random( 100 ),
    ];
} );

$factory->define( \LaccUser\Models\User::class, function ( Faker\Generator $faker ) {
    static $password;
    return [
      'name'           => 'Visitant',
      'email'          => 'visitant@gmail.com',
      'password'       => $password ? : $password = bcrypt( '123456' ),
      'num_cpf'        => '55545678955',
      'remember_token' => str_random( 100 ),
    ];
} );
