<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer') // employer ilişkisini de yüklüyoruz
        ->orderBy('id', 'asc') // id'ye göre sıralama, 'asc' artan sıralama
        ->simplePaginate(3); // Sayfalama, her sayfada 3 iş

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
//        if(Gate::denise('edit-job', $job)) ALTERNATİVE OR İF THE USER İS UNAUTHORİZED DO SOMETHİNG
//        {
//            //
//        }

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(JOB $job)
    {
        Gate::authorize('edit-job', $job);

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
        Gate::authorize('edit-job', $job);
        $job->delete();

        return redirect('/jobs');
    }
}
