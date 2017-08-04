@extends('client.client_index')
@section('content')

<br>
<div class="index-container">
	<div class="musiclist">
	@if(!empty($music_list))	
		<div class="row">	
		@foreach($music_list as $music)
			<div class="col music-col s4 m4 l4">
                <div class="music-album-art" data-music-attr="{{ json_encode($music) }}">
                	@if(empty($music['album_art']))
                		<img src="{{ asset('images/defaultmusic.jpg') }}" class="responsive-img">
                	@else
                		<img src="{{ $music['album_art'] }}" class="responsive-img">
                	@endif
                </div>
	            <div class="music-list-details" data-music-attr="{{ json_encode($music) }}">
	            	<p class="music-list-title">{{ $music['music_title'] }}</p>
	            	<p class="music-list-artist">{{ $music['music_artist'] }}</p>
	            	<a class="add-to-playlist"><i class="fa fa-plus-circle"></i> Add to Playlist</a>
	            </div>
            </div>    	
		@endforeach
		</div>
	@else
		<p>WALA</p>
	@endif
	</div>
</div>


@endsection

@section('js')

<script>

$(document).ready(function(){

	$('.add-to-playlist').click(function(){

		var musicData = $(this).parent('div').closest('div').data("music-attr");
		console.log(musicData);

		$.ajax({
			url : "{{ url('addtoplaylist') }}",
			headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        type: 'POST',
	        data : {
	        	music_data : musicData
	        }
		});
		Materialize.toast(musicData['music_title']+' has been added to playlist.', 4000)

	});

});

</script>



@endsection