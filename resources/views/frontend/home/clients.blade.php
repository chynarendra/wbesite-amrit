 <!-- Begin of list feature section -->
 <div class="section section-list-feature fp-auto-height-responsive " data-section="clients">
      <!-- section cover -->
      <div class="section-cover-full bg-img" data-image-src="{{asset('frontend/img/sections/services.png')}}">
      </div>

      <!-- Begin of section wrapper -->
      <div class="section-wrapper fullwidth with-margin">
        <!-- content -->
        <div class="section-content anim">
          <div class="row">
            <div class="col-12 col-lg-6 text-left">
              <!-- title and description -->
              <div class="title-desc">
                <h2 class="display-4 display-title anim-1">Clients</h2>
                <p class="anim-2">Our customers are at the heart of our organization.
                </p>
              </div>
            </div>
          </div>

          <!-- service list -->
          <div class="service-list grid-1 grid-md-2 grid-lg-4 anim-list decor">
            @if(sizeof($clients) > 0 )
            @foreach($clients as $client)
            <!-- an item -->
            <div class="item media">
              <div class="img">
                <img class="round-img" src="{{asset('/storage'.$client->logo)}}" />
              </div>
              <div class="media-body">
                <h4>{{$client->name}}</h4>
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
            <span class="txt">Projects</span>
          </a>
        </footer>
      </div>
      <!-- End of section wrapper -->
    </div>
    <!-- End of list feature section -->