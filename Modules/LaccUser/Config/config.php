<?php
return [
  'name'         => 'LaccUser',
  'user_default' => [
    'name'     => env( 'USER_NAME', 'Administrator Geral' ),
    'email'    => env( 'USER_EMAIL', 'superadmin@gmail.com' ),
    'password' => env( 'USER_PASSWORD', bcrypt( 123456 ) ),
    'num_cpf'  => env( 'USER_CPF', '33355577755' ),
  ],
  'acl'          => [
    'role_admin'              => env( 'ROLE_ADMIN', 'Admin' ),
    'role_visitant'           => env( 'ROLE_VISITANT', 'Visitant' ),
    'controllers_annotations' => [],
  ],
];
