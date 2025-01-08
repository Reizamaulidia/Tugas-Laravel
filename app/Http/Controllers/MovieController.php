<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string|max:1000',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'year' => 'required|string|max:8',
            'available' => 'required|boolean',
            'genre' => 'required|exists:genres,id',
        ]);

        if ($request->file('poster')) {
            $validated['poster'] = $request->file('poster')->store('posters');
        }

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName);
        // }

        Movie::create([
            'title' => $validated['title'],
            'synopsis' => $validated['synopsis'],
            'poster' => $validated['poster'],
            'year' => $validated['year'],
            'available' => $validated['available'],
            'genre_id' => $validated['genre'],
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie has been successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string|max:1000',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'year' => 'required|string|max:8',
            'available' => 'required|boolean',
            'genre' => 'required|exists:genres,id',
        ]);
        
        $movie = Movie::findOrFail($id);

        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('posters');
        } else {
            $validated['poster'] = $movie->poster;
        }

        $movie->update([
            'title' => $validated['title'],
            'synopsis' => $validated['synopsis'],
            'poster' => $validated['poster'],
            'year' => $validated['year'],
            'available' => $validated['available'],
            'genre_id' => $validated['genre'],
        ]);

        /**
         * Kembalikan user ke halaman list books
         */
        return redirect()->route('movies.index')->with('success', 'Movie has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie has been successfully deleted!');
    }
}
