<?php 

namespace App\Services;

use App\Models\Patient;

class PatientService
{
    /**
     * @var App\Models\Patient $patient
     */
    protected $patient;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    /**
     * Get all patients
     */
    public function getAllPatients()
    {
        try{
            $patients = $this->patient->all();
            return $patients;

        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get patient by id
     */
    public function getPatientById($id)
    {
        try{
            $patient = $this->patient->find($id);
            return $patient;

        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Create a new patient
     */
    public function createPatient($name, $email, $password, $zipcode, $addressone, $addresstwo, $phone_number, $role_id)
    {
        try{
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'zip_code' => $zipcode,
                'addressone' => $addressone,
                'addresstwo' => $addresstwo,
                'phone_number' => $phone_number,
                'role_id' => $role_id
            ];
            
            $patient = $this->patient->create($data);

            return $patient;

        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Update patient
     */
    public function updatePatient($name, $email, $password, $zipcode, $addressone, $addresstwo, $phone_number, $id)
    {
        try{
            $patient = $this->patient->find($id);

            $patient->name = $name;
            $patient->zip_code = $zipcode;
            $patient->addressone = $addressone;
            $patient->addresstwo = $addresstwo;
            $patient->phone_number = $phone_number;

            $patient->save();

            return $patient;

        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Delete patient
     */
    public function deletePatient($id)
    {
        try{
            $patient = $this->patient->find($id);
            $patient->delete();

            return $patient;

        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    
    
}