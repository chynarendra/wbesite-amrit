<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/dashboard')}}" class="brand-link">
        <img src="@if(systemSetting()->app_logo !=null){{asset('/storage/uploads/files/'.systemSetting()->app_logo)}} @else {{url('images/logo.png')}}   @endif" alt="Admin Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">@if(isset(systemSetting()->app_name)){{systemSetting()->app_name}} @else {{ env('APP_NAME') }}  @endif</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @if(isset(Auth::user()->image))
                <div class="image">
                    <img src="{{asset('/storage/uploads/users/'.Auth::user()->image)}}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
            @else
                <div class="image">
                    <img src="{{url('/images/dummyUser.gif')}}" class="img-circle elevation-2" alt="User Image">
                </div>
            @endif
            <div class="info">
                <a href="{{url('my-profile')}}" class="d-block">@if(isset(Auth::user()->full_name)){{Auth::user()->full_name}}@endif</a>
            </div>
        </div>

    <?php
    $firstLevelMenus = App\Repository\Roles\MenuRepository::getMenu($id = 0);
    $secondLevelMenus = App\Repository\Roles\MenuRepository::getMenu($id = session('menuId'));
    $menus = App\Repository\Roles\MenuRepository::getMenus();

    ?>
    <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            //get controller name
            session(['second_menu'=>false]);

            function activeTabHome($controllerName,$parentMenu=0)
            {

                $action = app('request')->route()->getAction();
                $controller = class_basename($action['controller']);

                list($controller, $action) = explode('@', $controller);

                // get menu link
                $menuLink=App\Repository\Roles\MenuRepository::getMenuLink($controller);

                if($menuLink){
                    if($parentMenu!=0 && $menuLink->parent_id==$parentMenu){
                        session(['second_menu'=>true]);
                    }else{
                        session(['second_menu'=>false]);
                    }

                }


                echo ($controllerName == $controller) ? 'active' : null;
            }
            ?>
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{url('/dashboard')}}" class="nav-link <?php activeTabHome('HomeController');?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(count($firstLevelMenus)>0)
                    @foreach($menus as $menu)

                        @if($menu->parent_id==0)
                            <?php
                            $secondLevelMenus = App\Repository\Roles\MenuRepository::getMenu($menu->id);
                            ?>

                            @if(count($secondLevelMenus)>0)

                                <?php

                                $action = app('request')->route()->getAction();
                                $controller = class_basename($action['controller']);

                                list($controller, $action) = explode('@', $controller);
                                // get menu link
                                $menuLink = App\Repository\Roles\MenuRepository::getMenuLink($controller);

                                ?>

                                <li class="nav-item has-treeview <?php

                                if ($menuLink) {

                                    if ($menuLink->parent_id == $menu->id) {
                                        echo ' menu-open';
                                    }else{
                                        echo '';
                                    }
                                }

                                ?> ">

                                    <a href="#" class="nav-link ">
                                        <i class="{!! $menu->menu_icon !!}" aria-hidden="true"></i>
                                        <p>
                                            {{$menu->menu_name}}
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>

                                    <ul class="nav nav-treeview">

                                        @foreach($secondLevelMenus as $secondLevelMenu)

                                            <li class="nav-item">
                                                <a href="{{url("$secondLevelMenu->menu_link")}}"
                                                   class="nav-link <?php activeTabHome($secondLevelMenu->menu_controller,$secondLevelMenu->parent_id);?>">
                                                    <i class="{!! $secondLevelMenu->menu_icon !!}" aria-hidden="true"></i>
                                                    <p>{{$secondLevelMenu->menu_name}}</p>
                                                </a>
                                            </li>

                                        @endforeach
                                    </ul>

                                </li>

                            @else

                                <li class="nav-item">
                                    <a href="{{url($menu->menu_link)}}"
                                       class="nav-link <?php activeTabHome($menu->menu_controller);?>">
                                        <i class="{!! $menu->menu_icon !!}" aria-hidden="true"></i>
                                        <p>
                                            {{$menu->menu_name}}
                                        </p>
                                    </a>
                                </li>
                            @endif
                        @endif

                    @endforeach
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>