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
                        <div class="col-12 col-lg-6 text-left">
                            <!-- title and description -->
                            <div class="title-desc">
                                <h2 class="display-4 display-title anim-1">Films</h2> </div>
                            </div>
                        </div>

                        <!-- project list -->
                        <div class="project-list grid-1 grid-md-2 grid-lg-3 anim-list">
                            @if(sizeof($videos) > 0)
                            @foreach($videos as $video)
                            <!-- an item -->

                            <div class="item media media-project">
                                <div class="media-img">
                                    <video width="350" height="350" controls>
                                    <source src="{{url('/storage'.$video->video)}}" type="video/mp4">
                                    </video>
                                </div>
                                <div class="media-body">
                                    <a href="{{url('/films/'.$video->id)}}">
                                        <h4>{{$video->title}}</h4>
                                        <h3>{{$video->subtitle}}</h3>
                                    </a>
                                </div>
                                <div class="media-footer">
                                    <a class="btn btn-transp-arrow btn-primary" href="{{url('/films/'.$video->id)}}">
                                        <span class="text">Details</span>
                                        <span class="icon arrow-right"></span>
                                    </a>
                                </div>
                            </div>

                            <!-- end item-->
                            @endforeach
                            @endif

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