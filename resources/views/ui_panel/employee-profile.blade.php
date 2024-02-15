'@extends('ui_panel.master')
@section('title', 'User Profile')
@section('content')

    <div class="">
        <div class="row">
                <div class="col-md-3">

                <div id="wrapper">

                    <!-- Sidebar -->
                    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                        <!-- Sidebar - Brand -->
                        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                            <div class="sidebar-brand-text mx-3">User Profile</div>
                        </a>

                        <!-- Divider -->
                        <hr class="sidebar-divider my-0">

                        <!-- Nav Item - Dashboard -->
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('admin/dashboard')}}">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <span>Dashboard</span></a>
                        </li>

                        <!-- Divider -->
                        <hr class="sidebar-divider d-none d-md-block">

                        <!-- Sidebar Toggler (Sidebar) -->
                        <div class="text-center d-none d-md-inline">
                            <button class="rounded-circle border-0" id="sidebarToggle"></button>
                        </div>

                    </ul>
                    <!-- End of Sidebar -->
                </div>

                    <!-- <h5 class="text-center text-secondary-emphasis text-decoration-underline">User Profile</h5> -->
                    <!-- <div class="">
                        <ul class="list-group list-group-flush p-3">
                            <div class="mb-3 text-center">
                                @if($user->image)
                                    <img src="{{ asset('storage/images/'.$user->image) }}" alt="404" id="profileImage" class="object-fit-cover rounded-circle shadow-sm" width="180px" height="180px">
                                @else
                                    <p class="text-primary"><b>No photo </b></p>
                                @endif
                            </div>
                            <li class="list-group-item"><b>Name :</b>&nbsp; {{auth()->user()->name}}</li>
                            <li class="list-group-item"><b>Email :</b>&nbsp; {{auth()->user()->email}}</li>
                            <li class="list-group-item"><b>Role :</b>&nbsp; {{auth()->user()->role}}</li>
                            <li class="list-group-item">
                                <button type="button" class="btn btn-sm btn-info float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    @if($user->image)
                                        Update
                                    @else
                                        Upload
                                    @endif
                                </button>
                            </li>
                        </ul>
                    </div> -->
                </div>
            
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Image</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('registerUpdate', Auth::user()->id)}}" method="POST" enctype="multipart/form-data"> @csrf
                            <div class="modal-body">
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                           </div>
                        </form>
                    </div>
                    </div>
                </div>

            {{-- <div class="col-md-9">
                <h5 class="mb-3">Message</h5>
                @foreach ($messages as $message)
                    <div class="card card-body my-2 border border-success">
                        <h5 class="card-title">{{ $message->employer->name }}</h5>
                        <h6 class="card-subtitle text-body-secondary mb-2">{{ $message->job->title }}</h6>
                        <p>{{ $message->message }}</p>
                        <div class="text-end">{{ $message->created_at }}</div>
                    </div>
                @endforeach
            </div> --}}

            <div class="col-md-7">
                <h5 class="text-center mb-5 text-decoration-underline">Message</h5>
                @if ($messages->count() > 0)
                    @foreach ($messages as $message)
                        <ul class="list-group list-group-flush p-3 mb-3 border rounded shadow @if ($message->accept == '1') border-success @else border-danger  @endif">
                            <li class="list-group-item"><b>Company :</b>&nbsp; {{$message->employer->name}}</li>

                            <li class="list-group-item">
                                <b>Job Title :</b>&nbsp; {{ optional($message->job)->title }}
                            </li>

                            <li class="list-group-item"><b>Salary :</b>&nbsp; {{ optional($message->job)->salary }}</li>
                            {{-- <li class="list-group-item"><b>Job Title :</b>&nbsp; {{$message->job->title}}</li>
                            <li class="list-group-item"><b>Salary :</b>&nbsp; {{$message->job->salary}}</li> --}}
                            <li class="list-group-item fw-bold {{$message->accept == 1 ? 'text-success' : 'text-danger'}}"><b class="text-dark fw-bold">Message :</b>&nbsp; {{$message->message}}</li>
                            <li class="list-group-item"><b>Date :</b>&nbsp; {{date('d-M-Y', strtotime($message->created_at))}}</li>
                            <li class="list-group-item">
                                <div class="float-end
                                    @if( $message->accept == 1) text-success @else text-danger  @endif">
                                    <b>{{$message->accept == 1 ? 'Accepted' : 'Rejected'}}</b>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                @else
                    <p class="text-center mt-5 fw-bold ">No message found !</p>
                @endif
            </div>
        </div>
    </div>

@endsection

