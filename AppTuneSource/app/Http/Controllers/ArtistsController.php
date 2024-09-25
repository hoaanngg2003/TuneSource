<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Artists;
 
class ArtistsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $artist = Artists::orderBy('ArtistID', 'desc')->get();
        return view('artists.index', ['artist' => $artist]);
    }
 
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function add()
    {
        return view('artists.form');
    }
 
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function save(Request $request)
    {
        $request->validate([
            'ArtistName' => 'required',
            'Bio' => 'required',
            'ArtistImage' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $image = $request->file('ArtistImage');
        $imageName = time().'.'.$image->extension();

        // Public Folder
        $image->move(public_path('images'), $imageName);
        $newArtist = new Artists();
        $newArtist->ArtistName = $request->ArtistName;
        $newArtist->ArtistImage = $imageName;
        $newArtist->Bio = $request->Bio;
        $newArtist->save();

        return redirect()->route('artists')->with('success','Company has been created successfully.');
    }


    /**
    * Display the specified resource.
    */
    public function show(Artists $Artists)
    {
        return view('artists.show',compact('Artists'));
    }

    /**
    * Show the form for editing the specified resource.
    */
 
    public function edit($GenreID)
    {
        $artists = Artists::find($GenreID);

        return view('artists.form', ['artist' => $artists]);
    }


    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Artists  $Artists
    * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Artists $artist)
     {
         // Validate the input data
         if ($request->hasFile('ArtistImage')) {
             // Validate the uploaded image
             $request->validate([
                 'ArtistImage' => 'image|mimes:png,jpg,jpeg|max:2048'
             ]);

             // Process the uploaded image
             $imageName = time().'.'.$request->ArtistImage->extension();
             $request->ArtistImage->move(public_path('images'), $imageName);

             // Update the artist with the new image
             $artist->update(['ArtistImage' => $imageName]);
         }

         // Update the other artist data
        $artist->update($request->except(['_token', '_method', 'ArtistImage']));
 
         return redirect()->route('artists');
     }

     public function imageUploadPost()
     {
         request()->validate([
             'ArtistImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
         $imageName = time().'.'.request()->image->getClientOriginalExtension();
         request()->ArtistImage->move(public_path('images'), $imageName);
     }
 
     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artists  $Artists
     * @return \Illuminate\Http\Response
     */
     public function delete($id)
     {
        Artists::find($id)->delete();
         return redirect()->route('artists');
     }
}
