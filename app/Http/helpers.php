<?php

use App\Models\Bid;
use App\Models\ChMessage;
use App\Models\Job;
use App\Models\JobDelivery;

function existingBid($job_id) {
    $existingBid = Bid::where('freelancer_id', auth()->user()->id)
        ->where('job_id', $job_id)
        ->first();

    if ($existingBid) {
        return true;
    }

    return false;
}

function checkAcceptedBids($jobId)
{
    // Retrieve the job based on its ID
    $job = Job::find($jobId);

    // Check if the job exists
    if (!$job) {
        return "Job not found.";
    }

    // Check if there are any bids with 'accepted' status for this job
    $acceptedBids = $job->bids()->where('status', 'Accepted')->count();

    if ($acceptedBids > 0) {
        return true;
    }

    return false;
}

function checkMessages()
{
    // Check if there are any messages in the messages table
    $messages = ChMessage::where('to_id', auth()->user()->id)->where('seen', 0);

    if ($messages->count() > 0) {
        return "You have {$messages->count()} unread messages.";
    } else {
        return "You don't have any messages.";
    }
}

function checkIfAwarded($job_id) {
    $awarded = Bid::where('freelancer_id', auth()->user()->id)->where('status', 'Accepted')->where('job_id', $job_id)->count();

    if ($awarded > 0) {
        return true;
    }

    return false;
}

function getAwardeeDetails($job_id) {

    if ( auth()->user()->role === 'Client') {
        $awarded = Bid::where('status', 'Accepted')->where('job_id', $job_id)->first();

    } else {
        $awarded = Bid::where('freelancer_id', auth()->user()->id)->where('status', 'Accepted')->where('job_id', $job_id)->first();
    }

    if (!is_null($awarded) && $awarded->count() > 0) {
        return $awarded;
    }

    return false;
}

function checkIfAllDeliveryRejected($job_id) {
    $deliveries = JobDelivery::where('job_id', $job_id)->get();

    if ( !$deliveries->isEmpty() ) {
        $deliveries = $deliveries->every(fn ($delivery) => $delivery->status === 'Rejected');
    }

    if ( $deliveries ) {
        return true;
    }

    return false;

}

function checkIfOneDeliveryAccepted($job_id) {
    $deliveries = JobDelivery::where('job_id', $job_id)->where('status', 'Accepted')->get();

    if ( $deliveries->count() > 0 ) {
        return true;
    }

    return false;
}

function checkIfDelivered($job_id) {
    $deliveries = JobDelivery::where('job_id', $job_id)->get();

    if ( $deliveries->count() > 0 ) {
        return true;
    }

    return false;
}
