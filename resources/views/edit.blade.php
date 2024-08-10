@extends('layout.master')

@section('content')
    <form action="{{route('item.update', $item->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @if (Session::has('success'))
        <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        <div class="form-group">
            <label for="name">Enter name</label>
            <input type="text" value="{{$item->name}}" name="name" id="name" class="form-control @error('name') border border-danger  @enderror ">
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
            <img src="{{asset($item->image)}}" width="70px" alt="Image">
        </div>
        <input type="submit" value="Update" class="btn btn-sm btn-dark">
    </form>
@endsection
