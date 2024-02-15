<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
    .file-upload-form {
    width: fit-content;
    height: fit-content;
    display: flex;
    align-items: center;
    justify-content: center;
    }
    .file-upload-label input {
    display: none;
    }
    .file-upload-label svg {
    height: 40px;
    fill: rgb(82, 82, 82);
    margin-bottom: 5px;
    }
    .file-upload-label {
    cursor: pointer;
    background-color: #ddd;
    padding: 10px 40px;
    border-radius: 20px;
    border: 2px dashed rgb(82, 82, 82);
    box-shadow: 0px 0px 200px -50px rgba(0, 0, 0, 0.719);
    }
    .file-upload-design {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 5px;
    }
    .browse-button {
    background-color: rgb(82, 82, 82);
    padding: 5px 15px;
    border-radius: 10px;
    color: white;
    transition: all 0.3s;
    }
    .browse-button:hover {
    background-color: rgb(14, 14, 14);
    }
    </style>
    <!-- Custom fonts for this template-->
    <link href="{{asset('admin-assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    {{-- <link href="admin-assets/css/sb-admin-2.min.css" rel="stylesheet"> --}}
    <link href="{{asset('admin-assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 fw-bolder" href="{{url('/')}}"><i>Job Portal</i></a>
            <a class="nav-link me-2 fs-5 fw-bold text-light" href="{{url('/news')}}">News</a>
            <div class="collapse navbar-collapse d-flex justify-content-end">
                @if (Auth::check())
                    <img class="img-profile rounded-circle" style="object-fit: cover; width: 30px; height:30px;"
                     src="{{asset('storage/images/'.Auth::user()->image)}}">
                    <a href="{{ url('employee-profile')}}" class="text-decoration-none text-light ms-2"><b>{{Auth::user()->name}}</b></a>
                    <div>
                        <form action="{{ route('logout') }}" method="post"> @csrf
                            <button class="btn btn-sm bg-secondary m-3 float-end" onclick="return confirm('Are you sure to logout?')"> <i class="bi bi-box-arrow-right"></i> </button>
                        </form>
                    </div>
            
                @else
                    <div class="navbar-nav">
                        <a class="nav-link fs-6 fw-bold" href="{{url('login')}}">Sign In</a>
                        <a class="nav-link fs-6 fw-bold" href="{{url('register')}}">Sign Up</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>

   


    @yield('content')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
