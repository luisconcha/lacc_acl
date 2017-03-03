<?php
return [
  'name'         => 'LaccUser',
  'user_default' => [
    'name'     => env( 'USER_NAME', 'Administrator Geral' ),
    'email'    => env( 'USER_EMAIL', 'superadmin@gmail.com' ),
    'password' => env( 'USER_PASSWORD', '123456' ),
    'num_cpf'  => env( 'USER_CPF', '12345678944' ),
    'num_rg'   => env( 'USER_RG', 'RG-456456' ),
  ],
];
