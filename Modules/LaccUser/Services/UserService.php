<?php
/**
 * File: UserService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 04/02/17
 * Time: 17:24
 * Project: lacc_editora
 * Copyright: 2017
 */
namespace LaccUser\Services;

class UserService
{

    public function setEncryptPassword( $password )
    {
        return bcrypt( trim( $password ) );
    }

    public function generateRemenberToken()
    {
        return str_random( 10 );
    }
}