<?php
namespace LaccUser\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connection;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use LaccUser\Http\Requests\UserRequest;
use LaccUser\Repositories\RoleRepository;
use LaccUser\Repositories\UserRepository;
use LaccUser\Services\UserService;
use LaccUser\Annotations\Mapping as Permission;

/**
 * Class UsersController
 * @package LaccUser\Http\Controllers
 * @Permission\Controller(name="users-admin", description="User administration")
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var  RoleRepository
     */
    protected $roleRepository;

    /**
     * @var Connection
     */
    protected $bd;

    /**
     * @var Request
     */
    protected $request;

    protected $urlTo = 'laccuser.users.index';

    protected $with = [];

    public function __construct(
      Connection $connection,
      UserRepository $userRepository,
      UserService $userService,
      RoleRepository $roleRepository,
      Request $request
    ) {
        $this->bd             = $connection;
        $this->userRepository = $userRepository;
        $this->userService    = $userService;
        $this->roleRepository = $roleRepository;
        $this->request        = $request;
    }

    /**
     * @Permission\Action(name="list", description="View user list")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->userService->prepareListRoles( $this->userRepository->paginate( 10 ) );

        return view( 'laccuser::users.index', compact( 'users' ) );
    }

    /**
     * @Permission\Action(name="create-users", description="Create users")
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->roleRepository->lists( 'name', 'id' );// @see trait BaseRepositoryTrait
        return view( 'laccuser::users.create', compact( 'roles' ) );
    }

    /**
     * @param UserRequest $request
     * @Permission\Action(name="create-users", description="Create users")
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( UserRequest $request )
    {
        try {
            $this->bd->beginTransaction();
            $data               = $request->all();
            $data[ 'password' ] = $this->userService->setEncryptPassword( '123456' );
            $this->userRepository->create( $data );
            $this->bd->commit();
            $request->session()->flash( 'message',
              [ 'type' => 'success', 'msg' => "User '{$data['name']}' successfully registered!" ] );
        } catch ( \Exception $e ) {
            $this->bd->rollBack();
            $request->session()->flash( 'error',
              [ 'type' => 'danger', 'msg' => 'There was an error in the request, please try again later.' ] );
        }

        return redirect()->route( $this->urlTo );
    }

    /**
     * @param $id
     * @Permission\Action(name="update-users", description="Update users")
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit( $id )
    {
        $user  = $this->userService->verifiesTheExistenceOfObject( $this->userRepository, $id, $this->with );
        $roles = $this->roleRepository->lists( 'name', 'id' );// @see trait BaseRepositoryTrait
        return view( 'laccuser::users.edit', compact( 'user', 'roles' ) );
    }

    /**
     * @param UserRequest $request
     * @param             $id
     * @Permission\Action(name="update-users", description="Update users")
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( UserRequest $request, $id )
    {
        $this->userService->verifiesTheExistenceOfObject( $this->userRepository, $id, $this->with );
        try {
            $this->bd->beginTransaction();
            $data = $request->except( [ 'password' ] );
            $this->userRepository->update( $data, $id );
            $this->bd->commit();
            $request->session()->flash( 'message',
              [ 'type' => 'success', 'msg' => "User '{$data['name']}' successfully updated!" ] );
        } catch ( \Exception $e ) {
            $this->bd->rollBack();
            $request->session()->flash( 'error',
              [ 'type' => 'danger', 'msg' => 'There was an error in the request, please try again later!' ] );
        }

        return redirect()->route( $this->urlTo );
    }

    /**
     * @param $id
     * @Permission\Action(name="destroy-user", description="Destroy user data")
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( $id )
    {
        $this->userService->verifiesTheExistenceOfObject( $this->userRepository, $id, $this->with );
        $this->userRepository->delete( $id );
        $this->request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => "User successfully deleted!" ] );

        return redirect()->route( $this->urlTo );
    }
}
