@extends('layouts.master')

@section('title',"Todo")
    
@section('content')
  
    <h1>Update Todo</h1>
    
    <div class="w-25">
    <form action="{{ route('todo.update',$todo->id) }}" method="POST">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="name">Name</label>
          <input type="text" class="form-control mb-3" name="name" id="name" value="{{ old('name',$todo->name) }}">
            @error('name')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          <button type="submit" class="btn btn-dark">Update Todo</button>
        </form>
  </div>
  <a href="{{ route('todo.index') }}" class="btn btn-outline-danger mt-4">Back To All Todo</a>
@endsection