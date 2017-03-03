<?php
/**
 * File: UserRepositoryEloquent.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 02/03/17
 * Time: 22:12
 * Project: lacc_laravel_acl
 * Copyright: 2017
 */
namespace LaccUser\Repositories;

use LaccUser\Models\User;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{

    protected $fieldSearchable = [];

    public function model()
    {
        return User::class;
    }

    public function update( array $attributes, $id )
    {
        $user = parent::update( $attributes, $id );
        if ( isset( $attributes[ 'roles' ] ) && empty( !$attributes[ 'roles' ][ 0 ] ) ) {
            $user->roles()->sync( $attributes[ 'roles' ] );
        }

        return true;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app( RequestCriteria::class ) );
    }
}