<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\PatientService;
use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Http\Requests\PatientCreateRequest;
use App\Http\Requests\PatientUpdateRequest;

class PatientController extends Controller
{
    /**
     * @var App\Services\PatientService $patientService
     */
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $patients = $this->patientService->getAllPatients();

            $response['code'] = 200;
            $response['data'] = new PatientResource($patients);
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
    public function store(PatientCreateRequest $request)
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

            $patient = $this->patientService->createPatient($name, $email, $password, $zipcode, $addressone, $addresstwo, $phone_number, $role_id);

            $response['code'] = 200;
            $response['data'] = new PatientResource($patient);
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
            $patient = $this->patientService->getPatientById($id);

            $response['code'] = 200;
            $response['data'] = new PatientResource($patient);
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
    public function update(PatientUpdateRequest $request, string $id)
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

            $patient = $this->patientService->updatePatient($name, $email, $password, $zipcode, $addressone, $addresstwo, $phone_number, $role_id, $id);

            $response['code'] = 200;
            $response['data'] = new PatientResource($patient);
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
            $patient = $this->patientService->deletePatient($id);

            $response['code'] = 200;
            $response['message'] = 'Patient deleted successfully';
        }catch(\Exception $e){
            $response['code'] = 500;
            $response['message'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
