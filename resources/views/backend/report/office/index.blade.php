@extends('backend.layouts.app')
<title>@yield('page_title',$page_title)</title>
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
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}"> {{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{$page_title}}</a></li>
                            <li class="breadcrumb-item">{{trans('app.list')}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header" style="text-align:right">
                                <h3 class="card-title">{{trans('app.list')}}</h3>
                                @if($request->office_id != null ||  $request->from_date != null ||  $request->to_date != null)
                                    <strong style="margin-right: 350px;"> Total Sell Count :
                                        <span style="font-size: 16px; color: #007bff;">{{$totalResult}}</span>
                                    </strong>
                                @endif


                                <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip"
                                   title="Go Back">
                                    <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                                <a href="{{url($page_url)}}" class="pull-right" data-toggle="tooltip"
                                   title="View List">
                                    <i class="fa fa-list fa-2x"></i>
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="accordion">
                                        <div class="card-header">
                                            <h4 class="card-title float-right">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#search">
                                                    <i class="fas fa-filter"></i>Filter
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="search"
                                             class="panel-collapse collapse @if($request->office_id != null ||  $request->from_date != null ||  $request->to_date != null)show @endif">
                                            <table class="table table-responsive p-0" width="100%">
                                                <form action="{{url($page_url)}}" autocomplete="off">
                                                    <tr>
                                                        <td style="width: 25%">
                                                            {{Form::select('office_id',$officeList->pluck('office_name','id'),Request::get('office_id'),['class'=>'form-control select2','style'=>'width: 100%;','placeholder'=>
                                                     'Select Office Name'])}}

                                                        </td>

                                                        <td>
                                                            {!!Form::text('from_date',Request::get('from_date'),['class'=>'form-control','id'=>'from_date','autocomplete'=>'off','width'=>'100%','placeholder'=>
                                                                               trans('app.start_date'),'readonly']) !!}
                                                        </td>

                                                        <td>
                                                            {!!Form::text('to_date',Request::get('to_date'),['class'=>'form-control','id'=>'to_date','autocomplete'=>'off','width'=>'100%','placeholder'
                                                                                =>
                                                                               trans('app.start_date'),'readonly']) !!}
                                                        </td>

                                                        <td colspan="5"
                                                            class="text-center">
                                                            <button type="submit" class="btn btn-primary"><i
                                                                        class="fa fa-search"></i> {{trans('app.filter')}}
                                                            </button> &nbsp; &nbsp;
                                                            <a href="{{url($page_url)}}"
                                                               class="btn btn-default"> <i
                                                                        class="fas  fa-sync-alt"></i> {{trans('app.refresh')}}
                                                            </a>
                                                            &nbsp; &nbsp;
                                                            <a class="btn btn-danger" data-toggle="collapse"
                                                               data-parent="#accordion" href="#search">
                                                                <span aria-hidden="true">&times;</span> Close
                                                            </a>
                                                        </td>

                                                    </tr>
                                                    @if($totalResult > 0 && ($request->office_id != null ||  $request->from_date != null ||  $request->to_date != null))
                                                        <tr>
                                                            <td colspan="5"
                                                                class="text-center">
                                                                <button onclick="exportTableToExcel('tblData')"
                                                                        class="btn  btn-success"><i
                                                                            class="fas fa-file-excel"></i> {{trans('Export To Excel')}}
                                                                </button>
                                                                &nbsp; &nbsp;
                                                                <button onclick="printReport()"
                                                                        class="btn  btn-primary"><i
                                                                            class="fa fa-print"></i> {{trans('Print')}}
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endif

                                                </form>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.card-header -->
                            @if(sizeof($results) > 0)
                                <div class="card-body">
                                    <div id="tblData">
                                        <table id="example2" class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th width="10px">{{trans('app.sn')}}</th>
                                                <th>{{trans('Office Name')}}</th>
                                                <th>{{trans('Product')}}</th>
                                                <th>{{trans('Purchased By')}}</th>
                                                <th>{{trans('Purchase Date')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $key=>$data)
                                                <tr>
                                                    <th scope=row>{{ ($results->currentpage()-1) * $results->perpage() + $key+1 }}</th>
                                                    <td>
                                                        @if(isset($data->office->office_name))
                                                            {{$data->office->office_name}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($data->product->product_name))
                                                            {{$data->product->product_name}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($data->customer->customer_name))
                                                            {{$data->customer->customer_name}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{$data->purchase_date}}
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <span class="float-right">{{ $results->appends(request()->except('page'))->links() }}
                                    </span>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            @else
                                <div class="col-md-12" style="padding-top: 10px">
                                    <label class="form-control badge badge-info"
                                           style="text-align:  center; font-size: 18px;">
                                        <i class="fas fa-ban"></i> No record found yet !.
                                    </label>
                                </div>
                        </div>
                    @endif
                        <div id="printP" style="display: none">
                            <table  class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th width="10px">{{trans('app.sn')}}</th>
                                    <th>{{trans('Office Name')}}</th>
                                    <th>{{trans('Product')}}</th>
                                    <th>{{trans('Purchased By')}}</th>
                                    <th>{{trans('Purchase Date')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($results as $key=>$data)
                                    <tr>
                                        <td>{{ ++ $key }}</td>
                                        <td>
                                            @if(isset($data->office->office_name))
                                                {{$data->office->office_name}}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($data->product->product_name))
                                                {{$data->product->product_name}}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($data->customer->customer_name))
                                                {{$data->customer->customer_name}}
                                            @endif
                                        </td>
                                        <td>
                                            {{$data->purchase_date}}
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    <!-- /.card -->

                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.container-fluid -->
        <!-- /.content -->

    </div>

    <script>
        function exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'office-wise-sell-report.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }
    </script>
    <script>
        function printReport() {
            var printContents = document.getElementById("printP").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = "<html><head><title></title></head><body>" + printContents + "</body>";
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
    <!-- /.content-wrapper -->

@endsection