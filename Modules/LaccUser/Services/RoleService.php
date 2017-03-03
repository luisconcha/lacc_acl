<?php
/**
 * File: RoleService.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 03/03/17
 * Time: 12:34
 * Project: lacc_laravel_acl
 * Copyright: 2017
 */
namespace LaccUser\Services;

use LaccUser\Models\Role;

class RoleService
{
    /**
     * @var Role
     */
    protected $roleModel;

    public function __construct( Role $role )
    {
        $this->roleModel = $role;
    }

}