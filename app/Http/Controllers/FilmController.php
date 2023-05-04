<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\film;
use Illuminate\Http\Request;
use Exception;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = film::paginate(10);
        return response()->json([
            'data' => $films
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            'genre_film' => $request->genre_film
            
        ]);
        return response()->json([
            'data' => $films
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = film::where('id', '=', $id)->get();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

     public function showgenre(string $genre_film)
     {
         $data = film::where('genre_film', '=', $genre_film)->get();
 
         if ($data) {
             return ApiFormatter::createApi(200, 'Success', $data);
         } else {
             return ApiFormatter::createApi(400, 'Failed');
         }
     }
 
    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $films = Film::where('nama_film', 'LIKE', "%$query%")
                    ->orWhere('sutradara_film', 'LIKE', "%$query%")
                    ->orWhere('genre_film', 'LIKE', "%$query%")
                    ->get();
    
        return view('films.search', compact('films', 'query'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id )
    {
        try {
            $request->validate([
                'nama_film' => 'required',
                'sutradara_film' => 'required',
                'rating_film' => 'required',
                'tahun' => 'required',
                'rating_age' => 'required',
                'genre_film' => 'required',
            ]);


            $film = film::findOrFail($id);

            $film->update([
                'nama_film' => $request->nama_film,
                'sutradara_film' => $request->sutradara_film,
                'rating_film' => $request->rating_film,
                'tahun' => $request->tahun,
                'rating_age' => $request->rating_age,
                'genre_film' => $request->genre_film
            ]);

            $data = film::where('id', '=', $film->id)->get();

            if ($data) {
                return ApiFormatter::createApi(20, 'Success', $data);
            } else {
                return ApiFormatter::createApi(400, 'Failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(film $film,)
    {
        $film->delete();
        return response()->json([
            'message' => 'film deleted'
        ], 204);
    }
}
