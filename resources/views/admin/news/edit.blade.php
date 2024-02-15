@extends('admin.layout.app')
@section('content')
<div class="container">
        <div class="d-flex justify-content-between">
            <h3>News Edit Form</h3>    
            <a href="{{url('admin/news')}}" class="btn btn-sm btn-primary mb-2"> back </a>
        </div>
        <form action="{{url('admin/news/'.$new->id)}}" method="post" enctype="multipart/form-data">
            @csrf @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter category title" value="{{ old('title') ?? $new->title }}">
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
                        <option value="{{$news_category->id}}"
                            {{$new->news_category_id == $news_category->id ? 'selected' : ' '}}
                        >
                        {{$news_category->name}}</option>
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
                    <br>
                    <img src="{{asset('storage/news-images/' .$new->image)}}" alt="" style="width: 90px;" class="mt-2">
                    @error('image')
                    <span class="text-danger"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="" rows="5" class="form-control" placeholder="Message...">{{ old('description') ?? $new->title  }}</textarea>
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
