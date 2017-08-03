@extends('client.client_index')
@section('content')

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
	            <div class="music-list-details">
	            	<p class="music-list-text">{{ $music['music_title'] }}</p>
	            	<p class="music-list-text">{{ $music['music_artist'] }}</p>
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