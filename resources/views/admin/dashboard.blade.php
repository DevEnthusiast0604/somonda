@extends('layouts.admin_layout')
@section('content')
<style>
.text-sm {
    font-size: 12px
}
</style>
<!-- BEGIN : Main Content-->
<div class="main-content">
    <div class="content-wrapper">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body pt-0 pb-0">
                    <div class="card-content">
                        <div class="row col-12" matchheight="card">
                            <div class="col-xl-3 col-lg-6 col-12">
                                <a href="{{route('admin.customers')}}">
                                    <div class="card bg-cyan">
                                        <div class="card-content">
                                            <div class="px-3 py-3">
                                                <div class="media">
                                                    <div class="media-body white text-left">
                                                        <h3>{{$customers}} <span class="text-sm">Customers</span></h3>
                                                        <span>Total Customers</span>
                                                    </div>
                                                    <div class="media-right align-self-center">
                                                        <i class="icon-users white font-large-2 float-right"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12">
                                <div class="card bg-warning">
                                    <div class="card-content">
                                        <div class="px-3 py-3">
                                            <div class="media">
                                                <div class="media-body white text-left">
                                                    <h3> {{$products}} / {{$active_products}}  <span
                                                            class="text-sm">Products</span></h3>
                                                    <span>Total Products</span>
                                                </div>
                                                <div class="media-right align-self-center">
                                                    <i class="ft-shopping-cart white font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12">
                                <div class="card bg-purple">
                                    <div class="card-content">
                                        <div class="px-3 py-3">
                                            <div class="media">
                                                <div class="media-body white text-left">
                                                    <h3> {{$categories}} <span
                                                            class="text-sm">Categories</span></h3>
                                                    <span>@lang('Categories')</span>
                                                </div>
                                                <div class="media-right align-self-center">
                                                    <i class="icon-pin white font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12">
                                <div class="card bg-primary">
                                    <div class="card-content">
                                        <div class="px-3 py-3">
                                            <div class="media">
                                                <div class="media-body white text-left">
                                                    <h3>kr {{$sales}} / {{$sales_count}} <span
                                                            class="text-sm">Sales</span></h3>
                                                    <span>Total Sales</span>
                                                </div>
                                                <div class="media-right align-self-center">
                                                    <i class="icon-handbag white font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sales History</h4>
                    <div class="pull-right mr-4">
                        <div class="row">
                            <div class="form-group col-md-5 mb-2">
                                <label class="sr-only" for="start_date">@lang('From')</label>
                                <input type="date" id="start_date" class="form-control" name="start_date">
                            </div>
                            <div class="form-group col-md-5 mb-2">

                                <label class="sr-only" for="end_date">@lang('To')</label>
                                <input type="date" id="end_date" class="form-control" name="end_date" value="">

                            </div>
                            <div class="col-md-2 mb-2">
                                <button class="btn btn-primary" id="period" onclick="period()"> @lang('View')</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body chartjs">
                        <canvas id="line-chart" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   
    $(document).ready(function() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var mmm = today.getMonth() - 4; //


        var yyyy = today.getFullYear();
        var yyy = yyyy;
        if (mmm < 0) {
            mmm = 12 + mmm;
        }else if(mmm == 0){
            mmm = 12;
        }
        console.log(mmm);

        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        if (mmm < 10) {
            mmm = '0' + mmm;
        }
        if (mmm > mm) {
            yyy = yyyy - 1;
        } else {
            yyy = yyyy;
        }
        today = yyyy + '-' + mm + '-' + dd;
        yesterday = yyy + '-' + mmm + '-' + dd;

        document.getElementById("end_date").setAttribute("max", today);
        document.getElementById("end_date").setAttribute("value", today);
        document.getElementById("start_date").setAttribute("value", yesterday);


        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "{{route('admin.statisticsView')}}",
            type: 'GET',
            data: {
                "start_date": start_date,
                "end_date": end_date,
                "_token": token,
            },
            dataType: 'json',
            success: function(data) {
                chartlist(data);
            }

        });
        var ctx = $("#line-chart");

        // Chart Options
        function chartlist(data) {

            var chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                },
                hover: {
                    mode: 'label'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                },
                title: {
                    display: true,
                    text: start_date + ' ~ ' + end_date
                }
            };

            // Chart Data
            var chartData = {
                labels: data["month"],
                datasets: [{
                    label: "Sales kr",
                    data: data['sales'],
                    fill: false,
                    borderDash: [5, 5],
                    borderColor: "#9C27B0",
                    pointBorderColor: "#9C27B0",
                    pointBackgroundColor: "#FFF",
                    pointBorderWidth: 2,
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                }]
            };
            var config = {
                type: 'line',
                // Chart Options
                options: chartOptions,
                data: chartData
            };
            // Create the chart
            var lineChart = new Chart(ctx, config);
        }
    });

    function period() {
        var token = $("meta[name='csrf-token']").attr("content");
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        if (start_date > end_date) {
            swal("Warning!", "Start Time should not be behind than End time.", "error");
            return;
        }


        $.ajax({
            url: "{{route('admin.statisticsView')}}",
            type: 'GET',
            data: {
                "start_date": start_date,
                "end_date": end_date,
                "_token": token,
            },
            dataType: 'json',
            success: function(data) {
                // swal("Deleted", "Subscriber was removed successfully", "error");

                // console.log(data['subscribers']);
                chartlist(data);
            }

        });
        var ctx = $("#line-chart");
        // Chart Options
        function chartlist(data) {

            var chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                },
                hover: {
                    mode: 'label'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                },
                title: {
                    display: true,
                    text: start_date + ' ~ ' + end_date
                }
            };

            // Chart Data
            var chartData = {
                labels: data["month"],
                datasets: [{
                    label: "Sales kr",
                    data: data['sales'],
                    fill: false,
                    borderDash: [5, 5],
                    borderColor: "#9C27B0",
                    pointBorderColor: "#9C27B0",
                    pointBackgroundColor: "#FFF",
                    pointBorderWidth: 2,
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                }]
            };

            var config = {
                type: 'line',
                // Chart Options
                options: chartOptions,
                data: chartData
            };
            // Create the chart
            var lineChart = new Chart(ctx, config);
        }
    }
</script>
@endsection