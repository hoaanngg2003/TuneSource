@extends('layouts.app')

@section('title', 'Form Genre')

@section('contents')
  <form action="{{ isset($genre) ? route('genres.update', $genre->GenreID) : route('genres.save') }}" method="post">
    @csrf
    <div class="row">
      <div class="col-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ isset($genre) ? 'Edit Genre' : 'Upload Genre' }}</h6>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="GenreName">Genre Name</label>
              <input type="text" class="form-control" id="GenreName" name="GenreName" value="{{ isset($genre) ? $genre->GenreName : '' }}">
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
