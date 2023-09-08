<?php

namespace App\Http\Controllers;

use App\Events\NewJobCreated;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if ( auth()->user()->role === 'Client') {
            $jobs = Job::where('client_id', auth()->user()->id)->get()->sortBy('created_at', SORT_REGULAR, true);;

        } else {
            $jobs = Job::all()->sortBy('created_at', SORT_REGULAR, true);

        }
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store the job data
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric',
            'deadline' => 'required|date',
        ]);

        // Generate Permalink
        $permalink = Str::slug($data['title']);

        // Check if the permalink already exists, append a unique identifier
        $count = 1;
        while( Job::where('permalink', $permalink)->exists() ) {
            $permalink .= $count;
            $count++;
        }

        // Create the job
        $job = Job::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'budget' => $data['budget'],
            'deadline' => $data['deadline'],
            'client_id' => auth()->user()->id, // Assuming jobs are associated with users
            'permalink' => $permalink
        ]);

        // Dispatch the event
        event(new NewJobCreated($job));

        // Redirect to the jobs listing or job details page
        return redirect()->route('jobs.index'); // Replace 'jobs.index' with the appropriate route
    }

    /**
     * Display the specified resource.
     */
    public function show(string $permalink)
    {
        $job = Job::with('user', 'review')->where('permalink', $permalink)->firstOrFail();

        //$job = Job::with('user')->findOrFail($id);
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        // Check if the user is authorized to delete
       $this->authorize('delete', $job);
        // delete bids first and then job
        $job->bids()->delete();
        $job->delete();

        // Redirect to a page after deletion
        return redirect()->route('jobs.index');
    }

    public function showByPermalink($permalink)
    {
        $job = Job::where('permalink', $permalink)->firstOrFail();
        return view('jobs.show', compact('job'));
    }
}
