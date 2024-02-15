@extends('auth.master')
@section('title', 'Signup')
@section('content')

    <div class="container" style="margin-top: 60px;">
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <section>
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                    class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <!-- Name input -->
                    <div class="form-outline mb-3">
                        <input id="name" type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Enter a name"  />
                        <label class="form-label" for="name">Name</label>
                    </div>
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror

                    <!-- Email input -->
                    <div class="form-outline mb-3">
                        <input type="email" id="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                        placeholder="Enter a valid email address" />
                        <label class="form-label" for="email">Email address</label>
                    </div>
                        @error('email')
                        <small class="invalid-feedback">{{$message}}</small>
                        @enderror

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <input type="password" name="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                        placeholder="Enter password" />
                        <label class="form-label" for="password">Password</label>
                    </div>
                        @error('password')
                        <small class="invalid-feedback">{{$message}}</small>
                        @enderror

                    <div class="d-flex mb-3">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" name="role" id="flexRadioDefault1" value="employee" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Employee
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="flexRadioDefault2" value="employer">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Employer
                            </label>
                        </div>
                    </div>

                    <div class="text-center text-lg-start my-4 pt-2">
                        <button class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? 
                            <a href="{{ route('login') }}" class="link-danger">Login</a>
                        </p>
                    </div>

                    </form>
                </div>
                </div>
            </div>
            <div
                class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                <!-- Copyright -->
                <!-- <div class="text-white mb-3 mb-md-0">
                Copyright © 2020. All rights reserved.
                </div> -->
            </div>
        </section>
        
    </div>
@endsection
