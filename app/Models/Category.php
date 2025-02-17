<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Get the doctors for the category.
     */
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
