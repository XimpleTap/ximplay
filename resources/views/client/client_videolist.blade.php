@extends('client.client_index')
@section('content')

<br>
<div class="index-container">
	<div class="videolist">
	@if(!empty($videos))			
		@foreach($videos as $video)
			<div class="col s6 m6 l4">
              <div class="card small hoverable">
                <div class="card-image video-card" data-video-attr="{{ json_encode($video) }}">
                  	<img src="{{ asset(''.$video->poster_path) }}" class="responsive-img">
                </div>
                <div class="card-content small white">
                  <h5 class="center-align">{{ $video->title }}</h5>
                </div>
              </div>
            </div>
        	
		@endforeach
			<center>{{ $videos->render() }}</center>
	@else
		<p>WALA</p>
	@endif
	</div>
</div>

@endsection
@section('js')
<script>

$(document).ready(function(){
	$('.card-image-holder').click(function(){

		var videoAttr = $(this).data("video-attr");
    	$.ajax({
    		url : "../public/watchvideo",
	        type: 'GET',
	        data: {
	        	video_id : videoAttr['id']
	        }
    	});
    })
});



</script>

@endsection