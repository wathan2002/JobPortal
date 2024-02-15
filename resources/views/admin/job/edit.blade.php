@extends('admin.layout.app')
@section('content')
    <div class="container">
        <form action="{{url('admin/jobs/'. $job->id)}}" method="post">
            @csrf @method('put')
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="">Title</label>
                        <input type="text" name="title" placeholder="Enter your name" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?? $job->title }}">
                        @error('title')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Category</label>
                        <select name="category_id" class="form-select" aria-label="Default select example">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$job->category_id == $category->id ? 'selected' : ' '}}>{{$category->name}}</option>
                            @endforeach
                            {{-- @foreach ($categories as $category)
                                @if($job->category_id == $category->id)
                                    <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                                    <option value="{{ $category->id }}">{{$category->name}}</option>
                            @endforeach --}}
                        </select>
                        @error('category_id')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea type="text" name="description" id="" placeholder="Enter your description..." class="form-control">{{ old('description') ?? $job->description }}</textarea>
                        @error('description')
                            <small class="text-danger">{{$message}}</small> <br>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="">Salary</label>
                        <input type="text" name="salary" placeholder="$" class="form-control" value="{{ old('salary') ??$job->salary}}">
                        @error('salary')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary float-end">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
