<?php 

namespace App\Services;

use App\Models\Doctor;

class DoctorService
{
    /**
     * @var App\Models\Doctor $doctor
     */
    protected $doctor;

    public function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor; 
    }

    /**
     * Get all doctors
     */
    public function getAllDoctors()
    {
        try{
            $doctors = $this->doctor->all();
            return $doctors;
        }catch(\Exception $e){      
            throw new \Exception($e->getMessage());
        }
    }
    
    /**
     * Create a doctor
     */
    public function createDoctor($name, $email, $password, $zipcode, $addressone, $addresstwo, $phone_number, $role_id, $category_id, $bio)
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
                'role_id' => $role_id,
                'category_id' => $category_id,
                'bio' => $bio
            ];

            $doctor = $this->doctor->create($data);

            return $doctor;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Get a doctor by id
     */
    public function getDoctorById($id)
    {
        try{
            $doctor = $this->doctor->find($id);

            return $doctor;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Update a doctor
     */
    public function updateDoctor($name, $phone_number, $zipcode, $addressone, $addresstwo, $bio, $id)
    {
        try{
            $doctor = $this->doctor->find($id);

            $doctor->name = $name;
            $doctor->phone_number = $phone_number;
            $doctor->zip_code = $zipcode;
            $doctor->addressone = $addressone;
            $doctor->addresstwo = $addresstwo;
            $doctor->bio = $bio;

            $doctor->save();

            return $doctor;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

    /**
     * Delete a doctor
     */
    public function deleteDoctor($id)
    {
        try{
            $doctor = $this->doctor->find($id);

            $doctor->delete();

            return $doctor;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    
}