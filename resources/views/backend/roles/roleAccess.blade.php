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
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{trans('app.roles')}}</a></li>
                            <li class="breadcrumb-item">{{$page_title}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header" style="text-align:right">
                    <h3 class="card-title">{{trans('Assign roles to user type')}}</h3>
                    <a href="{{URL::previous()}}" class="float-right" data-toggle="tooltip" title="Go Back">
                        <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['class'=>'form-inline','url'=>'roles/userTypeRoleAccess','method'=>'GET']) !!}
                            <div class="form-group col-sm-6 col-xs-6 col-md-3 col-lg-3">

                                {{Form::select('type_id',$typeList->pluck('type_name','id'),$request->type_id,['class'=>'form-control select2','style'=>'width:100%;','required','id'=>'type_id','placeholder'=>
                                'Select User Type'])}}
                                {!! $errors->first('type_id', '<span class="text-danger">:message</span>') !!}

                            </div>
                            
                            <button type="submit" class="btn btn-primary"
                                    name="filter" value="filter">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                {{trans('app.filter')}}
                            </button>
                            <a href="{{url('/roles/userTypeRoleAccess')}}"
                               class="btn btn-default"> <i
                                        class="fas  fa-sync-alt"></i> {{trans('app.refresh')}}
                            </a>
                            {!! Form::close() !!}

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if($request->type_id !=null)
                                <div class="table-responsive">
                                    <table class="table  table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{trans('app.module')}}</th>
                                            <th>{{trans('app.readAccess')}}</th>
                                            <th>{{trans('app.writeAccess')}}</th>
                                            <th>{{trans('app.editAccess')}}</th>
                                            <th>{{trans('app.deleteAccess')}}</th>
                                            <th>{{trans('app.showAccess')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($menus as $key=>$menu)

                                            <?php
                                            $secondLevelMenus = $menuRepo->getAccessMenu($menu->id,$request->type_id);
                                            ?>
                                            <tr>
                                                <td>{{ ++$key }}. {{ $menu->menu_name }}</td>
                                                <td>
                                                    <div class="checkbox">

                                                        <label>
                                                            <input type="checkbox" data-toggle="toggle"
                                                                   data-size="mini"  data-onstyle="success" data-offstyle="danger" data-width="45"
                                                                   class="read"
                                                                   {{ ($menu->allow_view == 1)?'checked':null }}
                                                                   value="{{$menu->group_role_id}}">
                                                        </label>
                                                    </div>
                                                </td>
                                                @if(count($secondLevelMenus) == 0 && $menu->id !=1)
                                                    <td><!-- Rounded switch -->
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" data-toggle="toggle"
                                                                       data-size="mini"  data-onstyle="success" data-offstyle="danger" data-width="45"
                                                                       {{ ($menu->allow_add == 1)?'checked':null }}
                                                                       class="write"
                                                                       value="{{$menu->group_role_id}}">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><!-- Rounded switch -->
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" data-toggle="toggle"
                                                                       data-size="mini"  data-onstyle="success" data-offstyle="danger" data-width="45"
                                                                       {{ ($menu->allow_edit == 1)?'checked':null }}
                                                                       class="edit"
                                                                       value="{{ $menu->group_role_id }}">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><!-- Rounded switch -->
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" data-toggle="toggle"
                                                                       data-size="mini"  data-onstyle="success" data-offstyle="danger" data-width="45"
                                                                       {{ ($menu->allow_delete == 1)?'checked':null }}
                                                                       class="delete"
                                                                       value="{{$menu->group_role_id}}">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><!-- Rounded switch -->
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" data-toggle="toggle"
                                                                       data-size="mini"  data-onstyle="success" data-offstyle="danger" data-width="45"
                                                                       {{ ($menu->allow_show == 1)?'checked':null }}
                                                                       class="show"
                                                                       value="{{$menu->group_role_id}}">
                                                            </label>
                                                        </div>
                                                    </td>
                                                @endif

                                            </tr>
                                            @if(count($secondLevelMenus) > 0)
                                                @foreach($secondLevelMenus as $val=>$secondLevelMenu)
                                                    <tr>
                                                        <td><p style="padding-left: 15px;">{{ $key.'.'.++$val }}
                                                                . {{ $secondLevelMenu->menu_name }}</p></td>
                                                        <td>
                                                            <div class="checkbox">

                                                                <label>
                                                                    <input type="checkbox" data-toggle="toggle"
                                                                           data-size="mini"  data-onstyle="success" data-offstyle="danger" data-width="45"
                                                                           {{ ($secondLevelMenu->allow_view == 1)?'checked':null }}
                                                                           class="read"
                                                                           value="{{$secondLevelMenu->group_role_id}}">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        @if($secondLevelMenu->action_module_status == 1)
                                                        <td><!-- Rounded switch -->
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" data-toggle="toggle"
                                                                           data-size="mini"  data-onstyle="success" data-offstyle="danger" data-width="45"
                                                                           {{ ($secondLevelMenu->allow_add == 1)?'checked':null }}
                                                                           class="write"
                                                                           value="{{$secondLevelMenu->group_role_id}}">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><!-- Rounded switch -->
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" data-toggle="toggle"
                                                                           data-size="mini"  data-onstyle="success" data-offstyle="danger" data-width="45"
                                                                           {{ ($secondLevelMenu->allow_edit == 1)?'checked':null }}
                                                                           class="edit"
                                                                           value="{{ $secondLevelMenu->group_role_id }}">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><!-- Rounded switch -->
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" data-toggle="toggle"
                                                                           data-size="mini"  data-onstyle="success" data-offstyle="danger" data-width="45"
                                                                           {{ ($secondLevelMenu->allow_delete == 1)?'checked':null }}
                                                                           class="delete"
                                                                           value="{{$secondLevelMenu->group_role_id}}">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><!-- Rounded switch -->
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" data-toggle="toggle"
                                                                           data-size="mini"  data-onstyle="success" data-offstyle="danger" data-width="45"
                                                                           {{ ($secondLevelMenu->allow_show == 1)?'checked':null }}
                                                                           class="show"
                                                                           value="{{$secondLevelMenu->group_role_id}}">
                                                                </label>
                                                            </div>
                                                        </td>
                                                            @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-info-circle"></i>  Please select the user type from above drop down menu.
                                        </h3>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.read').on('change', function () {
                read = $(this).val();

                $.ajax({
                    url: "userTypeRoleChangeAccess/1/" + read,
                    type: "GET"
                });
                setInterval('location.reload()', 2000); //refresh after 3 sec

            });

            $('.write').on('change', function () {
                write = $(this).val();
                $.ajax({
                    url: "userTypeRoleChangeAccess/2/" + write,
                    type: "GET"
                });
                setInterval('location.reload()', 3000);

            });

            $('.edit').on('change', function () {
                edit = $(this).val();
                $.ajax({
                    url: "userTypeRoleChangeAccess/3/" + edit,
                    type: "GET"
                });
                setInterval('location.reload()', 3000);

            });

            $('.delete').on('change', function () {
                del = $(this).val();
                $.ajax({
                    url: "userTypeRoleChangeAccess/4/" + del,
                    type: "GET"
                });
                setInterval('location.reload()', 3000);

            });

            $('.show').on('change', function () {
                sh = $(this).val();
                $.ajax({
                    url: "userTypeRoleChangeAccess/5/" + sh,
                    type: "GET"
                });
                setInterval('location.reload()', 3000);

            });

        });
    </script>
@endsection
