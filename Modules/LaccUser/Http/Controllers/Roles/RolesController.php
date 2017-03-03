<?php
/**
 * File: RolesController.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 03/03/17
 * Time: 12:32
 * Project: lacc_laravel_acl
 * Copyright: 2017
 */
namespace LaccUser\Http\Controllers\Roles;

use Illuminate\Database\QueryException;
use Illuminate\Database\Connection;
use Illuminate\Http\Request;
use LACC\Http\Controllers\Controller;
use LaccUser\Http\Requests\RoleRequest;
use LaccUser\Repositories\RoleRepository;
use LaccUser\Services\RoleService;
use LaccUser\Annotations\Mapping as Permission;

/**
 * Class RolesController
 * @package LaccUser\Http\Controllers\Roles
 * @Permission\Controller(name="roles-admin", description="Manage user roles")
 */
class RolesController extends Controller
{
    /**
     * @var Connection
     */
    protected $bd;

    /**
     * @var RoleService
     */
    protected $roleService;

    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    protected $with = [];

    public function __construct( Connection $connection, RoleService $roleService, RoleRepository $roleRepository )
    {
        $this->bd             = $connection;
        $this->roleService    = $roleService;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @Permission\Action(name="list-roles", description="View list of user roles")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = $this->roleRepository->paginate( 10 );

        return view( 'laccuser::roles.index', compact( 'roles' ) );
    }

    public function create()
    {
        return view( 'laccuser::roles.create' );
    }

    public function store( RoleRequest $request )
    {
        $data = $request->all();
        $this->roleRepository->create( $data );
        $request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => "Role '{$data['name']}' successfully registered!" ] );

        return redirect()->route( 'laccuser.roles.index' );
    }

    public function edit( $id )
    {
        $role  = $this->roleService->verifiesTheExistenceOfObject( $this->roleRepository, $id, $this->with );

        return view( 'laccuser::roles.edit', compact( 'role' ) );
    }

    public function update( RoleRequest $request, $idRole )
    {
        $this->roleService->verifiesTheExistenceOfObject( $this->roleRepository, $idRole, $this->with );
        $data = $request->all();
        $this->roleRepository->update( $data, $idRole );
        $request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => "Role '{$data['name']}' successfully updated!" ] );

        return redirect()->route( 'laccuser.roles.index' );
    }

    public function destroy( $id, Request $request )
    {
        try {
            $this->roleService->verifiesTheExistenceOfObject( $this->roleRepository, $id, $this->with );
            $this->roleRepository->delete( $id );
            $request->session()->flash( 'message', [ 'type' => 'success', 'msg' => 'Role deleted successfully!' ] );
        } catch ( QueryException $ex ) {
            $request->session()->flash( 'error',
              [
                'type' => 'danger',
                'msg'  => 'The user role can not be deleted. It is related to other records.',
              ] );
        }

        return redirect()->route( 'laccuser.roles.index' );
    }

}