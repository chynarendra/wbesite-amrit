<!-- BEGIN OF page footer -->
<footer id="site-footer" class="page-footer">

  <!-- Right content -->
  <div class="footer-right">
    <p class="note">Website by
      <a href="http://highhay.com">
        <span class="marked">{{$headOfficeDetail->office_name}}</span>
      </a>
    </p>
    <ul class="social">
      @if($headOfficeDetail->office_fb!=null)
      <li>
        <a href="{{url($headOfficeDetail->office_fb)}}">
          <i class="icon fa fa-facebook"></i>
        </a>
      </li>
      @endif

      @if($headOfficeDetail->office_twitter!=null)
      <li>
        <a href="{{url($headOfficeDetail->office_twitter)}}">
          <i class="icon fa fa-twitter"></i>
        </a>
      </li>
      @endif

      @if($headOfficeDetail->office_insta!=null)
      <li>
        <a href="{{url($headOfficeDetail->office_insta)}}">
          <i class="icon fa fa-instagram"></i>
        </a>
      </li>
      @endif

      @if($headOfficeDetail->office_youtube!=null)
      <li>
        <a href="{{url($headOfficeDetail->office_youtube)}}">
          <i class="icon fa fa-youtube"></i>
        </a>
      </li>
      @endif
    </ul>
  </div>
</footer>
<!-- END OF site footer -->

<!-- scripts -->
<!-- All Javascript plugins goes here -->
<script src="{{url('frontend/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{url('frontend/js/slick/slick.min.js')}}"></script>

<!-- All vendor scripts -->
<script src="{{url('frontend/js/vendor/parallax.min.js')}}"></script>
<script src="{{url('frontend/js/vendor/scrolloverflow.min.js')}}"></script>
<script src="{{url('frontend/js/vendor/all.js')}}"></script>
<script src="{{url('frontend/js/particlejs/particles.min.js')}}"></script>

<!-- Countdown script -->
<!-- <script src="{{url('frontend/js/jquery.downCount.js')}}"></script> -->

<!-- Form script -->
<script src="{{url('frontend/js/form_script.js')}}"></script>

<!-- Javascript main files -->
<script src="{{url('frontend/js/main.js')}}"></script>

<script src="{{url('frontend/js/bootstrap.min.js')}}"></script>