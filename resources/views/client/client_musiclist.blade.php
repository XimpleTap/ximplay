@extends('client.client_index')
@section('content')
<div class="marg-top"></div>
<div class="index-container">
	<div class="musiclist">
	@if(!empty($music_list))	
		<div class="row">	
		@foreach($music_list as $music)
			<div class="col music-col s4 m4 l4" data-music-attr="{{ json_encode($music) }}">
                <div class="music-album-art" >
                	@if(empty($music->album_art_path))
                	<img src="{{ asset('images/defaultmusic.jpg') }}" class="responsive-img z-depth-3">
                	@else
                	<img src="{{ asset($music->album_art_path) }}" class="responsive-img z-depth-3">
                	@endif
                </div>
	            <div class="music-list-details">
	            	<p class="music-list-title">{{ $music->title }}</p>
	            	<p class="music-list-artist">{{ $music->artist }}</p>
	            	<a class="add-to-playlist"><i class="fa fa-plus-circle"></i> Add to Playlist</a>
	            </div>
            </div>    	
		@endforeach
		</div>
		
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

	@else
		<p class="center-align">No music on the list.</p>
	@endif
	</div>
</div>


@endsection

@section('js')

<script>

$(document).ready(function(){
	window.onscroll = function() {scrollFunction()};

	$('.add-to-playlist').click(function(){

		var musicData = $(this).parent('div').parent('div').data("music-attr");
		console.log(musicData);

		$.ajax({
			url : "{{ url('addtoplaylist') }}",
			headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        type: 'POST',
	        data : {
	        	music_data : musicData
	        }, success : function(data){
	        	var musicID =data[0]['id'];
				var link = '../public/musicplayer?music_id='+musicID+'&play_mode=2")';
	        	$('.nav-floaters').children().find('.play-playlist').parent('li').remove();
        		$('.nav-floaters').prepend('<li><a href="'+link+'" class="play-playlist btn-floating waves-effect waves-light blue"><i class="fa fa-list"></i></a></li>');
	        }
		});
		Materialize.toast(musicData['title']+' has been added to playlist.', 500);
		
	});

	$('.play-all').click(function(e){
		if($('.music-col').length==0){
			e.stopPropagation();
			alert("There are no music to play");
		}
	});
});
function scrollFunction() {
    if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
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