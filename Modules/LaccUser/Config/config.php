<?php
return [
  'name'         => 'LaccUser',
  'user_default' => [
    'name'     => env( 'USER_NAME', 'Administrator' ),
    'email'    => env( 'USER_EMAIL', 'admin@gmail.com' ),
    'password' => env( 'USER_PASSWORD', '123456' ),
    'num_cpf'  => env( 'USER_CPF', '12345678909' ),
    'num_rg'   => env( 'USER_RG', 'RG-456456' ),
  ],
];
