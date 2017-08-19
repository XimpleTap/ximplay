
var objectUrl;
var musicUploads = null;
$(document).ready(function(){
	musicUploads = $('.music-uploads');
});

function detectFileChange(e){

	var musicFile = $(e).val();
	console.log(musicFile);
    
  musicUploads.empty();
	var audio = document.getElementById("audio");
  console.log(e.files);
	for(var i=0; i<e.files.length; i++){
		var tmppath = URL.createObjectURL(e.files[i]);
		$("#audio").prop("src", tmppath);
		loadFromFile(e.files[i]);
	}
}

function readURL(input) {
    console.log(input);
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
           $(input).parent('div').closest('.music-upload').find('img').attr('src', e.target.result);
           $(input).parent('div').closest('.music-upload').find('.music-album-art').val(e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function loadUrl(url, callback, reader) {
    var startDate = new Date().getTime();
    ID3.loadTags(url, function() {
        var endDate = new Date().getTime();
        if (typeof console !== "undefined") console.log("Time: " + ((endDate-startDate)/1000)+"s");
        var tags = ID3.getAllTags(url);
        var filename = url.substr(0,url.lastIndexOf('.'));
        console.log(url);
        musicUploads.append('<div class="row music-upload">'+
            '<div class="input-field col s3">'+
              '<img src="" width="100" height="100">'+
              '<input class="music-album-art" type="hidden" name="music-album-art[]">'+
              '<input class="music-file" type="hidden" name="music-file[]">'+
              '<label for="first_name" class="active">Album Art</label>'+
              '<br><div class="file-field input-field">'+
              '<div class="btn">'+
                '<span>File</span>'+
                '<input onchange="readURL(this)" type="file">'+
              '</div>'+
              '<div class="file-path-wrapper">'+
                '<input class="file-path validate" type="text" placeholder="Upload one or more files">'+
              '</div>'+
            '</div>'+
            '</div>'+
            '<div class="input-field col s3">'+
              '<input type="text" name="music-filename[]" class="music-filename validate">'+
              '<label for="first_name" class="active">Filename</label>'+
            '</div>'+
            '<div class="input-field col s3">'+
              '<input type="text" name="music-title[]" class="music-title validate">'+
              '<label for="last_name" class="active">Music Title</label>'+
            '</div>'+
            '<div class="input-field col s3">'+
              '<input type="text" name="music-artist[]" class="music-artist validate">'+
              '<label for="last_name" class="active">Music Artist</label>'+
            '</div>'+
          '</div>');

        
        if( "picture" in tags ) {
            var image = tags.picture;
            var base64String = "";
            for (var i = 0; i < image.data.length; i++) {
                base64String += String.fromCharCode(image.data[i]);
            }
            
            $(".music-uploads img").last().attr("src","data:" + image.format + ";base64," + window.btoa(base64String));
            $(".music-uploads .music-album-art").last().val("data:" + image.format + ";base64," + window.btoa(base64String));
            $('.music-uploads .change-album-art').last().hide();
	    } else {
    	    $(".music-uploads img").last().attr("src","../images/defaultmusic.jpg");
            $(".music-uploads .music-album-art").last().val("");
            $('.music-uploads .change-album-art').last().show();
    	}

        $(".music-uploads .music-filename").last().val(tags.title == undefined || tags.title == null ? filename : tags.title);
        $(".music-uploads .music-title").last().val(tags.title == undefined || tags.title == null ? "" : tags.title);
        $(".music-uploads .music-artist").last().val(tags.artist == undefined || tags.artist == null ? "" : tags.artist);
        $('.music-uploads .music-file').last().val(url);

	if( callback ) 
    { 
        callback(); 
    };
    },
    {tags: ["artist", "title", "album", "year", "comment", "track", "genre", "lyrics", "picture"],
     dataReader: reader});
}

function loadFromLink(link) {
    var loading = link.parentNode.getElementsByTagName("img")[0];
    var url = link.href;

    loading.style.display = "inline";
    loadUrl(url, function() {
        loading.style.display = "none";
    });
}

function loadFromFile(file) {
    var url = file.urn ||file.name;
    loadUrl(url, null, FileAPIReader(file));
}

function load(elem) {
    if (elem.id === "file") {
       
    } else {
        loadFromLink(elem);
    }
}
