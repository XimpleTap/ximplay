$(document).ready(function(){
	
	// navigation
	$('#to-movies').click(function(){
		window.location.href = "../public/";
	});

	$('#to-music').click(function(){
		window.location.href = "../public/audios";
	});

	// pulse effect for the ad banner
	setInterval(function(){
		$('#ad-banner').toggleClass('animated pulse');
	},3000);

	
	// opening video to player
	$('.card-image').click(function(){
		var videoAttr = $(this).data("video-attr");
		window.location.href = "../public/watchvideo?video_id="+videoAttr['id'];
    });

});

