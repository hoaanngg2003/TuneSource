@extends('layouts.app')

@section('title', 'Data Genre')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data genre</h6>
    </div>
    <div class="card-body">
      <a href="{{ route('genres.add') }}" class="btn btn-primary mb-3">Add Genre</a>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Genre Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php($no = 1)
            @foreach ($genre as $row)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->GenreName }}</td>
                <td>
                  <a href="{{ route('genres.edit', $row->GenreID) }}" class="btn btn-warning">Edit</a>
                  <a href="{{ route('genres.delete', $row->GenreID) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Genre ?')" >Delete</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
