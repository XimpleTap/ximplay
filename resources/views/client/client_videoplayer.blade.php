@extends('client.client_index')
@section('content')

<div class="index-container">

	<img id="ad-banner" class="ad-promo-hits responsive-img" style="display:none">
	@if(!empty($video))
	<div class="video-container">
		<div class="video-bg">
			<video controls controlsList="nodownload" poster>
				<source src="{{ asset(''.$video[0]->video_path) }}" type="video/mp4">
			</video>
		</div>
	</div>
	@else
		<div class="no-match-err center-align">
			<p><i class="fa fa-file-video-o"></i></p>
			<p>Sorry. Video not found.</p>
		</div>
	@endif
</div>

@endsection

@section('js')

<script>
$(document).ready(function(){
	
	var dateNow = new Date();

	var _dateTimeNow = dateNow.getFullYear() + "-" + (dateNow.getMonth() + 1) + "-" + dateNow.getDate() + " " + 
    dateNow.getHours() + ":" + dateNow.getMinutes() + ":" + dateNow.getSeconds();

    $.ajax({
        url : "../public/adHits",
        type: 'GET',
        data: {
            connectionDateTime     : _dateTimeNow
        },
        success: function (data) {
			if(data != ''){
                var image_path = data[0]['image_path'];

                	$('#ad-banner').attr('src', '../public'+image_path);

                	$('#ad-banner').css('display', 'block');
                }
             else{

             	$('#ad-banner').css('display', 'none');

             }
        }
    });
	
});

</script>
@endsection