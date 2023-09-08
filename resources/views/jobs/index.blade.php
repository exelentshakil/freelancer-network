<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jobs') }}
                <a href="{{ route('jobs.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Create Job</a>


        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    @foreach($jobs as $job)
                        <div class="bg-black shadow-md rounded-lg p-6 mt-3 ">
                            <h1 class="text-3xl font-semibold mb-4">{{ $job->title }}</h1>
                            <p class="text-gray-600 mb-4">Posted by: {{ $job->user->name }}</p>
                            <p class="text-gray-600 mb-4">Posted on: {{$job->created_at->diffForHumans() }}</p>
                            <p class="text-gray-600 mb-4">Budget: ${{ $job->budget }}</p>
                            <p class="text-gray-600 mb-4">Deadline: {{ $job->deadline }}</p>
                            <h2 class="text-2xl text-gray-800 mb-4">Job Description</h2>
                            <p class="text-gray-600 mb-6">
                                {{ \Illuminate\Support\Str::substr($job->description, 0, 150) }}...
                            </p>
                            <div class="flex gap-2">
                                @if( auth()->user()->role == 'Client' || auth()->user()->role == 'Admin')
                                <a href="{{ route('jobs.show', $job->permalink) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">{{$job->status}}</a>
                                @elseif( auth()->user()->role == 'Freelancer' && existingBid($job->id))
                                    <a href="{{ route('jobs.show', $job->permalink) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Applied</a>
                                @elseif( auth()->user()->role == 'Freelancer' && !checkAcceptedBids($job->id))
                                    <a href="{{ route('jobs.show', $job->permalink) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Apply Now</a>

                                @elseif( auth()->user()->role == 'Freelancer')
                                    <a href="{{ route('jobs.show', $job->permalink) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Awarded</a>
                                @endif

                                <form method="POST" action="{{ route('jobs.destroy', ['job' => $job->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition duration-200">Delete Job</button>
                                </form></div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
