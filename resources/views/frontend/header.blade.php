<!-- BEGIN OF site header Menu -->
<header class="page-header navbar page-header-alpha scrolled-white menu-right topmenu-right">

  <!-- Begin of menu icon toggler -->
  <button class="navbar-toggler site-menu-icon" id="navMenuIcon">
    <!-- Available class : menu-icon-dot / menu-icon-thick /menu-icon-random -->
    <span class="menu-icon menu-icon-normal">
      <span class="bars">
        <span class="bar1"></span>
        <span class="bar2"></span>
        <span class="bar3"></span>
      </span>
    </span>
  </button>
  <!-- End of menu icon toggler -->

  <!-- Begin of logo/brand -->
  <a class="navbar-brand" href="{{url('/')}}">
    <span class="logo">
      @if($headOfficeDetail->logo!=null)
      <img class="light-logo" src="{{url($headOfficeDetail->logo)}}" alt="Logo">
      @else
      <img class="light-logo" src="{{url('frontend/img/logo.png')}}" alt="Logo">
      @endif

    </span>
    <span class="text">
      <span class="line">{{$headOfficeDetail->office_name}}</span>
      <span class="line sub">{{$headOfficeDetail->sub_title}}</span>
    </span>
  </a>
  <!-- End of logo/brand -->

  <!-- begin of menu wrapper -->
  <div class="all-menu-wrapper" id="navbarMenu">

    <!-- Begin of hamburger mainmenu menu -->
    <nav class="navbar-mainmenu">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#home">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#photos">Latest Photos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#clients">Clients</a>
        </li>

        @if(sizeof($headerMenus) >0)
        @foreach($headerMenus as $menu)
        <li class="nav-item">
          @if($menu->menu_type=='module')
          <a class="nav-link" href="{{$menu->module_url}}">{{$menu->name}}</a>
          @elseif($menu->menu_type=='url')
          <a class="nav-link" href="{{$menu->external_url}}">{{$menu->name}}</a>
          @else
          <a class="nav-link" href="{{$menu->page_url}}">{{$menu->name}}</a>
          @endif
        </li>
        @endforeach
        @endif
        
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
       
      </ul>
    </nav>
    <!-- End of hamburger mainmenu menu -->

  </div>
  <!-- end of menu wrapper -->

</header>
<!-- END OF site header Menu-->