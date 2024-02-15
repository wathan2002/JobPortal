@extends('admin.layout.app')
@section('content')
    <div class="container">
        <a href="{{url('admin/jobs/create')}}" class="btn btn-sm btn-primary my-3 float-end">+Add</a>

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
                    <th>Description</th>
                    <th>Category</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <td>{{$job->id}}</td>
                        <td>{{$job->title}}</td>
                        <td>{{$job->description}}</td>
                        <td>{{$job->category->name}}</td>
                        <td>{{$job->salary}}</td>
                        <td>
                            <form action="{{url('admin/jobs/'. $job->id)}}" method="post">
                                @csrf @method('delete')
                                <a href="{{url('admin/jobs/'.$job->id.'/edit')}}" class="btn btn-sm btn-warning">Edit</a>
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                <a href="{{ url('admin/job/'.$job->id.'/cv') }}" class="btn btn-sm btn-info">CV</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
