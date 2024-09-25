<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albums;
use App\Models\Artists;

class AlbumsController extends Controller
{
    public function index()
    {
        $album = Albums::orderBy('AlbumID', 'desc')->get();

        return view('albums.index', compact( 'album'));
    }

    public function add()
    {
        $artist = Artists::get();

        return view('albums.form', ['artist' => $artist]);
    }

    public function save(Request $request)
    {
        $request ->validate([
            'AlbumName' => 'required',
            'ReleaseDate' => 'required',
            'CoverImage' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'ArtistID' => 'required',
        ]);

        $image = $request->file('CoverImage');
        $imageName = time().'.'.$image->extension();

        // Public Folder
        $image->move(public_path('images'), $imageName);
        $newAlbum  = new Albums();
            $newAlbum->AlbumName = $request->AlbumName;
            $newAlbum->CoverImage = $imageName;
            $newAlbum->ReleaseDate = $request->ReleaseDate;
            $newAlbum->ArtistID = $request->ArtistID;
            $newAlbum->save();

        return redirect()->route('albums') ->with('success','Company has been created successfully.');
    }

    public function show(Artists $Artists)
    {
        return view('albums.show',compact('album'));
    }

    public function edit($AlbumID)
    {
        $albums = Albums::find($AlbumID);
        $artists = Artists::get();

        return view('albums.form', ['album' => $albums, 'artist' => $artists]);
    }

    public function update(Request $request, Albums $albums)
    {
        // Validate the input data
        if ($request->hasFile('CoverImage')) {
            // Validate the uploaded image
            $request->validate([
                'CoverImage' => 'image|mimes:png,jpg,jpeg|max:2048'
            ]);

            // Process the uploaded image
            $imageName = time().'.'.$request->CoverImage->extension();
            $request->CoverImage->move(public_path('images'), $imageName);

            // Update the album with the new image
            $albums->update(['CoverImage' => $imageName]);
        }

          // Update the other artist data
        $albums->update($request->except(['_token', '_method', 'CoverImage']));

        return redirect()->route('albums');
    }

    public function imageUploadPost()
    {
        request()->validate([
            'CoverImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->CoverImage->move(public_path('images'), $imageName);
    }

    public function delete($id)
    {
        Albums::find($id)->delete();

        return redirect()->route('albums');
    }
}
