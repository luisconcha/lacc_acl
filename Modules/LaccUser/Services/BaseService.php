<?php
/**
 * File: BaseService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 04/02/17
 * Time: 17:11
 * Project: lacc_editora
 * Copyright: 2017
 */
namespace LaccUser\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class BaseService
{
    public function verifiesTheExistenceOfObject( $repository, $id, $with = null )
    {
        if ( !( $object = $repository->find( $id ) ) ) {
            throw new ModelNotFoundException( 'Object not found' );
        }

        return $object = $repository->with( $with )->find( $id );
    }

}