<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h1 class="text-3xl font-semibold mb-4">{{ $job->title }}</h1>
                        <p class="text-gray-600 mb-4">Posted by: {{ $job->user->name }}</p>
                        <p class="text-gray-600 mb-4">Posted on: {{$job->created_at->diffForHumans() }}</p>
                        <p class="text-gray-600 mb-4">Budget: ${{ $job->budget }}</p>
                        <p class="text-gray-600 mb-4">Deadline: {{ $job->deadline }}</p>
                        <h2 class="text-2xl text-gray-800 mb-4">Job Description</h2>
                        <p class="text-gray-600 mb-6">
                            {{ $job->description }}
                        </p>

                        <!-- Bid Form -->
                        @if( auth()->user()->role == 'Freelancer' && !existingBid($job->id))
                        <div class="mb-6">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>

                           @elseif (session('error'))
                                {{ session('error') }}
                            @endif
                            <h2 class="text-xl text-gray-800 mb-4">Submit a Bid</h2>
                            <form action="{{ route('bids.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="job_id" value="{{ $job->id }}">
                                <div class="mb-4">
                                    <label for="bid_amount" class="block text-gray-600 font-medium">Your Bid Amount</label>
                                    <input type="number" name="bid_amount" id="bid_amount" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300" required>
                                </div>
                                <div class="mb-4">
                                    <label for="proposal" class="block text-gray-600 font-medium">Your Proposal</label>
                                    <textarea name="proposal" id="proposal" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300" rows="4" required></textarea>
                                </div>
                                <input type="hidden" name="permalink" value="{{ $job->permalink }}">
                                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Submit Bid</button>
                            </form>
                        </div>
                        @endif

                        <!-- List of Submitted Bids -->
                        <div>

                            <h2 class="text-xl text-gray-800 mb-4">Submitted Bids</h2>
                            <ul>
                                @foreach($job->bids as $bid)
                                    <li class="mb-2 mt-3 shadow-md px-3 py-3">
                                        <strong class="text-gray-800">Bid Amount:</strong> {{ $bid->bid_amount }}
                                        <p class="text-gray-600">Proposal: {{ $bid->proposal }}</p>
                                        <p class="text-gray-600">By: {{ $bid->user->name }}</p>
                                        @if ($bid->status === 'Pending')
                                            <form action="{{ route('bids.accept', $bid) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Accept</button>
                                            </form>
                                            <form action="{{ route('bids.reject', $bid) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </form>
                                        @elseif ($bid->status === 'Accepted')
                                            <span class="text-success">Accepted</span>
                                            <form action="{{ route('bids.reject', $bid) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </form>
                                        @elseif ($bid->status === 'Rejected')
                                            <span class="text-danger">Rejected</span>
                                            <form action="{{ route('bids.accept', $bid) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Accept</button>
                                            </form>
                                        @endif
                                    </li>
                                @endforeach
                                <!-- Add more submitted bids here -->
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
