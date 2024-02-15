@extends('admin.layout.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3>NewsCategory Edit Form</h3>    
            <a href="{{url('admin/newsCategories')}}" class="btn btn-sm btn-primary mb-2"> back </a>
        </div>
        <form action="{{url('admin/newsCategories/'.$newsCategory->id)}}" method="post">
            @csrf @method('put')
            <div class="card">
                <div class="card-body">
                    <label for="">Name</label>
                    <input type="text" name="name" placeholder="Enter your name" class="form-control @error('name') is-invalid @enderror"
                    value="{{$newsCategory->name}}">
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
