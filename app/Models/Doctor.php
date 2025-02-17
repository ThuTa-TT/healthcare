<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'zip_code', 
        'address_one', 
        'address_two', 
        'phone_number', 
        'role_id', 
        'category_id', 
        'bio'
    ];

    /**
     * Get the role that owns the doctor.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the category that owns the doctor.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
