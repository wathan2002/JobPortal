@extends('admin.layout.app')
@section('content')

    <div class="container">

        <a href="{{route('userList')}}" class="btn btn-sm btn-info float-end">
            < Back
        </a>
        <div class="row">
            @if(isset($payment))
                <div class="col-md-5">
                    <div class="border mt-5 rounded shadow">
                        <ul class="list-group list-group-flush p-3">
                            <li class="list-group-item bg-transparent"><b>Name :</b>&nbsp;</li>
                            <div class="mb-3 text-center">
                                <img src="{{asset('/storage/voucher-images/'.$payment->voucher_image)}}" alt="" style="width: 200px">
                            </div>
                        </ul>
                    </div>
                </div>
            @else
            <p>No payment yet.</p>
            @endif
        </div>
    </div>

@endsection
