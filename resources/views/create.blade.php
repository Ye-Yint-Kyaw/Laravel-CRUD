@extends('layout.master')

@section('content')
    <form action="{{route('item.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Enter name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') border border-danger  @enderror ">
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Choose image</label>
            <input type="file" name="image" id="image" class="form-control @error('image') border border-danger  @enderror">
            @error('image')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <input type="submit" value="Create" class="btn btn-sm btn-dark">
    </form>
@endsection
