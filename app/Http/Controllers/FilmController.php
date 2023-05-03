<?php

namespace App\Http\Controllers;

use App\Models\film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $film = film::paginate(10);
        return response()->json([
            'data' => $film
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $films = film::create([
            'nama_film' => $request->nama_film,
            'sutradara_film' => $request->sutradara_film,
            'rating_film' => $request->rating_film,
            'tahun' => $request->tahun,
            'rating_age' => $request->rating_age,
            'genre_film' => $request->tahun,
            
        ]);
        return response()->json([
            'data' => $films
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(film $films)
    {
        return response()->json([
            'data' => $films
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(film $film)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, film $film )
    {
        $film->nama_film = $request->nama_film;
        $film->sutradara_film = $request->sutradara_film;
        $film->rating_film = $request->rating_film;
        $film->tahun = $request->tahun;
        $film->rating_age = $request->rating_age;
        $film->genre_film = $request->genre_film;
        
        $film->save();

        return response()->json([
            'data' => $film
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(film $films)
    {
        $films->delete();
        return response()->json([
            'message' => 'film deleted'
        ], 204);
    }
}
