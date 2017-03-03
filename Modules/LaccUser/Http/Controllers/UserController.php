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
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users = $this->userRepository->paginate( 10 );

        return view( 'laccuser::users.index', compact( 'users' ) );
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roles = $this->roleRepository->lists( 'name', 'id' );// @see trait BaseRepositoryTrait
        return view( 'laccuser::users.create', compact( 'roles' ) );
    }

    /**
     * @param UserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( UserRequest $request )
    {
        try {
            $this->bd->beginTransaction();
            $data               = $request->all();
            $data[ 'password' ] = $this->userService->setEncryptPassword( '123456' );
            $user               = $this->userRepository->create( $data );
            if ( !empty( $data[ 'roles' ][ 0 ] ) ) {
                $user->roles()->sync( $data[ 'roles' ] );
            }
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
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit( $id )
    {
        $user  = $this->userRepository->find( $id );
        $roles = $this->roleRepository->lists( 'name', 'id' );// @see trait BaseRepositoryTrait
        return view( 'laccuser::users.edit', compact( 'user', 'roles' ) );
    }

    /**
     * @param UserRequest $request
     * @param             $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( UserRequest $request, $id )
    {
        try {
            $this->bd->beginTransaction();
            $data = $request->all();
            $user = $this->userRepository->update( $data, $id );
            if ( isset( $data[ 'roles' ] ) && empty( !$data[ 'roles' ][ 0 ] ) ) {
                $user->roles()->sync( $data[ 'roles' ] );
            }
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
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( $id )
    {
        $this->userRepository->delete( $id );
        $this->request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => "User successfully deleted!" ] );

        return redirect()->route( $this->urlTo );
    }
}
