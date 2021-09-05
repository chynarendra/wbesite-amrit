@extends('backend.layouts.app')
<script src="{{url('plugins/chart/highcharts.js')}}"></script>
<script src="{{url('plugins/chart/export-data.js')}}"></script>
<script src="{{url('plugins/chart/exporting.js')}}"></script>
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$page_title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">{{$page_title}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="box box-plane">

            </div>
            <div class="container-fluid">

                <div class="row">
                    @if(Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2)
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total User</span>
                                <span class="info-box-number">
                               {{$total_user}}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    @endif
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-md"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Customer</span>
                                    <span class="info-box-number">
                               {{$total_customer}}
                                </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Today Followup  Customer</span>
                                    <span class="info-box-number">
                               {{sizeof($today_follow_up_customer)}}
                                </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-list"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Product</span>
                                    <span class="info-box-number">
                               {{$total_product}}
                                </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>

                    <!-- ./col -->
                </div>
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title text-primary">Current Fiscal Year : {{currentFy()->code}} </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            {{--<button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>--}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div id="customer">

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        Highcharts.chart('customer', {
            chart: {
                type: 'column'
            },
            title: {
                text: '{{trans('Total Number Of Customer By Status')}}'

            },
            xAxis: {
                categories: [
                    @for($i=1; $i<=12; $i++)
                        '{{$monthNames[$i]}}',
                    @endfor
                ]

            },
            yAxis: {
                min: 0,
                title: {
                    text: '{{trans('Total  no of customer.')}}'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: ( // theme
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || 'gray'
                    }
                }
            },
            credits: {
                enabled: false
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "printChart", "downloadPNG", "downloadJPEG", "downloadPDF", "downloadCSV", "downloadXLS"]
                    }
                },
                filename: 'customer status'
            },
            legend: {
                align: 'right',
                x: -30,
                verticalAlign: 'top',
                y: 25,
                floating: true,
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            // ]
            <?php echo $customer_month_wise_js_series_data;?>
        });
    </script>
    <!-- /.content-wrapper -->
@endsection