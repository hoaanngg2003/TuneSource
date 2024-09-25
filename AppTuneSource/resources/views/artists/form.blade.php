@extends('layouts.app')
 
@section('title', 'Form Artist')
 
@section('contents')
<form action="{{ isset($artists) ? route('artists.update', $artists->ArtistID) : route('artists.save') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($artist) ? 'Edit Artist' : 'Upload Artist' }}</h6>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="ArtistName">Artist Name</label>
              <input type="text" class="form-control" id="ArtistName" name="ArtistName" value="{{ isset($artist) ? $artist->ArtistName : '' }}">
            </div>
            <div class="form-group">
                <strong>Artist Image:</strong>
                <input type="file" name="ArtistImage" class="form-control" placeholder="Artist Image">
                @error('ArtistImage')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
              <label for="Bio">Bio</label>
              <textarea class="form-control" id="Bio" name="Bio">{{ isset($artist) ? $artist->Bio : '' }}</textarea>
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
