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
                	@if(empty($video->poster_path))
                		<a href="{{ url('/watchvideo?video_id='.$video->id) }}"><img src="{{ asset('images/defaultmovie.png') }}" class="responsive-img"></a>
                	@else
                		<a href="{{ url('/watchvideo?video_id='.$video->id) }}"><img src="{{ asset(''.$video->poster_path) }}" class="responsive-img"></a>
                	@endif
                  	
                </div>
                <div class="card-content small white">
                  <a style="text-decoration: none;" href="{{ url('/watchvideo?video_id='.$video->id) }}"><h5 class="center-align">{{ $video->title }}</h5></a>
                  <a style="text-decoration: none; color: #b1b1b1;" href="#!" class="tracklist-duration"><h6 class="center-align"><i class="fa fa-clock-o"></i> {{ $video->duration }}</h6></a>
                </div>
              </div>
            </div>
        	
		@endforeach
			<center>{{ $videos->render() }}</center>
	@else
		<p class="center-align">No video on the list.</p>
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