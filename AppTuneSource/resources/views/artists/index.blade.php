@extends('layouts.app')
 
@section('title', 'Data Artist')
 
@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data artist</h6>
    </div>
    <div class="card-body">
      <a href="{{ route('artists.add') }}" class="btn btn-primary mb-3">Add Artist</a>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Artist Name</th>
              <th>Artist Image</th>
              <th>Bio</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php($no = 1)
            @foreach ($artist as $artist)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $artist->ArtistName }}</td>
                <td><img src="{{ asset('images/'.$artist->ArtistImage) }}" alt="{{ $artist->ArtistName }}" width="150" height="100"></td>
                <td>{{ $artist->Bio }}</td>
                <td>
                  <a href="{{ route('artists.edit', $artist->ArtistID) }}" class="btn btn-warning">Edit</a>
                  <a href="{{ route('artists.delete', $artist->ArtistID) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this artist?')">Delete</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
