@extends('ui_panel.master')
@section('title', 'Welcome')
@section('content')

    <div class="container my-3">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <form class="d-flex" action="{{ url('search') }}" method="get"> @csrf
                    <input class="form-control me-2" name="search_data" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                @if ($jobs->isEmpty())
                    <p class="mt-3 fw-bold fs-5">No jobs available for this category.</p>
                @else
                    @foreach ($jobs as $job)
                    <div class="card my-2 border border-info">
                        <h4 class="card-header bg-transparent border-0">
                            {{$job->title}}
                        </h4>
                        <div class="card-body">
                            <div>{{$job->description}}</div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <div class="float-start text-warning">${{$job->salary}}</div>
                            <a href="{{ route('apply', $job->id) }}" class="btn btn-sm btn-primary float-end">Apply</a>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            <div class="col-md-4">
                @foreach ($categories as $category)
                    <div>
                        <ul>
                            <li style="list-style-type: none">
                                <a href="{{ url('search_category/'. $category->id) }}" 
                                class="text-decoration-none">
                                <b>- {{$category->name}}</b>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container">
        <h3 class="text-center fs-2">Here You Can See<br>
            <span style = "color:#a2d2ff">Our Popular News</span>
        </h3>
        <div class="row p-3">
            <div class="col-md-6">
                @if ($news->isEmpty())
                    <p class="mt-3 fw-bold">No news available for this category.</p>
                @else
                    @foreach ($news as $new)
                        <div class="card mb-5 border-0 shadow" style="height: auto">
                            <div class="card-header border-0 bg-transparent overflow-hidden p-0">
                                @if ($new->image)
                                    <img src="{{ asset('storage/news-images/' . $new->image) }}" class="mb-3"
                                        style="width: 100%; height:200px; object-fit:cover">
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><span>{{ $new->news_category->name }}</span></h5>
                                <p class="card-text fw-bold">{{ $new->title }}</p>
                                <p class="card-text" style="text-align: justify">
                                    {{ substr($new->description, 0, 120) }}
                                    <span class="fw-bold"><a href="{{ route('news_detail', $new->id) }}"
                                            style="text-decoration: none">See more ...</a></span>
                                </p>
                            </div>
                            <div class="card-footer border-0 bg-transparent">
                                {{-- <p class="text-success">{{ $new->created_at->format('M d, Y H:i A') }}</p> --}}
                                <p class="text-success fw-bold">{{ $new->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
