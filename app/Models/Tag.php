<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;
    public function jobs()
    {
        return $this->belongsToMany(Job::class , relatedPivotKey: 'job_listing_id');
        // our class name is job and laravel thinks that the foreign key name should be 'job_id' bu out jobs in jobs_listings
        // to get all the jobs tagged with this tag -> $tag->jobs()->get()
        // to get only titles of the jobs -> $tag->jobs()->get()->pluck('title')
    }
}
