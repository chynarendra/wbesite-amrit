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

    <!-- BEGIN OF page main content -->
    <main class="page-main page-fullpage main-anim">

        <!-- Begin of list projects section -->
        <div class="section section-list-feature fp-auto-height-responsive ">

            <!-- Begin of section wrapper -->
            <div class="section-wrapper fullwidth with-margin">
                <!-- content -->
                <div class="section-content anim">
                    <div class="row">
                        <div class="col-12 col-lg-12 text-left">
                            <!-- title and description -->
                            <div class="title-desc">
                                <h2 class="display-4 display-title anim-1">{{$video->title}}</h2>
                            </div>
                            <p>{{$video->subtitle}}</p>
                            <p>
                                <video controls>
                                    <source src="{{url('/storage'.$video->video)}}" type="video/mp4">
                                </video>
                            </p>
                            <p>{!! $video->content !!}</p>
                            
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of section wrapper -->
        </div>
        <!-- End of list projects section -->

        @include('frontend.contact')
    </main>

    @include('frontend.footer')

</body>

</html>