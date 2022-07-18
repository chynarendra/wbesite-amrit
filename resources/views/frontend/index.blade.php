<html class="no-js" lang="en">

@include('frontend.head')

<body id="menu" class="body-page">
    <!-- Page Loader : just comment these lines to remove it -->
    <div class="page-loader" id="page-loader">
        <div>
            <div class="icon ion-spin"></div>
            <p>loading</p>
        </div>
    </div>

    @include('frontend.header')

    <!-- BEGIN OF page cover -->
    <div class="page-cover" id="parallax-cover">

        <!-- Transluscent mask as filter -->
        <div class="cover-bg-mask bg-color" data-bgcolor="#ffffff"></div>


    </div>
    <!--END OF page cover -->

    <!-- BEGIN OF page main content -->
    <main class="page-main page-fullpage main-anim" id="mainpage">
        @include('frontend.home.slider')
        @include('frontend.home.about')
        @include('frontend.home.photos')
        @include('frontend.home.clients')
        @include('frontend.contact')
    </main>

    @include('frontend.footer')

</body>

</html>