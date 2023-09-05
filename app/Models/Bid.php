<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Bid
 *
 * @property int $id
 * @property int $freelancer_id
 * @property int $job_id
 * @property string $proposal
 * @property string $bid_amount
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Job $job
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Bid newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bid newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bid query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereBidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereFreelancerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereProposal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bid extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function job() {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'freelancer_id', 'id');
    }
}
