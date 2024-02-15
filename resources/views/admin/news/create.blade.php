@extends('admin.layout.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3>News Create Form</h3>    
            <a href="{{url('admin/news')}}" class="btn btn-sm btn-primary mb-2"> back </a>
        </div>
        <form action="{{url('admin/news')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter category title" value="{{ old('title') }}">
                    @error('title')
                    <span class="text-danger"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">News Category</label> <br>
                    <select name="news_category_id" id="" class="form-control">
                        <option value="">Select Option</option>
                        @foreach($news_categories as $news_category)
                        <option value="{{$news_category->id}}">{{$news_category->name}}</option>
                        @endforeach
                    </select>
                    @error('news_category_id')
                    <span class="text-danger"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Image</label> <br>
                    <input type="file" name="image" class="@error('image') is-invalid @enderror">
                    @error('image')
                    <span class="text-danger"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="" rows="5" class="form-control" placeholder="Message...">{{ old('description') }}</textarea>
                    @error('description')
                    <span class="text-danger"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
