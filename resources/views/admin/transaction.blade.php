@extends('layouts.admin_layout')
@section('content')

<!-- BEGIN : Main Content-->
<div class="main-content">
    <div class="content-wrapper">
        <div class="row">
            @if (\Session::has('doneMessage'))
            <input type="hidden" id="donemessage" value="{{ \Session::get('doneMessage')}}">
            @endif

        </div>
        <!-- Taskboard Starts -->
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                                        <h4 class="card-title"><i class="icon-refresh"></i> Transactions
                                        </h4>
                                    </div>

                                    <div class="col-lg-6 col-sm-8 col-md-6 col-xs-12 text-right">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                                        class="fa fa-home"></i> Home</a></li>
                                            <li class="breadcrumb-item active">Transactions </li>
                                        </ol>
                                    </div>
                                    <!-- /.breadcrumb -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 mx-2">
                            <div class="card-content card-dashboard table-responsive">
                                <table class="table table-striped  ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Plan</th>
                                            <th>Amount</th>
                                            <th>Payment Status</th>
                                            <th>End Date</th>
                                            <th>Member Since</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($users))
                                        @foreach($users as $user)
                                        @foreach($stripe->subscriptions->all(['customer' => $user->stripe_id]) as $key
                                        => $value)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{ $value->plan->interval }}</td>
                                            <td>${{ $value->plan->amount/100 }}</td>
                                            <td>{{ strtoupper($value->status) }}</td>
                                            <td>{{ date('Y-m-d',$value->current_period_end) }}</td>
                                            <td>{{ date('Y-m-d',strtotime($user->created_at)) }}</td>
                                            <td><button class="btn" onclick="subscriptionDelete('{{$value->id}}')"><i
                                                        class="fa fa-trash danger"></i></button> </td>
                                        </tr>
                                        @endforeach
                                        @endforeach
                                        @endif
                                    </tbody>

                                </table>
                                <div class="row">
                                    <div class="col-md-12" style="padding-left:72%">


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
function subscriptionDelete(id) {
    var token = $("meta[name='csrf-token']").attr("content");

    swal({
            title: "Are you sure?",
            text: "But you will still be able to retrieve this transaction.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dd3819",
            confirmButtonText: "Yes, delete this transaction!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {

                console.log(id);
                $.ajax({
                    url: "{{route('admin.transactionDestroy')}}",
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function() {
                        swal({
                            title: "Deleted!",
                            text: "Transaction was removed successfully!",
                            type: "success"
                        }, function() {
                            location.reload()
                        });
                    }

                })

            } else {
                swal("Cancelled", "Transaction is safe :)", "error");
            }
        });
}
</script>
@endsection