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
                    {{ __("You're logged in!") }}

                    <div class="max-w-md mx-auto">
                        <h1 class="text-2xl font-semibold mb-4">Post a New Job</h1>
                        <form action="{{ route('jobs.store') }}" method="POST">
                            @csrf

                            <!-- Job Title -->
                            <div class="mb-4">
                                <label for="title" class="block text-gray-600 font-medium">Job Title</label>
                                <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300" required>
                            </div>

                            <!-- Job Description -->
                            <div class="mb-4">
                                <label for="description" class="block text-gray-600 font-medium">Job Description</label>
                                <textarea name="description" id="description" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300" rows="4" required></textarea>
                            </div>

                            <!-- Job Budget -->
                            <div class="mb-4">
                                <label for="budget" class="block text-gray-600 font-medium">Budget</label>
                                <input type="number" name="budget" id="budget" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300" required>
                            </div>

                            <!-- Job Deadline -->
                            <div class="mb-4">
                                <label for="deadline" class="block text-gray-600 font-medium">Deadline</label>
                                <input type="date" name="deadline" id="deadline" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-6">
                                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Post Job</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
