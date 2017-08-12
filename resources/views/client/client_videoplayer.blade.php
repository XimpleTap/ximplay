@extends('client.client_index')
@section('content')

<div class="index-container">

	<img id="ad-banner" class="ad-promo-hits responsive-img" style="display:none">
	@if(!empty($video))
	<div class="video-container">
	<video controls controlsList="nodownload" poster>
		<source src="{{ asset(''.$video[0]->video_path) }}" type="video/mp4">
	</video>
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
	//$('#loaderModal').modal('open');
		getUserIP(function(ip){
	    	var dateNow = new Date();
        
        	var _dateTimeNow = dateNow.getFullYear() + "-" + (dateNow.getMonth() + 1) + "-" + dateNow.getDate() + " " + 
            dateNow.getHours() + ":" + dateNow.getMinutes() + ":" + dateNow.getSeconds();

        	var _dateNow = dateNow.getFullYear() + "-" + (dateNow.getMonth() + 1) + "-" + dateNow.getDate();
        	        $.ajax({
			            url : "../public/adHits",
			            type: 'GET',
			            data: {
			                dateTimeNow     : _dateTimeNow,
			                dateNow 		: _dateNow,
			                ipAddress		: ip 
			            },
			            success: function (data) {

			            	$('#loaderModal').modal('close');

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
});

</script>
@endsection