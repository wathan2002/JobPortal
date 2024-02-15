@extends('admin.layout.app')
@section('content')
    <div class="container">
        <a href="{{url('admin/news/create')}}" class="btn btn-sm btn-primary my-3 float-end">+Add</a>

        @if(Session('successMsg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>{{ Session('successMsg') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($news as $new)
                    <tr>
                        <td>{{$new->id}}</td>
                        <td>{{$new->title}}</td>
                        <td>
                            <img src="{{asset('storage/news-images/'.$new->image)}}" alt="" width="150px">
                        </td>
                        <td>
                            <textarea rows="4" readonly>{{$new->description}}</textarea>
                        </td>
                        <td>
                            <form action="{{url('admin/news/'.$new->id)}}" method="post">
                                @csrf @method('delete')
                                <a href="{{url('admin/news/'.$new->id.'/edit')}}" class="btn btn-sm btn-warning">Edit</a>
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                <a href="{{url('admin/news/'.$new->id)}}" class="btn btn-sm btn-info">Comment</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
