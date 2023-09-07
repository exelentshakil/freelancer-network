<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        // Validate and store the job data
        $data = $request->validate([
            'reviewee_id' => 'required|string|max:255',
            'job_id' => 'required|string|max:255',
            'review_text' => 'required|string|max:255',
            'rating' => 'required|string',
        ]);
        // Create the job
        Review::create([
            'reviewer_id' => auth()->user()->id,
            'reviewee_id' => $data['reviewee_id'],
            'job_id' => $data['job_id'],
            'rating' => $data['rating'],
            'review_text' => $data['review_text'], // Assuming jobs are associated with users
        ]);

        // Redirect to the jobs listing or job details page
        return redirect()->back(); // Replace 'jobs.index' with the appropriate route
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }

    public function replyReview(Request $request, Review $review)
    {
        $data = $request->validate([
            'review_reply' => 'required|string|max:255',
        ]);

        $review->update([
            'review_reply' => $data['review_reply']
        ]);

        return redirect()->back(); // Replace 'jobs.index' with the appropriate route

    }
}
