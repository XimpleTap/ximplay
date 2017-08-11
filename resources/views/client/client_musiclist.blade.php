@extends('client.client_index')
@section('content')

<div class="index-container">
	<div class="musiclist">
	@if(!empty($music_list))	
		<div class="row">	
		@foreach($music_list as $music)
			<div class="col music-col s4 m4 l4" data-music-attr="{{ json_encode($music) }}">
                <div class="music-album-art" >
                	<img src="{{ asset('images/defaultmusic.jpg') }}" class="responsive-img z-depth-3">
                	
                </div>
	            <div class="music-list-details">
	            	<p class="music-list-title">{{ $music['music_title'] }}</p>
	            	<p class="music-list-artist">{{ $music['music_artist'] }}</p>
	            	<a class="add-to-playlist"><i class="fa fa-plus-circle"></i> Add to Playlist</a>
	            </div>
            </div>    	
		@endforeach
		</div>
	@else
		<p class="center-align">No music on the list.</p>
	@endif
	</div>
</div>


@endsection

@section('js')

<script>

$(document).ready(function(){

	$('.add-to-playlist').click(function(){

		var musicData = $(this).parent('div').parent('div').data("music-attr");
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
		Materialize.toast(musicData['music_title']+' has been added to playlist.', 500);
	});

	

	$('.music-col').each(function(){

		var imgData = $(this).data("music-attr").album_art==null?"{{ asset('images/defaultmusic.jpg') }}":$(this).data("music-attr").album_art;

		$(this).children().find('img').attr("src",imgData);

	});

});

</script>



@endsection