@extends('client.client_index')
@section('content')

<div class="index-container">

	<img id="ad-banner" class="responsive-img" src="{{ asset('/ads/Ads.jpg') }}">
	@if(!empty($music))
		<div class="row">
			<div class="col s4 m4 l4">
				@if(empty($music['album_art']))
            		<img src="{{ asset('images/defaultmusic.jpg') }}" class="responsive-img z-depth-5">
            	@else
            		<img src="{{ $music['album_art'] }}" class="responsive-img z-depth-5">
            	@endif
			</div>
			<div class="col s8 m8 l8">
				<div class="audio-info">
					<p class="audio-title">{{ $music['music_title'] }}</p>
					<p class="audio-artist">{{ $music['music_artist'] }}</p>
				</div>
				
				<div class="player-controls">
					<audio id="audio-player">
						<source src="{{ asset('audio/'.$music['filename']) }}" type="audio/mpeg">
					</audio>
					<img id="prev" src="{{ asset('images/player-previous.png') }}">
					<img id="play" src="{{ asset('images/player-play.png') }}">
					<img id="pause" src="{{ asset('images/player-pause.png') }}">
					<img id="next" src="{{ asset('images/player-next.png') }}">
					<div id="progressbar">
						<span id="progress"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12 m12 l12">
				<ul id="tracklist">
					<li>
						<div class="col s10">
							<p id="tracklist-title">TITLE</p>
							<p id="tracklist-artist">ARTIST</p>
						</div>
						<div id="tracklist-left" class="col s2">
							<p ><i class="fa fa-plus-circle"></i></p>
							<p id="tracklist-duration">TIME</p>
						</div>
					</li>
				</ul>
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

@section('js')

<script>


var audio = null;
var nowPlaying = null;

$(document).ready(function(){

	initPlayer();

	$('#prev').click(function(){
		
	});
	$('#play').click(function(){
		audio.play();
		$(this).hide();
		$('#pause').show();
		showDuration();
	});
	$('#pause').click(function(){
		audio.pause();
		$(this).hide();
		$('#play').show();
	});

	$('#next').click(function(){
		
	});

	/* Modern Seeking */

    var timeDrag = false; /* Drag status */
    $('#progressbar').mousedown(function (e) {
        timeDrag = true;
        updatebar(e.pageX);
    });
    $(document).mouseup(function (e) {
        if (timeDrag) {
            timeDrag = false;
            updatebar(e.pageX);
        }
    });
    $(document).mousemove(function (e) {
        if (timeDrag) {
            updatebar(e.pageX);
        }
    });

    //update Progress Bar control
    var updatebar = function (x) {

        var progress = $('#progress');
        var maxduration = audio.duration; //audio duration
        var position = progress.width(); //Click pos
        console.log(Math.floor((100 * audio.currentTime) / audio.duration));
        var percentage = 100 * position / progress.width();
        console.log(percentage);
        //Check within range
        if (percentage > 100) {
            percentage = 100;
        }
        if (percentage < 0) {
            percentage = 0;
        }

     
        $('#progress').css('width', percentage + '%');
        audio.currentTime = maxduration * percentage / 100;
    };

});


function initPlayer(){
	audio = $("#audio-player")[0];
	$('#progress').css({"display":"block","width":"0%"});
}

function showDuration(){
	$(audio).bind('timeupdate',function(){
		
		var sec = parseInt(audio.currentTime % 60);
		var min = parseInt(audio.currentTime/60) % 60;
		var progressValue = 0;
		if(audio.currentTime>0){
			progressValue = Math.floor((100/audio.duration) * audio.currentTime);
		}
		$('#progress').css({"width":progressValue+"%"});
	});
}

</script>

@endsection