<?php
namespace LaccUser\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use LaccUser\Http\Requests\UserRequest;
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
     * @var Request
     */
    protected $request;

    protected $urlTo = 'laccuser.users.index';

    public function __construct( UserRepository $userRepository, UserService $userService, Request $request )
    {
        $this->userRepository = $userRepository;
        $this->userService    = $userService;
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
        return view( 'laccuser::users.create' );
    }

    /**
     * @param UserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( UserRequest $request )
    {
        $data               = $request->all();
        $data[ 'password' ] = $this->userService->setEncryptPassword( '123456' );
        $this->userRepository->create( $data );
        $request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => "User '{$data['name']}' successfully registered!" ] );

        return redirect()->route( $this->urlTo );
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit( $id )
    {
        $user = $this->userRepository->find( $id );

        return view( 'laccuser::users.edit', compact( 'user' ) );
    }

    /**
     * @param UserRequest $request
     * @param             $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( UserRequest $request, $id )
    {
        $data = $request->all();
        $this->userRepository->update( $data, $id );
        $request->session()->flash( 'message',
          [ 'type' => 'success', 'msg' => "User '{$data['name']}' successfully updated!" ] );

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
