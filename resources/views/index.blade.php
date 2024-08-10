@extends('layout.master')

@section('content')
@if (Session::has('success'))
   <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif

<table class="table table-strtped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td><img src="{{$item->image}}" width="70px" style="border-radius: 30px;" alt=""></td>
            <td>
                <a href="{{route('item.edit', $item->id)}}" class="badge badge-warning">Update</a>
                <a href="{{route('item.delete', $item->id)}}" class="badge badge-danger">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{$items->links()}}

@endsection
