<!-- Begin of contact section -->
<div class="section section-contact fp-auto-height-responsive no-slide-arrows " data-section="contact">
  <!-- section cover -->
  <div class="section-cover-full bg-img" data-image-src="{{asset('frontend/img/sections/contact.png')}}">
  </div>

  <!-- Begin of slide section wrapper -->
  <div class="section-wrapper fullwidth  with-margin">
    <!-- main content -->
    <div class="row">
      <div class="col-12 col-md-12 col-lg-6">
        <!-- content -->
        <div class="section-content anim text-left">
          <!-- title and description -->
          <div class="title-desc">
            <div class="anim-2">
              <h2 class="display-4 display-title">Contact</h2>
              <p>For questions about our company and works please contact us.</p>
            </div>
            <div class="address-container anim-3">
              @include('backend.message.flash')
              <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                  <h4>Contact</h4>
                  <p>Call: {{$headOfficeDetail->office_phone}}</p>
                  <p>Email: {{$headOfficeDetail->office_email}}</p>

                  <div class="icons icons-margin">
                    @if($headOfficeDetail->office_fb !=null)
                    <a class="icon-btn" href="{{url($headOfficeDetail->office_fb)}}">
                      <i class="icon fa fa-facebook"></i>
                    </a>
                    @endif

                    @if($headOfficeDetail->office_insta !=null)
                    <a class="icon-btn" href="{{url($headOfficeDetail->office_insta)}}">
                      <i class="icon fa fa-instagram"></i>
                    </a>
                    @endif

                    @if($headOfficeDetail->office_twitter !=null)
                    <a class="icon-btn" href="{{url($headOfficeDetail->office_twitter)}}">
                      <i class="icon fa fa-twitter"></i>
                    </a>
                    @endif
                    @if($headOfficeDetail->office_youtube !=null)
                    <a class="icon-btn" href="{{url($headOfficeDetail->office_youtube)}}">
                      <i class="icon fa fa-youtube"></i>
                    </a>
                    @endif
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                  <h4>Address</h4>
                  <p>
                    {{$headOfficeDetail->office_address}}
                  </p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>


    <!-- aside content -->
    <div class="section-aside aside-bottom anim small-relative">
      <div class="message-form">
        <h4>Write message</h4>
        <div class="form-container form-container-card">
          <!-- Message form container -->
          {!! Form::open(['method'=>'post','url'=>'/user/message','enctype'=>"multipart/form-data"]) !!}
          <form class="send_message_form message form" id="message_form">
            <div class="form-group name">
              <input id="mes-name" name="name" type="text" placeholder="Name" class="form-control form-control-outline thick form-success-clean" required>
            </div>
            <div class="form-group email">
              <input id="mes-email" type="email" placeholder="Email" name="email" class="form-control form-control-outline thick form-success-clean" required>
            </div>
            <div class="form-group no-border">
              <textarea id="mes-text" placeholder="Message ..." name="message" class="form-control form-control-outline thick form-success-clean" required></textarea>

              <div>
                <p class="message-ok invisible form-text-feedback form-success-visible">Your message has been sent, thank you.</p>
              </div>
            </div>

            <div class="btns text-right">
              <button id="submit-message" class="btn btn-outline-white btn-round btn-fullNot email_b" name="submit_message">
                <span class="txt">Send Now</span>
                <span class="arrow-icon"></span>
              </button>
            </div>
          </form>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  <!-- End of slide section wrapper -->

</div>
<!-- End of contact section -->