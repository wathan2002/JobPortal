@extends('admin.layout.app')
@section('content')
    <div class="container">
        <form action="{{url('admin/categories/'.$category->id)}}" method="post">
            @csrf @method('put')
            <div class="card">
                <div class="card-body">
                    <label for="">Name</label>
                    <input type="text" name="name" placeholder="Enter your name" class="form-control @error('name') is-invalid @enderror"
                    value="{{$category->name}}">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
