@extends('admin.layout.app')
@section('content')
    <div class="container">
        <form action="{{url('admin/jobs')}}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="">Title</label>
                        <input type="text" name="title" placeholder="Enter your name" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                        @error('title')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Category</label>
                        <select name="category_id" class="form-select" aria-label="Default select example">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea type="text" name="description" id="" placeholder="Enter your description..." class="form-control  @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Salary</label>
                        <input type="text" name="salary" placeholder="" class="form-control  @error('salary') is-invalid @enderror" value="{{ old('salary') }}">
                        @error('salary')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <input type="hidden" name="employer_id" value="{{ Auth::user()->id }}">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary float-end">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
