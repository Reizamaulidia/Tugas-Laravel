@extends('Layouts.index')

@section('content')
<section class="container my-24 mx-auto">
    @if (session('success'))
    <div id="alert-3"
        class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 mx-20" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">
            {{ session('success') }}
        </div>
        <button type="button"
            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
            data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
    @endif
    <div class="flex justify-between px-20">
        <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
            <button type="button"
                class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800">All
                Genres</button>
            </div>

        <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
            <a href="{{ route('movies.create') }}"
                class="text-white hover:text-white border border-blue-600 bg-blue-700 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800">Create
                Movie</a>
        </div>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 px-20">
        @forelse ($movies as $movie)

        <div class="relative bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg p-6">
            <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/'.$movie->poster) }}" alt="{{ $movie->title }}">

            <div class="mt-4">
                <h5 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $movie->title }}</h5>
                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $movie->genre->name }}</p>
                <p class="mt-2 text-sm text-gray-800 dark:text-gray-400">{{ Str::limit($movie->synopsis, 100) }}</p>
            </div>

            <div class="mt-4 flex justify-between items-center">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $movie->year }}</p>
                <div class="flex items-center text-sm {{ $movie->available ? 'text-green-500' : 'text-red-500' }}">
                    <i class="fas {{ $movie->available ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                    <span class="ml-1">{{ $movie->available ? 'Available' : 'Not Available' }}</span>
                </div>
            </div>

            <div class="flex justify-end mt-4 gap-x-3">
                <a href="{{ route('movies.edit', $movie->id) }}" class="text-yellow-500 hover:text-white border border-yellow-500 hover:bg-yellow-600 rounded-lg px-4 py-2">Edit</a>
                <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this movie?')" class="text-red-500 hover:text-white border border-red-500 hover:bg-red-600 rounded-lg px-4 py-2">Delete</button>
                </form>
            </div>
        </div>

        @empty
        <section class="container px-4 mx-auto absolute w-full">
            <div class="flex items-center mt-6 text-center h-96">
                <div class="flex flex-col w-full max-w-sm px-4 mx-auto">
                    <div class="p-3 mx-auto text-blue-500 bg-blue-100 rounded-full dark:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <h1 class="mt-3 text-lg text-gray-800 dark:text-white">No movies found</h1>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">We couldn't find any movies that matched your search.</p>
                    <div class="flex items-center mt-4 sm:mx-auto gap-x-3">
                        <button
                            class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <span>Add a book</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        @endforelse
    </div>
</section>
@endsection