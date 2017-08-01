@extends('client.client_index')
@section('content')

<div class="container">

	@if(!empty($video))

	<video controls>
		<source src="{{ asset('/videos/'.$video[0]->title.'.mp4') }}" type="video/mp4">
	</video>
	@else
		<div class="center-align">
			<i style="font-size: 150px;" class="material-icons">personal_video</i>
			<h3 style="margin-top: -20px;">Sorry. Video not found.</h3>
		</div>
	@endif
</div>

@endsection