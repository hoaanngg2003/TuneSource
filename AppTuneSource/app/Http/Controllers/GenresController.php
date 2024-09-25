<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Genres;
 
class GenresController extends Controller
{
    public function index()
    {
        $genre = Genres::get();
 
        return view('genres.index', ['genre' => $genre]);
    }
 
    public function add()
    {
        return view('genres.form');
    }
 
    public function save(Request $request)
    {
        $data = [
            'GenreName' => $request->GenreName
        ];
 
        Genres::create($data);
 
        return redirect()->route('genres');
    }
 
    public function edit($GenreID)
    {
        $genre = Genres::find($GenreID);
 
        return view('genres.form', ['genre' => $genre]);
    }
 
    public function update($id, Request $request)
    {
        $data = [
            'GenreName' => $request->GenreName
        ];
 
        Genres::find($id)->update($data);
 
        return redirect()->route('genres');
    }
 
    public function delete($id)
    {
        Genres::find($id)->delete();
 
        return redirect()->route('genres');
    }
}
