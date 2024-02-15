@extends('admin.layout.app')
@section('content')
    <div class="container">

        @if(Session('successMsg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>{{ Session('successMsg') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @elseif(Session('Fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div>{{ Session('Fail') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ url('admin/jobs') }}">
            <button class="btn btn-sm btn-primary my-3 float-end"> << Back </button>
        </form>
        <table class="table table-secondary table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Gender</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($job->applications as $application)
                    <tr>
                        <td>{{$application->id}}</td>
                        <td>{{$application->name}}</td>
                        <td>{{$application->email}}</td>
                        <td>{{$application->mobile}}</td>
                        <td>{{$application->address}}</td>
                        <td>{{$application->salary}}</td>
                        <td>{{$application->gender}}</td>
                        <td>
                            <img src="{{asset('storage/application-images/'.$application->image)}}" alt="" width="150px">
                        </td>
                        <td>
                            <form method="post">@csrf
                                <input type="hidden" name="job_id" value="{{$application->job_id}}">
                                <input type="hidden" name="employer_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="employee_id" value="{{$application->employee_id}}">
                                <input type="hidden" name="application_id" value="{{$application->id}}">

                                <button type="button" data-bs-toggle="modal" data-bs-target="#acceptCv{{$application->id}}" class="btn btn-sm btn-primary
                                     @if ($application)
                                         @if($application->accept == '1') d-none @endif
                                     @endif
                                ">
                                    Accept
                                </button>

                                <button formaction="{{ route('applications.reject', $application->id) }}" onclick="return confirm('Are you sure to reject?')" class="btn btn-sm btn-danger
                                    @if ($application)
                                         @if($application->accept == '0') d-none @endif
                                     @endif
                                ">
                                    Reject

                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="acceptCv{{$application->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('applications.accept', $application->id) }}" method="post">@csrf
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Compose message</h1>
                                  </div>
                                <div class="modal-body">
                                    <input type="hidden" name="job_id" value="{{$application->job_id}}">
                                    <input type="hidden" name="employer_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="employee_id" value="{{$application->employee_id}}">
                                    <input type="hidden" name="application_id" value="{{$application->id}}">

                                    <div>
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" rows="6" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Send
                                        </button>
                                    </form>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

