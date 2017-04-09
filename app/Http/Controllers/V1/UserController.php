<?php

namespace App\Http\Controllers\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepository;

class UserController extends Controller
{
    /**
     * Instance of UserRepository
     *
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->findBy($request->all());

        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->userRepository->save($request->all());

        if (!$user instanceof User) {
            return $this->sendCustomResponse(500, 'Error occurred on creating User');
        }

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findOne($id);

        if (!$user instanceof User) {
            return $this->sendNotFoundResponse("The user with id {$id} doesn't exist");
        }

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->userRepository->findOne($id);

        if (!$user instanceof User) {
            return $this->sendNotFoundResponse("The user with id {$id} doesn't exist");
        }

        $user = $this->userRepository->update($user, $request->all());

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findOne($id);

        if (!$user instanceof User) {
            return $this->sendNotFoundResponse("The user with id {$id} doesn't exist");
        }

        $this->userRepository->delete($user);

        return response()->json(null, 204);
    }
}
