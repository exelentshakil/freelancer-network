<?php

use App\Models\Bid;

function existingBid($job_id) {
    $existingBid = Bid::where('freelancer_id', auth()->user()->id)
        ->where('job_id', $job_id)
        ->first();

    if ($existingBid) {
        return true;
    }

    return false;
}
