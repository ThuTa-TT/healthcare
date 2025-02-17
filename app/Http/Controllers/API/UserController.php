<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @var App/Services/UserService $userService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $users = $this->userService->getAllUsers();

            $response['code'] = 200;
            $response['data'] = UserResource::collection($users);
            
        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }
            
        return response()->json($response);
    }
            
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateRequest $request)
    {
        try{
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $zipcode = $request->zipcode;
            $addressone = $request->addressone;
            $addresstwo = $request->addresstwo;
            $phone_number = $request->phone_number;
            $role_id = $request->role_id;

            $user = $this->userService->createUser($name, $email, $password, $zipcode, $addressone, $addresstwo, $phone_number, $role_id);

            $response['code'] = 200;
            $response['data'] = new UserResource($user);

        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }
        
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $user = $this->userService->getUserById($id);

            $response['code'] = 200;
            $response['data'] = new UserResource($user);
        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        try{
            $user = $this->userService->updateUser($request, $id);

            $response['code'] = 200;
            $response['data'] = new UserResource($user);
        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $user = $this->userService->deleteUser($id);

            $response['code'] = 200;
            $response['message'] = 'User deleted successfully';
        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
