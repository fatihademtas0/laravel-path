<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(JOB $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        // validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required', 'numeric'],
        ]);

        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        return redirect('/jobs');
    }

    public function edit(JOB $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(JOB $job)
    {
        // validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required',],
        ]);

        //$job->title = request('title');
        //$job->salary = request('salary');
        //$job->save();
        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        return redirect('/jobs/' .  $job->id);
    }

    public function destroy(JOB $job)
    {
        $job->delete();

        return redirect('/jobs');
    }
}
