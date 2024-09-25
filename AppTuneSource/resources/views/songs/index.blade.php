@extends('layouts.app')

@section('title', 'Data Song')
 
@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data song</h6>
    </div>
    <div class="card-body">
            @if (auth()->user()->level == 'Admin')
      <a href="{{ route('songs.add') }}" class="btn btn-primary mb-3">Add song</a>
            @endif
      <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Song ID</th>
              <th>Song Name</th>
              <th>Song Image</th>
              <th>Song Audio</th>
              <th>Lyrics</th>
              <th>Genre Name</th>
              <th>Artist Name</th>
                            @if (auth()->user()->level == 'Admin')
              <th>Action</th>
                            @endif
            </tr>
          </thead>
          <tbody>
            @php($no = 1)
            @foreach ($song as $song)
              <tr>
                <th>{{ $no++ }}</th>
                <td>{{ $song->SongName }}</td>
                <td><img src="{{ asset('images/'.$song->SongImage) }}" alt="{{ $song->SongImage }}" width="150" height="100"></td>
                <td> <!-- Hiển thị file audio cho người dùng nghe thử -->
                  <audio controls>
                      <source src="{{ asset('audios/'.$song->SongAudio) }}" type="audio/mp3" controlslist="nodownload">
                      Your browser does not support the audio element.
                  </audio>
                </td>
                <td>{{ $song->Lyrics }}</td>
                <td>{{ $song->GenreID }}</td>
                <td>{{ $song->ArtistID }}</td>
                                @if (auth()->user()->level == 'Admin')
                <td>
                  <a href="{{ route('songs.edit', $song->SongID) }}" class="btn btn-warning">Edit</a>
                  <a href="{{ route('songs.delete', $song->SongID) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Song?')" >Delete</a>
                </td>
                                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
