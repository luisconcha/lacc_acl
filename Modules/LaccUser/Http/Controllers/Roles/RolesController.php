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

use Illuminate\Database\Connection;
use Illuminate\Http\Request;
use LACC\Http\Controllers\Controller;
use LaccUser\Http\Requests\RoleRequest;
use LaccUser\Repositories\RoleRepository;
use LaccUser\Services\RoleService;

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

    public function __construct( Connection $connection, RoleService $roleService, RoleRepository $roleRepository )
    {
        $this->bd             = $connection;
        $this->roleService    = $roleService;
        $this->roleRepository = $roleRepository;
    }

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
        $role = $this->roleRepository->find( $id );

        return view( 'laccuser::roles.edit', compact( 'role' ) );
    }

    public function update( RoleRequest $request, $idRole )
    {
        $data = $request->all();
        $this->roleRepository->update( $data, $idRole );
        $request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => "Role '{$data['name']}' successfully updated!" ] );

        return redirect()->route( 'laccuser.roles.index' );
    }

    public function destroy( $id, Request $request )
    {
        $this->roleRepository->delete( $id );
        $request->session()->flash( 'message', [ 'type' => 'success', 'msg' => 'Role deleted successfully!' ] );

        return redirect()->route( 'laccuser.roles.index' );
    }

}