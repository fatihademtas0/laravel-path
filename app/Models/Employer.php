<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    /** @use HasFactory<\Database\Factories\EmployerFactory> */
    use HasFactory;

    public function jobs()
    {
        // this returns a collection because this can be an array with too many values
        // $employer->jobs->first();  returns first job
        // $employer->jobs; returns the collection
        return $this->hasMany(Job::class);
    }
}
