@extends('admin.layout.app')
@section('content')

    <div class="container">

        @if(Auth::user()->payment && Auth::user()->active === 0)
            <div class="alert alert-success">Your request is submited, plz wait for the admin confimation!</div>
        @elseif(Auth::user()->payment && Auth::user()->active === 1)
            <div class="alert alert-info">Your authenticated, feel free to post your jobs</div>
        @else
            <form action="{{ route('paymentStore') }}" method="POST" enctype="multipart/form-data"> @csrf
                <div class="card">
                    <div class="card-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Payment</h1>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label for="method">Payment Method</label>
                            <select name="PaymentMethod" id="method" class="form-select" aria-label="Default select example">
                                <option value="KBZ Pay">KBZ Pay</option>
                                <option value="Wave Pay">Wave Pay</option>
                                <option value="CB Pay">CB Pay</option>
                            </select>
                        </div>
                        <div>
                            <input type="hidden" name="employer_id" value="{{Auth::user()->id}}">
                            <label for="">Screenshot</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-secondary btn-sm">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                    </div>
                </div>
            </form>
        @endif

    </div>

@endsection
