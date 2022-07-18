<div class="pic-ctn">
  @if(sizeof($sliderPhotos) > 0)
  @foreach($sliderPhotos as $sliderPhoto)
  <img src="{{asset('/storage'.$sliderPhoto->photo)}}" alt="" class="pic">
  @endforeach
  @endif
</div>