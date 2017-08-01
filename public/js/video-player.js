$(document).ready(function(){
	
	$('#to-movies').click(function(){
		window.location.href = "../public/";
	});

	$('#to-music').click(function(){
		window.location.href = "../public/music";
	});

	setInterval(function(){
		$('#ad-banner').toggleClass('animated pulse');
	},3000);

	
	$('.card-image').click(function(){

		var videoAttr = $(this).data("video-attr");
		window.location.href = "../public/watchvideo?video_id="+videoAttr['id'];
    });
});

