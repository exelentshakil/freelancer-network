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
                    @if (checkAcceptedBids($job->id))
                        @php
                            $awardee = getAwardeeDetails($job->id)
                        @endphp
                        <div class="bg-black shadow-md rounded-lg p-6">
                            <span class="inline-block px-3 py-1 bg-green-500 text-white font-semibold rounded-full">
                          Awarded
                        </span>
                            <div class="job-status-timeline">
                                <div class="max-w-3xl mx-auto">
                                    <h2 class="text-2xl font-semibold mb-4">Job Status Timeline</h2>

                                    <!-- Timeline container -->
                                    <div class="relative">

                                        <!-- Timeline line -->
                                        <div class="border-2 border-gray-400 absolute h-full border-dashed"
                                             style="left: 50%; transform: translateX(-50%);"></div>

                                        <!-- Timeline items -->
                                        <div class="flex justify-between items-start">
                                            <!-- Job Posted -->
                                            <div class="w-1/5 text-center">
                                                <div class="relative">
                                                    <div
                                                        class="w-8 h-8 bg-blue-500 rounded-full text-white flex items-center justify-center mx-auto">
                                                        <i class="fa fa-check-circle"></i>
                                                    </div>
                                                    <div
                                                        class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-8">
                                                        <p class="text-sm">Job Posted</p>
                                                        <p class="text-xs text-gray-600">{{ $job->created_at->format('M d, Y H:i A') }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Proposal Submitted ->bid->created_at->format('M d, Y H:i A') -->
                                            <div class="w-1/5 text-center">
                                                <div class="relative">
                                                    <div
                                                        class="w-8 h-8 bg-blue-500 rounded-full text-white flex items-center justify-center mx-auto">
                                                        <i class="fa fa-check-circle"></i>
                                                    </div>
                                                    <div
                                                        class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-8">
                                                        <p class="text-sm">Proposal Submitted</p>

                                                        <p class="text-sm text-gray-600">{{ !is_null($awardee) ? $awardee->created_at->format('M d, Y H:i A') : '' }}</p>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- In Progress \Carbon\Carbon::parse($awardee->accepted_at)->format('M d, Y H:i A') -->
                                            <div class="w-1/5 text-center">
                                                <div class="relative">
                                                    <div
                                                        class="w-8 h-8 bg-blue-500 rounded-full text-white flex items-center justify-center mx-auto">
                                                        <i class="fa fa-check-circle"></i>
                                                    </div>
                                                    <div
                                                        class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-8">
                                                        <p class="text-sm">Awarded</p>
                                                        <p class="text-xs text-gray-600">{{ '' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Delivered -->
                                            <div class="w-1/5 text-center">
                                                <div class="relative">
                                                    <div
                                                        class="w-8 h-8 bg-blue-500 rounded-full text-white flex items-center justify-center mx-auto">
                                                        4
                                                    </div>
                                                    <div
                                                        class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-8">
                                                        <p class="text-sm">Delivered</p>
                                                        <p class="text-xs text-gray-600"></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Completed -->
                                            <div class="w-1/5 text-center">
                                                <div class="relative">
                                                    <div
                                                        class="w-8 h-8 bg-blue-500 rounded-full text-white flex items-center justify-center mx-auto">
                                                        5
                                                    </div>
                                                    <div
                                                        class="absolute top-0 left-1/2 transform -translate-x-1/2 mt-8">
                                                        <p class="text-sm">{{ $job->status == 'In Progress' ? 'In Review' : 'Completed' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="project-details mt-16">
                                <h1 class="text-3xl font-semibold mb-4">{{ $job->title }}</h1>
                                <p class="text-gray-600 mb-4">Posted by: {{ $job->user->name }}</p>
                                <p class="text-gray-600 mb-4">Posted on: {{$job->created_at->diffForHumans() }}</p>
                                <p class="text-gray-600 mb-4">Budget: ${{ $job->budget }}</p>
                                <p class="text-gray-600 mb-4">Deadline: {{ $job->deadline }}</p>
                                <h2 class="text-2xl text-gray-800 mb-4">Job Description</h2>
                                <p class="text-gray-600 mb-6">
                                    {{ $job->description }}
                                </p>
                            </div>

                            <!-- Bid Form -->
                            @if( auth()->user()->role == 'Freelancer' && !existingBid($job->id) && !checkAcceptedBids($job->id))
                                <div class="mb-6 max-w-[400px]">
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
                                            <label for="bid_amount" class="block text-gray-600 font-medium">Your Bid
                                                Amount</label>
                                            <input type="number" name="bid_amount" id="bid_amount"
                                                   class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300"
                                                   required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="proposal" class="block text-gray-600 font-medium">Your
                                                Proposal</label>
                                            <textarea name="proposal" id="proposal"
                                                      class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300"
                                                      rows="4" required></textarea>
                                        </div>
                                        <input type="hidden" name="permalink" value="{{ $job->permalink }}">
                                        <button type="submit"
                                                class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
                                            Submit Bid
                                        </button>
                                    </form>
                                </div>
                            @endif



                            <!-- List of Submitted Bids -->
                            <div>

                                <h2 class="text-xl text-gray-800 mb-4">Submitted Bids</h2>
                                <ul>
                                    @foreach($job->bids as $bid)
                                        <li class="mb-2 mt-3 shadow-md px-3 py-3">
                                            @if(auth()->user()->id !== $bid->user->id && auth()->user()->role === 'Client')
                                                <!-- Ensure you don't show the button to the user viewing their own profile -->
                                                <a href="{{ route('user', $bid->user->id) }}"
                                                   class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">Start
                                                    Chat Conversation</a>
                                            @endif
                                            <div class="clear mt-3"></div>
                                            <strong class="text-gray-800">Bid Amount: {{ $bid->bid_amount }}</strong>
                                            <p class="text-gray-600">Proposal: {{ $bid->proposal }}</p>
                                            <p class="text-gray-600">By: {{ $bid->user->name }}</p>
                                            <p class="text-gray-600">Status: {{ $bid->status }}</p>
                                            @if ($bid->status === 'Pending' && auth()->user()->role === 'Client')
                                                <form action="{{ route('bids.accept', $bid) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Accept</button>
                                                </form>
                                                <form action="{{ route('bids.reject', $bid) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </form>
                                            @elseif ($bid->status === 'Accepted' && auth()->user()->role === 'Client')
                                                <span class="text-success">Accepted</span>
                                                <form action="{{ route('bids.reject', $bid) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                </form>
                                            @elseif ($bid->status === 'Rejected' && auth()->user()->role === 'Client')
                                                <span class="text-danger">Rejected</span>
                                                <form action="{{ route('bids.accept', $bid) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Accept</button>
                                                </form>
                                            @endif
                                        </li>
                                    @endforeach
                                    <!-- Add more submitted bids here -->

                                    @if(checkIfAwarded($job->id) || $job->client_id === auth()->user()->id)
                                        @if ( !is_null($job->deliveries))
                                            <div class="max-w-lg mx-auto p-4">
                                                <h2 class="text-2xl font-semibold mb-4">Job Delivery</h2>
                                                @if(session('success'))
                                                    <div
                                                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                                        role="alert">
                                                        <strong class="font-bold">Success!</strong>
                                                        <span class="block sm:inline">{{ session('success') }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            @foreach($job->deliveries as $jobDelivery)
                                                <div class="max-w-lg mx-auto p-4">
                                                    <div class="bg-black shadow-md rounded-lg p-4 mb-4">
                                                        <p class="text-gray-600 text-sm mb-2">Delivered
                                                            on {{ $jobDelivery->created_at->format('M d, Y H:i A') }}</p>
                                                        <p class="mb-4">{{ $jobDelivery->message }}</p>

                                                        <p class="mb-4">Status: {{ $jobDelivery->status }}</p>

                                                        @if($jobDelivery->file_path)
                                                            <a href="{{ asset('storage/' . $jobDelivery->file_path) }}"
                                                               class="text-blue-500 hover:underline">Download Attached
                                                                File</a>
                                                        @endif
                                                    </div>
                                                    @if( auth()->user()->role === 'Client' )

                                                        @if(session('message'))
                                                            <div
                                                                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                                                role="alert">
                                                                {{--                                                            <strong class="font-bold">Error!</strong>--}}
                                                                <span
                                                                    class="block sm:inline">{{ session('message') }}</span>
                                                            </div>
                                                        @endif
                                                        <div class="delivery-actions flex gap-2">
                                                            <form method="POST"
                                                                  action="{{ route('delivery.accept-delivery', ['job_delivery' => $jobDelivery]) }}">
                                                                @csrf
                                                                <button
                                                                    {{$jobDelivery->status === 'Accepted' ? 'disabled' : '' }} type="submit"
                                                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full">
                                                                    {{ $jobDelivery->status === 'Accepted'? 'Accepted' : 'Accept Delivery' }}
                                                                </button>
                                                            </form>
                                                            <form method="POST"
                                                                  action="{{ route('delivery.reject-delivery', ['job_delivery' => $jobDelivery]) }}">
                                                                @csrf
                                                                <button
                                                                    {{$jobDelivery->status === 'Rejected' ? 'disabled' : '' }} type="submit"
                                                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full">
                                                                    {{ $jobDelivery->status === 'Rejected'? 'Rejected' : 'Reject Delivery' }}
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                        @if((checkIfAwarded($job->id) || $job->client_id !== auth()->user()->id ) && checkIfAllDeliveryRejected($job->id))

                                            <div class="max-w-lg mx-auto p-4">
                                                <h2 class="text-2xl font-semibold mb-4">Deliver Job</h2>
                                                <form method="POST"
                                                      action="{{ route('job-deliver.store', ['job' => $job->id]) }}"
                                                      enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="mb-4">
                                                        <label for="message"
                                                               class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                                                        <textarea name="message" id="message" rows="4"
                                                                  class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                                                                  required></textarea>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="file"
                                                               class="block text-gray-700 text-sm font-bold mb-2">File
                                                            Upload (optional)</label>
                                                        <input type="file" name="file" id="file"
                                                               class="w-full py-2 focus:outline-none border rounded-lg focus:border-blue-500">
                                                        <p class="text-gray-600 text-xs mt-2">Maximum file size:
                                                            10MB</p>
                                                    </div>

                                                    <div class="mt-6">
                                                        <button type="submit"
                                                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                                                            Deliver Job
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endif


                                </ul>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
