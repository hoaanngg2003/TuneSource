@extends('layouts.app')

@section('title', 'Data Album')
 
@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data album</h6>
    </div>
    <div class="card-body">
            @if (auth()->user()->level == 'Admin')
      <a href="{{ route('albums.add') }}" class="btn btn-primary mb-3">Add album</a>
            @endif
      <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Album ID</th>
              <th>Album Name</th>
              <th>Release Date</th>
              <th>Cover Image</th>
              <th>Artist Name</th>
                            @if (auth()->user()->level == 'Admin')
              <th>Action</th>
                            @endif
            </tr>
          </thead>
          <tbody>
            @php($no = 1)
            @foreach ($album as $album)
              <tr>
                <th>{{ $no++ }}</th>
                <td>{{ $album->AlbumName }}</td>
                <td>{{ $album->ReleaseDate }}</td>
                <td><img src="{{ asset('images/'.$album->CoverImage) }}" alt="{{ $album->CoverImage }}" width="100" height="100"></td>
                <td>{{ $album->ArtistID }}</td>
                                @if (auth()->user()->level == 'Admin')
                <td>
                  <a href="{{ route('albums.edit', $album->AlbumID) }}" class="btn btn-warning">Edit</a>
                  <a href="{{ route('albums.delete', $album->AlbumID) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Album?')" >Delete</a>
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
