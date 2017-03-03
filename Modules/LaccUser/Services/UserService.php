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

class UserService extends BaseService
{

    public function setEncryptPassword( $password )
    {
        return bcrypt( trim( $password ) );
    }

    public function generateRemenberToken()
    {
        return str_random( 10 );
    }

    /**
     * Prepara campo de role para adicionar cor de fundo quando existe role na listagem de usuários
     *
     * @param $users
     *
     * @return mixed
     */
    public function prepareListRoles( $users )
    {
        foreach ( $users as $user ) {
            if ( $user->roles ) {
                foreach ( $user->roles as $role ) {
                    $role->name = "<span class='label' style='background-color: $role->cor'>" . $role->name . "</span>";
                }
            }
        }

        return $users;
    }
}