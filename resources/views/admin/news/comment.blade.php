@extends('admin.layout.app')
@section('content')
    <div class="container">
        <div class="d-flex flex-row-reverse">
            <a href="{{url('admin/news')}}" class="btn btn-sm btn-primary my-3 float-end">back</a>
        </div>

        @if(Session('successMsg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>{{ Session('successMsg') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                Comments
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tbody>
                        @foreach($comments as $index => $comment)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$comment->comment}}</td>
                                <td>
                                    <form action="{{url('admin/comment/'.$comment->id.'/show_hide')}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm 
                                            {{$comment->status == 'show' ? 'btn-danger' : 'btn-success'}}
                                        ">   
                                            {{$comment->status == 'show' ? 'hide' : 'show'}}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
