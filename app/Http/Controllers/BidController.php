<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;

class BidController extends Controller
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
    {
        // Validate and store the bid data
        $data = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'bid_amount' => 'required|numeric|min:0',
            'proposal' => 'required|string|max:255',
            'permalink' => 'required|string|max:255',
        ]);

        if (existingBid($data['job_id'])) {
            return redirect()->route('jobs.show', $data['permalink'])
                ->with('error', 'You have already submitted a bid for this job.');
        }

        // Create the bid
        Bid::create([
            'job_id' => $data['job_id'],
            'bid_amount' => $data['bid_amount'],
            'proposal' => $data['proposal'],
            'freelancer_id' => auth()->user()->id,
            // Add other fields as needed
        ]);

        return redirect()->route('jobs.show', $data['permalink'])->with('success', 'Bid placed!'); // Replace 'jobs.index' with the appropriate route
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }


    public function accept(Bid $bid)
    {
        $bid->update([
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        $bid->job->update([
            'status' => 'In Progress'
        ]);

        // Add any additional logic (e.g., sending notifications) here

        return back()->with('success', 'Bid accepted successfully.');
    }

    public function reject(Bid $bid)
    {
        $bid->update([
            'status' => 'rejected',
        ]);

        $bid->job->update([
            'status' => 'Open'
        ]);
        // Add any additional logic (e.g., sending notifications) here

        return back()->with('success', 'Bid rejected successfully.');
    }
}
