<?php 

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @var App\Models\User $user
     */
    protected $user;

    /**
     * @var App\Services\DoctorService $doctorService
    */
    protected $doctorService; 

    public function __construct(User $user, DoctorService $doctorService)
    {
        $this->user = $user;
        $this->doctorService = $doctorService;
    }

    /**
     * Get all users
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers()
    {
        return $this->user->all();
    }

    /**
     * Create a new user
     * 
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $zipcode
     * @param string $addressone
     * @param string $addresstwo
     * @param string $phone_number
     * @param int $role_id
     * 
     * @return App\Models\User
     */
    public function createUser($name, $email, $password, $zipcode, $addressone, $addresstwo, $phone_number, $role_id)
    {
        try{
            // dd($name, $email, $password, $zipcode, $addressone, $addresstwo, $phone_number, $role_id);  
            $user = $this->user->create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'zip_code' => $zipcode,
                'address_one' => $addressone,
                'address_two' => $addresstwo,
                'phone_number' => $phone_number,
                'role_id' => $role_id
            ]);

            if($role_id == 3){
                $this->doctorService->createDoctor($user->id);
            }

            return $user;
        }catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Get user by id
     * 
     * @param int $id
     * 
     * @return App\Models\User
     */
    public function getUserById($id)
    {
        return $this->user->find($id);
    }

    /**
     * Update user
     * 
     * @param Illuminate\Http\Request $request
     * @param int $id
     * 
     * @return App\Models\User
     */
    public function updateUser($request,$id)
    {
        try{
            $user = $this->getUserById($id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->zip_code = $request->zipcode;
            $user->address_one = $request->addressone;
            $user->address_two = $request->addresstwo;
            $user->phone_number = $request->phone_number;
            $user->role_id = $request->role_id;

            $user->save();

            return $user;
        }catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * Delete user
     * 
     * @param int $id
     * 
     * @return App\Models\User
     */
    public function deleteUser($id)
    {
        try{
            $user = $this->getUserById($id);

            $user->delete();

            return $user;
        }catch(\Exception $e){
            throw $e;
        }
    }
    
}