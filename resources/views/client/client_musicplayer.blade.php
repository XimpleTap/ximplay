@extends('client.client_index')
@section('content')

<div class="index-container">
	<img id="ad-banner" class="responsive-img" src="{{ asset('/ads/Ads.jpg') }}">

	@if(!empty($music))
		<div class="row">
			<div class="col s4 m4 l4">
				<div class="audio-art">
				@if(empty($music['album_art']))
            		<img src="{{ asset('images/defaultmusic.jpg') }}" class=" z-depth-5">
            	@else
            		<img src="{{ $music['album_art'] }}" class="responsive-img z-depth-5">
            	@endif
            	</div>
			</div>
			<div class="col s8 m8 l8">
				<div class="audio-info" data-music-attr="{{ json_encode($music) }}">
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
			<section id="search">
	        <label for="search-input"><h6><i class="fa fa-search" aria-hidden="true"></i><span class="sr-only">Search Music</span></h6></label>
	        <input id="search-input" class="form-control input-lg" placeholder="Search Music" autocomplete="off" spellcheck="false" autocorrect="off" tabindex="1">
	        <a id="search-clear" href="#" class="fa fa-times-circle hide" aria-hidden="true"><span class="sr-only">Clear search</span></a>
	     	</section>
			<div class="col s12 m12 l12 tracklist-div">
				  <ul class="tracklist collection" data-playlist="{{ json_encode(Session::get('my_playlist')) }}">
				  	<li id="search-li">
				  		
			          	
  
				  	</li>
				  @if(!empty($music) && sizeof(Session::get('my_playlist'))==0)

				  	<!-- <li class="collection-item avatar">
				      	@if(empty($music['album_art']))
		            		<img src="{{ asset('images/defaultmusic.jpg') }}" class="circle z-depth-5">
		            	@else
		            		<img src="{{ $music['album_art'] }}" class="circle z-depth-5">
		            	@endif
				      <p class="tracklist-title">{{ $music['music_title'] }}</p>
				      <p class="tracklist-artist">
				        {{ $music['music_artist'] }}
				      </p>
				      <div class="left">
				      	<a href="#!" class="tracklist-duration"><i class="fa fa-clock-o"></i> {{ $music['music_duration'] }}</a>
				      </div>
				      <div class="right">
				      	<a class="add-to-playlist"><i class="fa fa-plus-circle"></i> Add to Playlist</a>
				      </div>
				    </li> -->

				  @else


				  	@foreach(Session::get('my_playlist') as $music)
					  	<li data-music-attr="{{ json_encode($music) }}" class="tracklist-item collection-item avatar">
					      	@if(empty($music['album_art']))
			            		<img src="{{ asset('images/defaultmusic.jpg') }}" class="circle z-depth-5">
			            	@else
			            		<img src="{{ $music['album_art'] }}" class="circle z-depth-5">
			            	@endif
					      <p class="tracklist-title">{{ $music['music_title'] }}</p>
					      <p class="tracklist-artist">
					        {{ $music['music_artist'] }}
					      </p>
					      <div class="left">
					      <a href="#!" class="tracklist-duration"><i class="fa fa-clock-o"></i> {{ $music['music_duration'] }}</a>
					      </div>
					      <div class="right">
					      	<a class="add-to-playlist"><i class="fa fa-plus-circle"></i> Add to Playlist</a>
					      </div>
					    </li>

				  	@endforeach
				  	
				  </ul>

				  @endif
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
var playlist = null;
var playlistCounter = -1;
$(document).ready(function(){

	initPlayer($('.audio-info').data('music-attr'));		
	playlist = $('.tracklist').data('playlist');

	if(typeof playlist !== "undefined" && playlist !== null){
		$.map(playlist, function(element,index){

			if(element['music_title']===$('.audio-info').data('music-attr')['music_title']){
				$($('.tracklist li').get(index+1)).addClass('active');
				playlistCounter = index;
			}
		});
	}else{
		playlistCounter=-1;
	}

	$('#prev').click(function(){

		if(playlist.length>0){
			playlistCounter--;
			if(playlistCounter==-1){
				playlistCounter=playlist.length-1;
				var musicData = playlist[playlistCounter];
				
				console.log(musicData);
				$($('.tracklist li').get(playlistCounter+1)).siblings().removeClass("active");
				$($('.tracklist li').get(playlistCounter+1)).addClass('active');
		    	$('source').attr('src',musicData['filename']);
		    	audio.pause();
		    	initPlayer(musicData);
				$('#play').hide();
				$('#pause').show();
		    	audio.play();
		    	showDuration();
			}else{
				
				
				var musicData = playlist[playlistCounter];
				
				console.log(musicData);
				$($('.tracklist li').get(playlistCounter+1)).siblings().removeClass("active");
				$($('.tracklist li').get(playlistCounter+1)).addClass('active');
		    	$('source').attr('src',musicData['filename']);
		    	audio.pause();
		    	initPlayer(musicData);
				$('#play').hide();
				$('#pause').show();
		    	audio.play();
		    	showDuration();
			}

			
		}
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
		
		if(playlist.length>0){
			playlistCounter++;
			console.log(playlistCounter);
			if(playlistCounter==playlist.length){
				playlistCounter=0;
				var musicData = playlist[playlistCounter];
				console.log(musicData);
				$($('.tracklist li').get(playlistCounter+1)).siblings().removeClass("active");
				$($('.tracklist li').get(playlistCounter+1)).addClass('active');
		    	$('source').attr('src',musicData['filename']);
		    	audio.pause();
		    	initPlayer(musicData);
				$('#play').hide();
				$('#pause').show();
		    	audio.play();
		    	showDuration();
			}else{
				
				var musicData = playlist[playlistCounter];
				console.log(musicData);
				$($('.tracklist li').get(playlistCounter+1)).siblings().removeClass("active");
				$($('.tracklist li').get(playlistCounter+1)).addClass('active');
		    	$('source').attr('src',musicData['filename']);
		    	audio.pause();
		    	initPlayer(musicData);
				$('#play').hide();
				$('#pause').show();
		    	audio.play();
		    	showDuration();
			}
		}
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
    	var progress = $('#progressbar');
	    var maxduration = audio.duration; //Video duraiton
	    var position = x - progress.offset().left; //Click pos
	    var percentage = 100 * position / progress.width();
	 
	    //Check within range
	    if(percentage > 100) {
	        percentage = 100;
	    }
	    if(percentage < 0) {
	        percentage = 0;
	    }
	    
	    $('#progress').css('width', percentage + '%');
        audio.currentTime = maxduration * percentage / 100;
 
    };

    $('.tracklist-item').click(function(){
    	$('.tracklist li').siblings().removeClass("active");
		$(this).addClass('active');
		playlistCounter = $(this).index()-1;
		var musicData = playlist[playlistCounter];
    	$('source').attr('src',musicData['filename']);
    	audio.pause();
    	initPlayer(musicData);
		$('#play').hide();
		$('#pause').show();
    	audio.play();
    	showDuration();
    });

});


function initPlayer(musicObj){
	
	audio = new Audio('audio/'+musicObj['filename']);
	$('.audio-title').text(musicObj['music_title']);
	$('.audio-artist').text(musicObj['music_artist']);
	$('.audio-art img').attr('src',musicObj['album_art']==null? "{{ asset('images/defaultmusic.jpg') }}" : musicObj['album_art']);
	$('#progress').css({"display":"block","width":"0%"});

	audio.addEventListener("ended", function(){
		audio.currentTime = 0;  
		if(playlist != null){
			playlistCounter++;
			
			if(playlistCounter==playlist.length){
				playlistCounter=0;
				console.log(playlistCounter);
				var musicData = playlist[playlistCounter];
				console.log(musicData);
				$($('.tracklist li').get(playlistCounter+1)).siblings().removeClass("active");
				$($('.tracklist li').get(playlistCounter+1)).addClass('active');
		    	$('source').attr('src',musicData['filename']);
		    	audio.pause();
		    	initPlayer(musicData);
				$('#play').hide();
				$('#pause').show();
		    	audio.play();
		    	showDuration();
			}else{
				
				var musicData = playlist[playlistCounter];
				console.log(musicData);
				$($('.tracklist li').get(playlistCounter+1)).siblings().removeClass("active");
				$($('.tracklist li').get(playlistCounter+1)).addClass('active');
		    	$('source').attr('src',musicData['filename']);
		    	audio.pause();
		    	initPlayer(musicData);
				$('#play').hide();
				$('#pause').show();
		    	audio.play();
		    	showDuration();
			}
		}  
	});
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