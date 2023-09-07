<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\JobDelivery;
use Illuminate\Support\Facades\Storage;


class JobDeliveryController extends Controller
{
    public function create(Job $job)
    {
        // Display the job delivery form
        return view('job_deliveries.create', compact('job'));
    }

    public function store(Request $request, Job $job)
    {
        $request->validate([
            'message' => 'required',
            'file' => 'nullable|file|max:10240', // Adjust the file size limit as needed
        ]);

        $delivery = new JobDelivery();
        $delivery->job_id = $job->id;
        $delivery->message = $request->input('message');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('job_deliveries'); // Store the file in a storage location

            $delivery->file_path = $filePath;
        }

        $delivery->save();

        // Optionally, you can send a notification or redirect to a success page

        return redirect()->route('jobs.show', ['job' => $job->permalink])->with('success', 'Job delivered successfully!');
    }

    public function acceptDelivery(JobDelivery $jobDelivery)
    {
        $jobDelivery->update([
            'status' => 'Accepted',
            'accepted_at' => now()
        ]);

        return redirect()->back()
            ->with('message', 'Yayy! Job delivery accepted.');
    }

    public function rejectDelivery(JobDelivery $jobDelivery)
    {
        // Retrieve the latest delivery for the job
        $updated = $jobDelivery->update([
            'status' => 'Rejected',
            'rejected_at' => now()
        ]);

        return redirect()->back()
            ->with('message', 'Unable to accept delivery.');
    }

}
