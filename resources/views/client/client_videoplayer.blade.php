@extends('client.client_index')
@section('content')

<div class="index-container">

	<img id="ad-banner" class="responsive-img" src="{{ asset('/ads/Ads.jpg') }}">
	@if(!empty($video))
	<div class="video-container">
	<video controls poster>
		<source src="{{ asset('/videos/'.$video[0]->title.'.mp4') }}" type="video/mp4">
	</video>
	</div>
	@else
		<div class="center-align">
			<i style="font-size: 150px;" class="material-icons">personal_video</i>
			<h3 style="margin-top: -20px;">Sorry. Video not found.</h3>
		</div>
	@endif
</div>

@endsection