<?php

namespace App\Http\Controllers\API;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Exception;

class RoleController extends Controller
{
    /**
     * @var App\Models\Role
     */
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->role->all();

        $response['code'] = 200;
        $response['data'] = new RoleResource($roles);

        return $response;

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
    public function store(RoleRequest $request)
    {
        try{
            $name = $request->name;

            $role = $this->role->create([
                'name' => $name
            ]);

            $response['code'] = 200;
            $response['data'] = new RoleResource($role);

        }catch(Exception $e){
            $response['code'] = 500;
            $response['messsage'] = $e->getMessage();
        }
        
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return new RoleResource($role);
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
    public function update(RoleRequest $request, Role $role)
    {
       try{
            $role->update([
                'name' => $request->name
            ]);

            $response['code'] = 200;
            $response['data'] = new RoleResource($role);
       }catch(Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();

       }

       return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try{
            $role_deleted = $role->destroy($role);

            if($role_deleted){
                return [
                    'code' => '200',
                    'message' => 'Role Successfully Deleted.'
                ];
            }
        }catch(Exception $e){
            return [
                'code' => '500',
                'message' => $e->getMessage()
            ];
        }
    }
}
