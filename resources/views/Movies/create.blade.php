@extends('Layouts.index')

@section('content')
<section class="container my-24 mx-auto">
    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data"
        class="max-w-4xl mx-auto bg-blue-50 rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 p-5">
        @csrf
        <!-- Title -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="title"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
            @error('title')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid md:grid-cols-2 md:gap-6">
            <!-- Genre -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="genre" id="genre"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    required>
                    <option value="" disabled {{ old('genre') ? '' : 'selected' }}>Pilih genre</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                    @endforeach
                </select>
                <label for="genre"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Genre</label>
                @error('genre')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Year -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="text" name="year" id="year" value="{{ old('year') }}"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="year"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Year</label>
                @error('year')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Synopsis -->
        <div class="relative z-0 w-full mb-5 group">
            <textarea name="synopsis" id="synopsis" rows="4"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required>{{ old('synopsis') }}</textarea>
            <label for="synopsis"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Synopsis</label>
            @error('synopsis')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col items-center justify-center w-full mb-5">
            <!-- File Input -->
            <label for="poster"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6 relative">
                    <div id="image-preview-container" class="mb-4 hidden w-full h-full bg-red-200 absolute z-50">
                        <img id="image-preview" class=" h-full w-full object-cover rounded-md" alt="Image Preview" />
                    </div>
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag
                        and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG, or GIF (MAX. 2MB)</p>
                </div>
                <input id="poster" name="poster" type="file" class="hidden" accept="image/*" />
            </label>
        </div>
        @error('poster')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror

        <div class="relative z-0 w-full mb-5 group">
            <label for="available" class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400">
                <input type="radio" name="available" value="1" {{ old('available', $movie->available ?? true) == 1 ? 'checked' : '' }} />
                <span class="ml-2">Available</span>
            </label>
            <label for="not_available" class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 ml-4">
                <input type="radio" name="available" value="0" {{ old('available', $movie->available ?? true) == 0 ? 'checked' : '' }} />
                <span class="ml-2">Not Available</span>
            </label>
            @error('available')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>



        <!-- Submit Button -->
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('poster').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('image-preview-container');
            const previewImage = document.getElementById('image-preview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };

                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
                previewImage.src = '';
            }
        });
    });
</script>