<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Artists;
use App\Models\Genres;
use App\Models\Songs;

class SongsController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $song = Songs::orderBy('SongID', 'desc')->get();

        return view('songs.index', compact('song'));
    }

     /**
    * Show the form for creating a new resource.
    */

    public function add()
    {
        $genre = Genres::get();
        $artist = Artists::get();

        return view('songs.form', ['genre' => $genre, 'artist' => $artist]);
    }

     /**
    * Store a newly created resource in storage.
    */

    public function save(Request $request)
    {
        $request->validate([
            'SongName' => 'required',
            'SongImage' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'Lyrics' => 'required',
            'GenreID' => 'required',
            'ArtistID' => 'required',
            'SongAudio' => 'required|file|mimes:mp3,wav,ogg|max:2097152',
        ]);

        // Lưu trữ image 
        $image = $request->file('SongImage');
        $audio = $request->file('SongAudio');

        $imageName = time().'.'.$image->extension();
        $audioName = time().'.'.$audio->extension();

        $image->move(public_path('images'), $imageName);
        $audio->move(public_path('audios'), $audioName);
    
        // Lưu thông tin bài hát vào cơ sở dữ liệu
        $newSongs = new Songs();
            $newSongs -> SongName = $request->SongName;   
            $newSongs -> SongImage = $imageName;
            $newSongs -> SongAudio = $audioName;
            $newSongs -> Lyrics = $request->Lyrics;
            $newSongs -> GenreID = $request->GenreID;
            $newSongs -> ArtistID = $request->ArtistID;
            
            $newSongs->save();

        return redirect()->route('songs')->with('success','Company has been created successfully.');
    }

    /**
    * Display the specified resource.
    */
    public function show(Songs $Songs)
    {
        return view('songs.show',compact('song'));
    }

    public function edit($SongID)
    {
        $songs = Songs::find($SongID);
        $artists = Artists::get();
        $genres = Genres::get();

    
        return view('songs.form', ['song' => $songs, 'artist' => $artists, 'genre' => $genres]);
    }
    

    /**
    * Update the specified resource in storage.
     */

    public function update(Request $request, Songs $songs)
    {
        // Validate file audio
        if ($request->hasFile('SongAudio')) {
            // Validate the uploaded audio
            $request->validate([
                'SongAudio' => 'file|mimes:mp3,wav,ogg|max:8882048'
            ]);

            // Process the uploaded audio
            $audioName = time().'.'.$request->SongAudio->extension();
            $request->SongAudio->move(public_path('audios'),$audioName);
            
            // Update the song with the new audio
            $songs->update(['SongAudio' => $audioName]);
         }
         
         if ($request->hasFile('SongImage')) {
             // Validate the uploaded image
             $request->validate([
                 'SongImage' => 'image|mimes:png,jpg,jpeg|max:2048'
             ]);

             // Process the uploaded image
             $imageName = time().'.'.$request->SongImage->extension();
             $request->SongImage->move(public_path('images'),$imageName);
             
             // Update the song with the new image
             $songs->update(['SongImage' => $imageName]);
         }

        // Update the other song data
        $songs->update($request->except(['_token', '_method', 'SongAudio', 'SongImage']));
 
        return redirect()->route('songs');
    }

    public function imageUploadPost()
    {
        request()->validate([
            'SongImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->SongImage->move(public_path('images'), $imageName);
    }

    public function audioUploadPost()
    {
        request()->validate([
            'SongAudio' => 'required|mimes:mp3,wav,ogg|max:2048',
        ]);
        $audioName = time().'.'.request()->audio->getClientOriginalExtension();
        request()->SongAudio->move(public_path('audios'), $audioName);
    }


    public function delete($id)
    {
        Songs::find($id)->delete();

        return redirect()->route('songs');
    }
}


