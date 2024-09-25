@extends('layouts.app')
 
@section('title', 'Form albums')
 
@section('contents')
<form action="{{ isset($albums) ? route('albums.update', $album->AlbumID) : route('albums.save') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($album) ? 'Edit album' : 'Upload album' }}</h6>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="AlbumName">Album Name</label>
              <input type="text" class="form-control" id="AlbumName" name="AlbumName" value="{{ isset($album) ? $album->AlbumName : '' }}">
            </div>
            <div class="form-group">
              <label for="ReleaseDate">Release Date</label>
              <input type="date" class="form-control" id="ReleaseDate" name="ReleaseDate" value="{{ isset($album) ? $album->ReleaseDate : '' }}">
            </div>
            <div class="form-group">
              <strong>Cover Image</strong>
              <input type="file" name="CoverImage" class="form-control" placeholder="Cover Image">
                @error('CoverImage')
                  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="ArtistID">Artist Name</label>
                <select name="ArtistID" id="ArtistID" class="custom-select">
                    <option value="" selected disabled hidden>-- Choose Artist --</option>
                    @foreach ($artist as $row)
                        <option value="{{ $row->ArtistName }}" {{ isset($album) ? ($album->ArtistID == $row->ArtistID ? 'selected' : '') : '' }}>{{ $row->ArtistName }}</option>
                    @endforeach
                </select>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection
