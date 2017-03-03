<?php
/**
 * File: PermissionsController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 03/03/17
 * Time: 12:32
 * Project: lacc_laravel_acl
 * Copyright: 2017
 */
namespace LaccUser\Http\Controllers\Roles;

use LACC\Http\Controllers\Controller;
use LaccUser\Annotations\Mapping as Permission;
use LaccUser\Criteria\FindPermissionsGroupCriteria;
use LaccUser\Criteria\FindPermissionsResourceCriteria;
use LaccUser\Http\Requests\PermissionRequest;
use LaccUser\Repositories\PermissionRepository;
use LaccUser\Repositories\RoleRepository;

/**
 * Class RolesController
 * @package LaccUser\Http\Controllers\Roles
 * @Permission\Controller(name="permissions-admin", description="Manage permissions assigned to user roles")
 */
class PermissionsController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    public function __construct(
      RoleRepository $roleRepository,
      PermissionRepository $permissionRepository
    ) {
        $this->roleRepository       = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param $id
     * @Permission\Action(name="edit-role-permissions", description="Edit role permissions")
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPermissions( $id )
    {
        $role = $this->roleRepository->find( $id );
        //
        $this->permissionRepository->pushCriteria( new FindPermissionsResourceCriteria() );
        $permissions = $this->permissionRepository->all();
        $this->permissionRepository->resetCriteria();//reset para não empilhar os critérios
        //
        $this->permissionRepository->pushCriteria( new FindPermissionsGroupCriteria() );
        $permissionsGroup = $this->permissionRepository->all( [ 'name', 'description' ] );

        return view( 'laccuser::roles.permissions', compact( 'role', 'permissions', 'permissionsGroup' ) );
    }

    /**
     * @param PermissionRequest $request
     * @param                   $id
     * @Permission\Action(name="edit-role-permissions", description="Edit role permissions")
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePermissions( PermissionRequest $request, $id )
    {
        $data = $request->only( 'permissions' );
        $this->roleRepository->update( $data, $id ); //overwrite method update  RoleRepositoryEloquent
        $request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => "Successfully assigned permissions!" ] );

        return redirect()->route( 'laccuser.roles.index' );
    }

}