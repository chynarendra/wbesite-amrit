<!-- Begin of list projects section -->
<div class="section section-list-feature fp-auto-height-responsive " data-section="photos">

  <!-- Begin of section wrapper -->
  <div class="section-wrapper fullwidth with-margin">
    <!-- content -->
    <div class="section-content anim">
      <div class="row">
        <div class="col-12 col-lg-6 text-left">
          <!-- title and description -->
          <div class="title-desc">
            <h2 class="display-4 display-title anim-1">Photos</h2>
            <p class="anim-2">Don’t photograph what you see, photograph how you feel about what you see
            </p>
          </div>
        </div>
      </div>

      <!-- project list -->
      <div class="project-list grid-1 grid-md-2 grid-lg-3 anim-list">

        @if(sizeof($latestPhotos) > 0)
        @foreach($latestPhotos as $photo)
        <!-- an item -->
        <div class="item media media-project">
          <div class="media-img">
            <img class="" src="{{asset('/storage'.$photo->photo)}}" alt="An image">
          </div>
          <div class="media-body">
            <a href="{{url('/photos/'.$photo->id)}}">
              <h4>{{$photo->title}}</h4>
              <h3>{{$photo->subtitle}}</h3>
            </a>
          </div>
          <div class="media-footer">
            <a class="btn btn-transp-arrow btn-primary" href="{{url('/photos/'.$photo->id)}}">
              <span class="text">Details</span>
              <span class="icon arrow-right"></span>
            </a>
          </div>
        </div>
        @endforeach
        @endif

      </div>

    </div>

    <!-- Arrows scroll down/up -->
    <footer class="section-footer scrolldown">
      <a class="down">
        <span class="icon"></span>
        <span class="txt">Services</span>
      </a>
    </footer>
  </div>
  <!-- End of section wrapper -->
</div>
<!-- End of list projects section -->