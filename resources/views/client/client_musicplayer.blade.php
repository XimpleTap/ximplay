@extends('client.client_index')
@section('content')
<div class="marg-top"></div>
<div class="index-container">
	<img id="ad-banner" class="responsive-img" style="display:none">
	@if(!empty($music))
		<div class="row player" data-play-mode="{{ $playmode }}">
			<div class="audio-art col s4 m4 l4">
				@if(empty($music[0]->album_art_path))
            		<img src="{{ asset('images/defaultmusic.jpg') }}" class="">
            	@else
            		<img src="{{ asset($music[0]->album_art_path) }}" class="responsive-img">
            	@endif
			</div>
			<div class="audio col s8 m8 l8">
				<audio id="audio-player">
						<source src="{{ asset($music[0]->audio_path) }}" type="audio/mpeg">
					</audio>
				<div class="audio-info" data-music-attr="{{ json_encode($music[0]) }}">
					<p class="audio-title">{{ $music[0]->title }}</p>
					<p class="audio-artist">{{ $music[0]->artist }}</p>
				</div>
				<div class="audio-time">
					<div class="col s6 l6 m6">
					<p id="duration" class="left">{{ $music[0]->duration }}</p>
					</div>
					<div class="col s6 l6 m6">
					<p id="elapsed" class="right">-0:00</p>
					</div>
				</div>
				
				<div id="progressbar">
					<span id="progress"></span>
				</div>
				<div class="audio-controls">
					<div class="col s2 l2 m2">
						<a id="repeat">
							<p class='left'><i class="fa fa-repeat" aria-hidden="true"></i></p>
						</a>
					</div>
					<div class="col s2 l2 m2">
						<a id="prev" >
							<p class="right"><i class="fa fa-backward" aria-hidden="true"></i></p>
						</a>
					</div>
					<div class="col s4 l4 m4" style="display: none;">
						<a id="pause">
							<p class="center-align"><i class="fa fa-pause" aria-hidden="true"></i></p>
						</a>
					</div>
					<div class="col s4 l4 m4">
					<a id="play">
						<p class="center-align"><i class="fa fa-play" aria-hidden="true"></i></p>
					</a>
					</div>
					<div class="col s2 l2 m2">
						<a id="next">
							<p class="left"><i class="fa fa-forward" aria-hidden="true"></i></p>
						</a>	
					</div>
					<div class="col s2 l2 m2">
						<a id="shuffle" >
							<p class="right"><i class="fa fa-random" aria-hidden="true"></i></p>
						</a>	
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div id="search" class="col s12 m12 l12">
		        <label for="search-input"><h6><i class="fa fa-search" aria-hidden="true"></i><span class="sr-only">Search Music</span></h6></label>
		        <input onkeyup="musicSearch(event);" id="search-input" class="form-control input-lg" placeholder="Search Music" autocomplete="off" spellcheck="false" autocorrect="off" tabindex="1">
		        <ul class="search-ul collection">

	     		</ul>
	     	</div>
	     	
			<div class="col s12 m12 l12 tracklist-div">
				  @if($playmode==1 || $playmode==2)
				  	@if(!sizeof(Session::get('my_playlist'))==0)
				  	<ul class="tracklist collection"  data-playlist="{{ json_encode(Session::get('my_playlist')) }}">
					  	@foreach(Session::get('my_playlist') as $music)
						  	<li data-music-attr="{{ json_encode($music) }}" onclick="playThis(this)" class="tracklist-item collection-item avatar">
						      	@if(empty($music['album_art_path']))
				            		<img src="{{ asset('images/defaultmusic.jpg') }}" class="circle z-depth-5">
				            	@else
				            		<img src="{{ asset($music['album_art_path']) }}" class="circle z-depth-5">
				            	@endif
						      <p class="tracklist-title">{{ $music['title'] }}</p>
						      <p class="tracklist-artist">
						        {{ $music['artist'] }}
						      </p>
						      <div class="left">
						      <a href="#!" class="tracklist-duration"><i class="fa fa-clock-o"></i> {{ $music['duration'] }}</a>
						      </div>
						      <!-- <div class="right">
						      	<a class="add-to-playlist"><i class="fa fa-plus-circle"></i> Add to Playlist</a>
						      </div> -->
						    </li>
					  	@endforeach
					@endif
				  @elseif($playmode==3)
				  	@if(!sizeof(Session::get('index_music'))==0)
				  		<ul class="tracklist collection"  data-playlist="{{ json_encode(Session::get('index_music')[0]) }}">
					  	@foreach(Session::get('index_music')[0] as $music)
					  	
						  	<li data-music-attr="{{ json_encode($music) }}" onclick="playThis(this)" class="tracklist-item collection-item avatar">
						      	@if(empty($music->album_art_path))
				            		<img src="{{ asset('images/defaultmusic.jpg') }}" class="circle z-depth-5">
				            	@else
				            		<img src="{{ asset($music->album_art_path) }}" class="circle z-depth-5">
				            	@endif
						      <p class="tracklist-title">{{ $music->title }}</p>
						      <p class="tracklist-artist">
						        {{ $music->artist }}
						      </p>
						      <div class="left">
						      <a href="#!" class="tracklist-duration"><i class="fa fa-clock-o"></i> {{ $music->duration }}</a>
						      </div>
						      <div class="right">
						      	<a onclick="addToPlaylist(this);" data-music-attr="{{ json_encode($music) }}" class="add-to-playlist"><i class="fa fa-plus-circle"></i> Add to Playlist</a>
						      </div>
						    </li>
					  	@endforeach
					@endif
				  @endif

				  </ul>
			</div>
		</div>
	@else
		<div class="no-match-err center-align">
			<p><i class="fa fa-file-audio-o"></i></p>
			<p>Sorry. Music not found.</p>
		</div>
	@endif
	<div class="fixed-action-btn horizontal click-to-toggle">
	    <a class="btn-floating waves-effect waves-light blue">
	      <i class="fa fa-ellipsis-v"></i>
	    </a>
	    <ul class="nav-floaters">
	    	@if(sizeof(Session::get('my_playlist')[0])!=0)
	    		<li><a href="{{ url('/musicplayer?music_id='.Session::get('my_playlist')[0]['id'].'&play_mode=2') }}" class="play-playlist btn-floating waves-effect waves-light blue"><i class="fa fa-list"></i></a></li>
	    	@endif
	    	@if(sizeof($music_list)!=0)
		      <li><a href="{{ url('/musicplayer?music_id='.$music_list[0]->id.'&play_mode=3') }}" class="play-all btn-floating waves-effect waves-light blue"><i class="fa fa-play"></i></a></li>
		      @endif
	      <li style="display:none;" id="go-up">
	      <a onclick="topFunction()" class="btn-floating waves-effect waves-light blue">
              <i class="fa fa-caret-up"></i>
            </a>
	      </li>
	    </ul>
	</div>
