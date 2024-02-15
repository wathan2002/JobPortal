@extends('ui_panel.master')
@section('title', 'News')
@section('content')

    <div class="row m-3">
        <div class="col-md-7">
            <div class="row">
            @foreach($news as $new)
                <div>
                    <div class="card border-0 shadow mb-5 rounded" style="height:450px;">
                        <div class="card-header p-0">
                            @if($new->image)
                            <img src="{{asset('storage/news-images/'.$new->image)}}" alt="" class="w-100 rounded-top" style="height: 250px; object-fit:cover;">
                            @endif
                        </div>
                        <div class="card-body rounded-bottom" style="background-color: white">
                            <h5>{{$new->created_at->diffForHumans()}}</h5> <br>
                            <h5 class="card-title"><strong>{{$new->news_category->name}}</strong></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary"><strong>{{$new->title}}</strong></h6>
                            <p class="card-text">
                                {{substr($new->description, 0, 100)}} 
                                <a href="{{url('/news/'.$new->id.'/detail')}}" class="fw-bold text-decoration-none">See more...</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <form class="d-flex mb-3" action="{{ url('searchNews') }}" method="get"> @csrf
                <input class="form-control me-2" name="search_data" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            @foreach($news_categories as $news_category)
            <div>
                <ul>
                    <li style="list-style-type: none;">
                        <a href="{{url('news/'.$news_category->id.'/search')}}" class="text-decoration-none"><b>- {{$news_category->name}}</b></a>
                    </li>
                </ul>
            </div>
            @endforeach
        </div>
    </div>

@endsection