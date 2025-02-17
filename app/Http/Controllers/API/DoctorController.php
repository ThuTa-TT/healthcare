<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\DoctorService;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorCreateRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Http\Resources\DoctorResource;

class DoctorController extends Controller
{
    /**
     * @var App\Services\DoctorService $doctorService
     */
    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }
    
        
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $doctors = $this->doctorService->getAllDoctors();

            $response['code'] = 200;
            $response['data'] = DoctorResource::collection($doctors);
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
    public function store(DoctorCreateRequest $request)
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
            $category_id = $request->category_id;
            $bio = $request->bio;

        $doctor = $this->doctorService->createDoctor($name, $email, $password, $zipcode, $addressone, $addresstwo, $phone_number, $role_id, $category_id, $bio);

        $response['code'] = 200;
        $response['data'] = new DoctorResource($doctor);

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
            $doctor = $this->doctorService->getDoctorById($id);

            $response['code'] = 200;
            $response['data'] = new DoctorResource($doctor);
        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
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
    public function update(DoctorUpdateRequest $request, string $id)
    {
        try{
            $name = $request->name;
            $phone_number = $request->phone_number;
            $zipcode = $request->zipcode;
            $addressone = $request->addressone;
            $addresstwo = $request->addresstwo;
            $bio = $request->bio;   

            $doctor = $this->doctorService->updateDoctor($name, $phone_number, $zipcode, $addressone, $addresstwo, $bio, $id);

            $response['code'] = 200;    
            $response['data'] = new DoctorResource($doctor);

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
            $doctor = $this->doctorService->deleteDoctor($id);

            $response['code'] = 200;
            $response['message'] = 'Doctor deleted successfully';

        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
