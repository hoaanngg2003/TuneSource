@extends('layouts.app')
 
@section('title', 'Form songs')
 
@section('contents')
<form action="{{ isset($song) ? route('songs.update', $song->SongID) : route('songs.save') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($song) ? 'Edit song' : 'Upload song' }}</h6>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="SongName">Song Name</label>
              <input type="text" class="form-control" id="SongName" name="SongName" value="{{ isset($song) ? $song->SongName : '' }}">
            </div>
            <div class="form-group">
                <strong>Song Image:</strong>
                <input type="file" name="SongImage" class="form-control" placeholder="Song Image">
                @error('SongImage')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
              <strong>Song Audio</strong>
              <input type="file" name="SongAudio" class="form-control"  placeholder="Company audio"  accept="audio/*">
              @error('SongAudio')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
                <label for="Lyrics">Lyrics</label>
                <textarea class="form-control" id="Lyrics" name="Lyrics">{{ isset($song) ? $song->Lyrics : '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="GenreID">Genre Name</label>
                <select name="GenreID" id="GenreID" class="custom-select">
                    <option value="" selected disabled hidden>-- Choose Genre --</option>
                    @foreach ($genre as $row)
                        <option value="{{ $row->GenreName }}" {{ isset($song) ? ($song->GenreID == $row->GenreID ? 'selected' : '') : '' }}>{{ $row->GenreName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="ArtistID">Artist Name</label>
                <select name="ArtistID" id="ArtistID" class="custom-select">
                    <option value="" selected disabled hidden>-- Choose Artist --</option>
                    @foreach ($artist as $row)
                        <option value="{{ $row->ArtistName }}" {{ isset($song) ? ($song->ArtistID == $row->ArtistID ? 'selected' : '') : '' }}>{{ $row->ArtistName }}</option>
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
