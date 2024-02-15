@extends('ui_panel.master')
@section('title', 'News Detail')
@section('content')

<div class="container my-4">
    <div class="row">
        <div class="col-md-8">
            <img src="{{asset('storage/news-images/'.$new->image)}}" class="rounded" style="width:100%;height:500px;object-fit:cover;">
            <div>
                <div class="text-success"><strong class="text-dark">Posted On:</strong> {{$new->created_at->diffForHumans()}}</div>
                <div class="mb-3 fw-bold"><strong>Category:</strong> {{$new->news_category->name}}</div>
                <h3 class="fw-bold">{{$new->title}}</h3>
                <p>{{$new->description}}</p>
            </div>

            <div class="row my-2">
                <div class="col-md-6"></div>
                <div class="col-md-6">

                    @if (Auth::check())
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">

                                <button type="button" class="collapsed btn btn-sm btn-success position-relative" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false">
                                    Leave a Comment >>>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                    {{ $comments->count() }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                                </button>

                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <form action="{{url('news/comment/'.$new->id)}}" method="post" class="mb-5">
                                        @csrf
                                        <textarea class="form-control" name="comment" rows="3" placeholder="Comment" style="width: 340px;"></textarea>
                                        <button class="btn btn-primary mt-2">Send</button>
                                    </form>
                                    @foreach($comments as $comment)
                                    <div class="my-3">
                                        <img class="img-profile rounded-circle" style="object-fit: cover; width: 30px; height:30px;"
                                        src="{{asset('storage/images/'.$comment->user->image)}}">
                                        <span class="mr-2 d-none d-lg-inline fw-bold">{{$comment->user->name}}</span>

                                        <div style="width: 350px; min-height:70px; background-color: gray;" class="shadow-sm p-3 mt-2 mb-5 bg-body-tertiary rounded">
                                            {{$comment->comment}}
                                        </div>                        
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                        <a href="{{url('login')}}" class="btn btn-sm btn-success">Leave a Comment >>></a>
                    @endif
                </div>
            </div>
                
            
        </div>
    </div>
</div>

@endsection