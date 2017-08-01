$(document).ready(function(){
	
	$('#to-movies').click(function(){
		window.location.href = "../public/videolist";
	});

	$('.card-image-holder').click(function(){

		var videoAttr = $(this).data("video-attr");
		window.location.href = "../public/watchvideo?video_id="+videoAttr['id'];
    });
});

