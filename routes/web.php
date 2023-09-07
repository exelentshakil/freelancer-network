<?php

use App\Http\Controllers\BidController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobDeliveryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
    // Users Routes
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);

    // Jobs Routes
    Route::resource('jobs', JobController::class);

    // Define routes for job deliveries
    Route::get('jobs/{job}/deliver', [JobDeliveryController::class, 'create'])->name('job-deliver.create');
    Route::post('jobs/{job}/deliver', [JobDeliveryController::class, 'store'])->name('job-deliver.store');
    Route::post('/job_deliveries/{job_delivery}/accept-delivery', [JobDeliveryController::class, 'acceptDelivery'])->name('delivery.accept-delivery');
    Route::post('/job_deliveries/{job_delivery}/reject-delivery', [JobDeliveryController::class, 'rejectDelivery'])->name('delivery.reject-delivery');

    //Route::get('/jobs/{permalink}', [JobController::class, 'showByPermalink'])->name('jobs.showByPermalink');

    // Bids Routes
    Route::resource('bids', BidController::class);
    Route::post('/bids/{bid}/accept', [BidController::class, 'accept'])->name('bids.accept');
    Route::post('/bids/{bid}/reject', [BidController::class, 'reject'])->name('bids.reject');

    // Messages Routes
    Route::resource('messages', MessageController::class);

    // Reviews Routes
    Route::resource('reviews', ReviewController::class);
    Route::post('reviews/{review}/reply', [ReviewController::class, 'replyReview'])->name('review.reply');

    // Payments Routes
    Route::resource('payments', PaymentController::class);




});

require __DIR__.'/auth.php';
