@extends('layouts.frontend')
@section('content')
@include('layouts.user_layout')
<style>
.alert.parsley {
    margin-top: 5px;
    margin-bottom: 0px;
    padding: 10px 15px 10px 15px;
}

.check .alert {
    margin-top: 20px;
}

.credit-card-box .panel-title {
    display: inline;
    font-weight: bold;
}

.credit-card-box .display-td {
    display: table-cell;
    vertical-align: middle;
    width: 100%;
    text-align: center;
}

.credit-card-box .display-tr {
    display: table-row;
}
</style>
<section class="single-banner dashboard-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active" aria-current="page">Membership</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
.membership {
    font-size: 1.43em;
    line-height: 1.05;
    font-weight: 500;
    margin-bottom: 0.25em;
}

.membership_price {

    font-size: 2em;
    line-height: 1.2;
    font-weight: 400;
}

.membership_period {
    opacity: .5;
    margin-left: .25em;

}

.free_trial {
    position: absolute;
    right: 2em;
    bottom: 4em;
}

.free_trial1 {
    position: absolute;
    right: 2em;
    bottom: 2.4em;
}
</style>
<div class="setting-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card mb-2 alert fade show">
                    <div class="account-title">
                        <h3>Membership</h3>
                    </div>
                    @if($membership == 'no_member')
                    <p class="membership">You are not a subscribed member.</p>
                    @else
                    <div class="dash-content">
                        <p class="membership">{{$membership}}</p>
                        <span class="membership_price">{{$membership_price}}</span> /<span
                            class="membership_period">{{$membership_period}}</span>
                            @if($days <= 30) <h5 class="free_trial">{{$brand}} <span>****{{$last4}}</span></h5>
                            <span class="free_trial1"><i class="fas fa-info-circle"></i> Free trial {{7 - $days}} days
                                {{24 - $hours}} hours remain</span>
                            @else
                            <h5>{{$brand}} <span>****{{$last4}}</span></h5>
                            @endif
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="adpost-card alert fade py-4 show text-right">
                    @if($membership == 'no_member')
                    <a href="{{url('/')}}" class="btn btn-primary"><i class="ft-shopping-cart"></i> Purchase
                        Membership</a>
                    @else
                        <button onclick="cancel_membership()" class="btn btn-danger"><i class="ft-x-circle"></i> Cancel
                        Membership</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</div>
<script>
function cancel_membership() {

    var token = $("meta[name='csrf-token']").attr("content");

    swal({
            title: "Are you sure?",
            text: "But you will still be able to keep the current membership.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dd3819",
            confirmButtonText: "Yes, Cancel membership!",
            cancelButtonText: "No, Keep the current plan!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {

            
                $.ajax({
                    url: "{{route('user.cancelMembership')}}",
                    type: 'GET',
                    data: {
                        "_token": token,
                    },

                    success: function(data) {
                        swal({
                            title: "Success!",
                            text: data.message,
                            type: "success"
                        }, function() {
                            location.reload()
                        });

                    },



                })

            } else {
                swal("No changes", "Your membersip is not changed :)", "error");
            }
        });
}
</script>
@endsection