</div>

@endsection

@section('js')

<script>
var audio = null;
var nowPlaying = null;
var playlist = null;
var playlistCounter = -1;
var repeatMode = 0; // 0 is for normal, 1 is for repeat, 2 is for shuffle
var shuffleMode = 0;
var playmode = 1;
var musiclist = null;
var toPLaylistOnly = false;
$(document).ready(function(){

	window.onscroll = function() {scrollFunction()};

	playmode = $('.player').data("play-mode");

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

            	$('#ad-banner').addClass('ad-promo-hits');

            	$('#ad-banner').css('display', 'block');
            	
                }
             else{

             	$('#ad-banner').attr('src', '../public/images/ximplay_banner.png');

             	$('#ad-banner').removeClass('ad-promo-hits');

             	$('#ad-banner').css('display', 'block');

             }
        }
    });

	initPlayer($('.audio-info').data('music-attr'));		
	playlist = $('.tracklist').data('playlist');
	
	if(typeof playlist !== "undefined" && playlist !== null){
		$('.tracklist-div').css({"display":"block"});
		$.map(playlist, function(element,index){

			if(element['title']===$('.audio-info').data('music-attr')['title']){
				$($('.tracklist li').get(index)).addClass('active');
				playlistCounter = index;
			}
		});
	}else{
		playlistCounter=-1;
	}


	$('#prev').click(function(){

		if(playlist != null && typeof playlist !== "undefined"){

			if(repeatMode==1 && shuffleMode==0){
				playlistCounter = playlistCounter;
			}else if(repeatMode==0 && shuffleMode==1){
				playlistCounter = Math.floor(Math.random() * playlist.length)
			}else if(repeatMode==1 && shuffleMode==1){
				playlistCounter = playlistCounter;
			}else{
				playlistCounter--;
			}
			
			if(playlistCounter==-1){
				playlistCounter=playlist.length-1;	
			}

			var musicData = playlist[playlistCounter];
			$($('.tracklist li').get(playlistCounter)).siblings().removeClass("active");
			$($('.tracklist li').get(playlistCounter)).addClass('active');
	    	$('source').attr('src',musicData['audio_path']);
	    	audio.pause();
	    	initPlayer(musicData);
			$('#play').hide();
			$('#pause').show();
	    	audio.play();
	    	showDuration();
			$('#play').hide();
			$('#play').parent('div').hide();
			$('#pause').show();
			$('#pause').parent('div').show();
			$('.tracklist-div').animate({ scrollTop: $('.tracklist li:nth-child('+(playlistCounter+1)+')').position().top - $('.tracklist li:first').position().top}, 1200);
			
		}
	});
	$('#play').click(function(){
		audio.play();

		$(this).hide();
		$(this).parent('div').hide();
		$('#pause').show();
		$('#pause').parent('div').show();
		showDuration();
	});
	$('#pause').click(function(){
		audio.pause();
		$(this).hide();
		$(this).parent('div').hide();
		$('#play').show();
		$('#play').parent('div').show();
	});
	$('#next').click(function(){

		if(playlist != null && typeof playlist !== "undefined"){

			if(repeatMode==1 && shuffleMode==0){
				playlistCounter = playlistCounter;
			}else if(repeatMode==0 && shuffleMode==1){
				playlistCounter = Math.floor(Math.random() * playlist.length)
			}else if(repeatMode==1 && shuffleMode==1){
				playlistCounter = playlistCounter;
			}else{
				playlistCounter++;
			}


			if(playlistCounter==playlist.length){
				playlistCounter=0;	
			}
			var musicData = playlist[playlistCounter];
			$($('.tracklist li').get(playlistCounter)).siblings().removeClass("active");
			$($('.tracklist li').get(playlistCounter)).addClass('active');
	    	$('source').attr('src',musicData['audio_path']);
	    	audio.pause();
	    	initPlayer(musicData);
	    	audio.play();
	    	showDuration();
			$('#play').hide();
			$('#play').parent('div').hide();
			$('#pause').show();
			$('#pause').parent('div').show();
			$('.tracklist-div').animate({ scrollTop: $('.tracklist li:nth-child('+(playlistCounter+1)+')').position().top - $('.tracklist li:first').position().top}, 1200);

		}
	});
	$('#repeat').click(function(){

		if(playlist != null && typeof playlist !== "undefined"){

			if(repeatMode==1){
				repeatMode = 0;
				$(this).css({"color":"black"});
				Materialize.toast("Repeat Mode : OFF", 500);
			}else{
				$(this).css({"color":"#00467F"});
				repeatMode = 1;
				Materialize.toast("Repeat Mode : ON", 500);
			}

		}else{
			
			Materialize.toast("Player is already in repeat mode.", 500);
		}
	});
	$('#shuffle').click(function(){

		if(playlist != null && typeof playlist !== "undefined"){

			if(shuffleMode==1){
				shuffleMode = 0;
				$(this).css({"color":"black"});
				Materialize.toast("Shuffle Mode : OFF", 500);
			}else{
				$(this).css({"color":"#00467F"});
				shuffleMode = 1;
				Materialize.toast("Shuffle Mode : ON", 500);
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
});

function initPlayer(musicObj){
	
	audio = new Audio('../public'+musicObj['audio_path']);

	$('.audio-title').text(musicObj['title']);
	$('.audio-artist').text(musicObj['artist']);
	$('.audio-art img').attr('src',musicObj['album_art_path']==null? "{{ asset('images/defaultmusic.jpg') }}" : '../public/'+musicObj['album_art_path']);
	$('#progress').css({"display":"block","width":"0%"});
	Materialize.toast(musicObj['title']+' now playing.', 800);
	audio.addEventListener("ended", function(){
		audio.currentTime = 0;  
		if(playlist !== null){
			if(repeatMode==1 && shuffleMode==0){
				playlistCounter = playlistCounter;
			}else if(repeatMode==0 && shuffleMode==1){
				playlistCounter = Math.floor(Math.random() * playlist.length);
			}else if(repeatMode==1 && shuffleMode==1){
				playlistCounter = playlistCounter;
			}else{
				playlistCounter++;
			}
			
			if(playlistCounter==playlist.length){
				playlistCounter=0;	
			}
			var musicData = playlist[playlistCounter];
			$($('.tracklist li').get(playlistCounter)).siblings().removeClass("active");
			$($('.tracklist li').get(playlistCounter)).addClass('active');
	    	$('source').attr('src',musicData['audio_path']);
	    	audio.pause();
	    	initPlayer(musicData);
	    	audio.play();
	    	showDuration();
			$('#play').hide();
			$('#play').parent('div').hide();
			$('#pause').show();
			$('#pause').parent('div').show();


		}else{
			audio.play();
		}
	});
}
function showDuration(){
	$(audio).bind('timeupdate',function(){
		
		var sec = parseInt(audio.currentTime % 60);
		var min = parseInt(audio.currentTime/60) % 60;
		var progressValue = 0;
		var diff = audio.duration - audio.currentTime;
		var diffsec = parseInt(diff % 60);
		var diffmin = parseInt(diff/60) % 60;
		
		if(sec.toString().length==1){
			sec = "0"+sec;
		}
		if(diffsec.toString().length==1){
			diffsec = "0"+diffsec;
		}
		if(audio.currentTime>0){
			progressValue = Math.floor((100/audio.duration) * audio.currentTime);
		}
		$('#progress').css({"width":progressValue+"%"});
		if(isNaN(diffmin)==true && isNaN(diffsec)==true){
			diffmin = "00";
			diffsec = "00";
		}
		$('.audio-time #duration').text(diffmin + ":" +diffsec);
		$('.audio-time #elapsed').text("-"+min + ":" +sec);
	});
}
function fetchAllMusic(){
	return $.ajax({

		url : "{{ url('getallmusic') }}",
		type : "GET"

	});
}
function createSearchResult(result){
}
function refreshPlaylist(data){

	var tracklistUl = $('.tracklist-div .tracklist');
	tracklistUl.empty();
	var i=0;

	for(i=0; i<data.length; i++){

		var imgString = data[i]['album_art_path'] === null ? "<img src='{{ asset('images/defaultmusic.jpg') }}' class='circle z-depth-5'>" : "<img src='../public"+data[i]['album_art_path']+"' class='circle z-depth-5'>";

		var liString = "<li onclick='playThis(this)' class='tracklist-item collection-item avatar'>"+
		imgString+
	   "<p class='tracklist-title'>"+data[i]['title']+"</p>"+
	   "<p class='tracklist-artist'>"+data[i]['artist']+"</p>"+
	   "<div class='left'>"+
	   "<a href='#!' class='tracklist-duration'><i class='fa fa-clock-o'></i>"+ data[i]['duration']+"</a></div>";
		tracklistUl.append(liString);
	}
}
function musicSearch(e){
	var val = $.trim(e.target.value);
	if(val!=""){
		var searchUl = $('.search-ul');
		$('.tracklist-div').css({"opacity":".5"});
		searchUl.empty();
    	$('.search-ul').css({"display":"block"});
    	searchUl.append('<li style="padding-left: 20px !important;" class="tracklist-item collection-item avatar"><div class="center-align progress">'+
		      '<div class="center-align indeterminate"></div></div><p>Looking for music...</p></li>');
    	$.ajax({
    		url : "{{ url('searchmusic') }}",
			headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        type: 'POST',
	        data : {
	        	search_keys : val
	        }, success:function(data){

				if(data.length!=0){
					searchUl.empty();
					var i=0;

					for(i=0; i<data.length; i++){

						var imgString = data[i]['album_art_path'] === null ? "<img src='{{ asset('images/defaultmusic.jpg') }}' class='circle z-depth-5'>" : "<img src='../public"+data[i]['album_art_path']+"' class='circle z-depth-5'>";

						var liString = "<li onclick='' class='search-item collection-item avatar'>"+
						imgString+
					   "<p class='tracklist-title'>"+data[i]['title']+"</p>"+
					   "<p class='tracklist-artist'>"+data[i]['artist']+"</p>"+
					   "<div class='left'>"+
					   "<a href='#!' class='tracklist-duration'><i class='fa fa-clock-o'></i>"+ data[i]['duration']+"</a></div>"+
					   "<div class='right'>"+
					   "<a style='cursor:pointer' onClick='' class='add-to-playlist'><i class='fa fa-plus-circle'></i> Add to Playlist</a></div></li>";
						searchUl.append(liString);
						
						$('.search-ul li').last().data("music-attr",data[i]);
						$('.search-ul li').last()[0].addEventListener('click',playSearchMusic,false);
						$('.search-ul li .add-to-playlist').last().data("music-attr",data[i]);
						$('.search-ul li .add-to-playlist').last()[0].addEventListener('click',addToPlaylistSafari,false);

					}
					
				}else{
					searchUl.empty();
					$('.search-ul').css({"display":"block"});
					searchUl.append("<li class='tracklist-item collection-item avatar'><p>No results found.</p></li>");

				}
	        }
    	});
    	
    	

	}else{
		$('.search-ul').css({"display":"none"});
		$('.search-ul').empty();
		$('.tracklist-div').css({"opacity":"1"});
	}
}
function addToPlaylistSafari(evt){

	var musicData = $(evt.target).data("music-attr");
	$.ajax({
		url : "{{ url('addtoplaylist') }}",
		headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data : {
        	music_data : musicData
        },success:function(data){
        	
        	if(playmode==1 || playmode==2){
        		playlist=data;
        		refreshPlaylist(data);	
        	}
        	$('.search-ul').css({"display":"none"});
			$('.search-ul').empty();
			$('.tracklist-div').css({"opacity":"1"});
			Materialize.toast(musicData['title']+' has been added to playlist.', 500);
			
			var musicID =data[0]['id'];
			var link = '../public/musicplayer?music_id='+musicID+'&play_mode=2")';
			$('.nav-floaters').children().find('.play-playlist').parent('li').remove();
        	$('.nav-floaters').prepend('<li><a href="'+link+'" class="play-playlist btn-floating waves-effect waves-light blue"><i class="fa fa-list"></i></a></li>');
        }
	});
}
function addToPlaylist(evt){
	toPLaylistOnly = true;
	var musicData = $(evt).data("music-attr");
	$.ajax({
		url : "{{ url('addtoplaylist') }}",
		headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data : {
        	music_data : musicData
        },success:function(data){
        	
        	if(playmode==1 || playmode==2){
        		playlist=data;
        		refreshPlaylist(data);	
        	}
        	var musicID =data[0]['id'];
			var link = '../public/musicplayer?music_id='+musicID+'&play_mode=2")';
			$('.nav-floaters').children().find('.play-playlist').parent('li').remove();
        	$('.nav-floaters').prepend('<li><a href="'+link+'" class="play-playlist btn-floating waves-effect waves-light blue"><i class="fa fa-list"></i></a></li>');
        	$('.search-ul').css({"display":"none"});
			$('.search-ul').empty();
			$('.tracklist-div').css({"opacity":"1"});
			Materialize.toast(musicData['title']+' has been added to playlist.', 500);
        }
	});
}
function playSearchMusic(evt){

	if($( event.target ).is( "li" )){
		var musicData = $(evt.target).data("music-attr");
		$('source').attr('src',musicData['audio_path']);
		$('.tracklist-div .tracklist li').each(function(){
			$(this).removeClass("active");
		});
		if(typeof playlist !== "undefined" && playlist !== null){
			$('.tracklist-div').css({"display":"block"});
			$.map(playlist, function(element,index){

				if(element['title']===musicData['title']){
					$($('.tracklist li').get(index)).addClass('active');
					playlistCounter = index;
					$('.tracklist-div').animate({ scrollTop: $('.tracklist li:nth-child('+(playlistCounter+1)+')').position().top - $('.tracklist li:first').position().top}, 1200);
				}
			});
		}else{
			playlistCounter=-1;
		}
		audio.pause();
		initPlayer(musicData);
		$('#play').hide();
		$('#play').parent('div').hide();
		$('#pause').show();
		$('#pause').parent('div').show();
		audio.play();
		showDuration();
		$('.search-ul').empty();
		$('.search-ul').css({"display":"none"});
		$('.tracklist-div').css({"opacity":"1"});
	}else{
		if(!$(event.target).hasClass("add-to-playlist")){
			var musicData = $(evt.target).parent('li').data("music-attr");
			$('source').attr('src',musicData['audio']);
			$('.tracklist-div .tracklist li').each(function(){
				$(this).removeClass("active");
			});
			if(typeof playlist !== "undefined" && playlist !== null){
				$('.tracklist-div').css({"display":"block"});
				$.map(playlist, function(element,index){

					if(element['title']===musicData['title']){
						$($('.tracklist li').get(index)).addClass('active');
						playlistCounter = index;
						$('.tracklist-div').animate({ scrollTop: $('.tracklist li:nth-child('+(playlistCounter+1)+')').position().top - $('.tracklist li:first').position().top}, 1200);
					}
				});
			}else{
				playlistCounter=-1;
			}
			audio.pause();
			initPlayer(musicData);
			$('#play').hide();
			$('#play').parent('div').hide();
			$('#pause').show();
			$('#pause').parent('div').show();
			audio.play();
			showDuration();
			$('.search-ul').empty();
			$('.search-ul').css({"display":"none"});
			$('.tracklist-div').css({"opacity":"1"});
		}
	}
}
function playThis(evt){
	
	if(!toPLaylistOnly==true){
		$('.tracklist li').siblings().removeClass("active");
		$(evt).addClass('active');
		playlistCounter = $(evt).index();

		var musicData = playlist[playlistCounter];
		$('source').attr('src',musicData['audio_path']);
		audio.pause();
		initPlayer(musicData);
		$('#play').hide();
		$('#play').parent('div').hide();
		$('#pause').show();
		$('#pause').parent('div').show();
		audio.play();
		showDuration();
	}
	toPLaylistOnly=false;
	
}
function scrollFunction() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        $('.nav-floaters #go-up').show();
    } else {
        $('.nav-floaters #go-up').hide();
    }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    $('html, body').animate({ scrollTop: 0}, 1200);
}
</script>

@endsection