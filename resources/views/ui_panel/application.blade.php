@extends('ui_panel.master')
@section('title', 'Application')
@section('content')

    <div class="container my-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h4 class="m-3">Application Form</h4>
                <div class="border border-2 rounded bg-secondary p-4">
                    <div>
                        <h5 class="my-3 float-end"><b>Job title: {{ $job->title }}</b></h5>
                    </div>
                    <form action="{{ url('application/store') }}" method="post" class="p-4" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        <input type="hidden" name="employee_id" value="{{ Auth::user()->id }}">
                        
                        <div class="mb-3">
                            <div class="form-group">
                                <div class="file-upload-form">
                                    <label for="file" class="file-upload-label">
                                        <div class="file-upload-design">
                                            <svg viewBox="0 0 640 512" height="1em">
                                                <path
                                                d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39V392c0 13.3 10.7 24 24 24s24-10.7 24-24V257.9l39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"
                                                ></path>
                                            </svg>
                                            <p>Upload Image</p>
                                        </div>
                                        <input id="file" type="file" name="image" class="form-control @error('image') is-invalid @enderror" />
                                        @error('image')
                                        <span class="text-danger"><small>{{ $message }}</small></span>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" value="{{ Auth::user()->name }}">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Email" value="{{ Auth::user()->email }}">
                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Mobile</label>
                            <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" id="phone" placeholder="Mobile">
                            @error('mobile')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <select name="address" id="address" class="form-select" aria-label="Default select example">
                                <option value="Yangon">Yangon</option>
                                <option value="Mandalay">Mandalay</option>
                                <option value="Pyin Oo Lwin">Pyin Oo Lwin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="salary">Salary</label>
                            <input id="salary" type="text" name="salary" placeholder="$" class="form-control @error('salary') is-invalid @enderror" value="{{$job->salary}}">
                            @error('salary')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="employee" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="employer">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Female
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault3" value="employer">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Other
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary d-flex flex-row-reverse">Submit</button>

                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

@endsection
