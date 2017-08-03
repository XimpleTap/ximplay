@extends('client.client_index')
@section('content')

<div class="index-container">

	<img id="ad-banner" class="responsive-img" src="{{ asset('/ads/Ads.jpg') }}">
	@if(!empty($music))
		<div class="row">
			<div class="col s4 m4 l4">
				@if(empty($music['album_art']))
            		<img src="{{ asset('images/defaultmusic.jpg') }}" class="responsive-img">
            	@else
            		<img src="{{ $music['album_art'] }}" class="responsive-img">
            	@endif
			</div>
			<div class="col s8 m8 l8">
				<div class="audio-info">
					<p class="audio-title">{{ $music['music_title'] }}</p>
					<p class="audio-artist">{{ $music['music_artist'] }}</p>
				</div>
				<div class="audio-tracker">
					<p id="elapsed-time" class="left">TIME1</p>
					<p id="duration" class="right">{{ $music['music_duration'] }}</p>
					<div id="progressbar">
						<span id="progress"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="audio-controls center-align">
			<button class="btn waves-effect waves-light blue darken-4"><i class="center-align fa fa-repeat"></i></button>
			<button class="btn waves-effect waves-light blue darken-4"><i class="center-align fa fa-play"></i></button>
			<button class="btn waves-effect waves-light blue darken-4"><i class="center-align fa fa-stop"></i></button>
			<button class="btn waves-effect waves-light blue darken-4"><i class="center-align fa fa-random"></i></button>
		</div>
		<div class="row">
			<div class="col s12 m12 l12">
				<p>MUSIC LIST</p>
			</div>
		</div>
	@else
		<div class="center-align">
			<i style="font-size: 150px;" class="material-icons">library_music</i>
			<br><br>
			<h3 style="margin-top: -20px;">Sorry. Music not found.</h3>
		</div>
	@endif

</div>


@endsection