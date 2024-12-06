<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model {
    use HasFactory;

    protected $table = 'job_listings';

    //protected $fillable = ['employer_id','title','salary'];
    protected $guarded = []; // nothing is guarded for mass assignment or you can use fillable

    public function employer()
    {
        return $this->belongsTo(Employer::class); // php artisan tinker -->  $job->employer;
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class , foreignPivotKey:'job_listing_id');
        // our class name is job and laravel thinks that the foreign key name should be 'job_id' bu out jobs in jobs_listings
    }
};
