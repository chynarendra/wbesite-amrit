<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
  @if(sizeof($sliderPhotos) > 0)
    @foreach($sliderPhotos as $key=>$sliderPhoto)
    @if($key==0)
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    @else
    <li data-target="#demo" data-slide-to="{{$key}}"></li>
    @endif
    
    @endforeach
    @endif
  
  </ul>
  <div class="carousel-inner">
    @if(sizeof($sliderPhotos) > 0)
    @foreach($sliderPhotos as $key=>$sliderPhoto)
    <div class="carousel-item <?php echo $key==0?'active':''?>">
      <img src="{{asset('/storage'.$sliderPhoto->photo)}}" alt="Los Angeles" style="width:100%;">
      <!-- <div class="carousel-caption">
        <h3>{{$sliderPhoto->title}}</h3>
        <p>{{$sliderPhoto->subtitle}}</p>
      </div> -->
    </div>
    @endforeach
    @endif

  </div>

</div>