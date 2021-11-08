/*=============================================
MOSTRAR - OCULTAR BOTONES DE VIDEOS
=============================================*/

var toggle = false;

$(".videos .visorVideos .fa-bars").click(function(){

	if(!toggle){

		toggle = true;	
	
	}else{

		toggle = false;	
	
	}

	ocultarBotones(toggle);

})

function ocultarBotones(toggle){

	if(!toggle){

		$(".videos .visorVideos h5").toggle("fast");
		$(".videos .botonesVideos").toggle("fast");	

		if(window.matchMedia("(max-width:768px)").matches){

			$(".videos .visorVideos").css({"width":"70%"});

		}else{

			$(".videos .visorVideos").css({"width":"75%"});

		}


	}else{

		$(".videos .visorVideos h5").toggle("fast");
		$(".videos .botonesVideos").toggle("fast");	
		$(".videos .visorVideos").css({"width":"100%"});

	}

}

/*=============================================
REPRODUCIR SIGUIENTE VIDEO AUTOMÁTICAMENTE
=============================================*/	

var rutaCategoria = $(".videos video").attr("rutaCategoria");
var nextVideo = $(".videos video").attr("nextVideo");

setInterval(function(){

	if($(".videos video")[0].ended){

		window.location = "index.php?pagina="+rutaCategoria+"&video="+nextVideo;

	}

},1000)

/*=============================================
MANIPULAR LA VELOCIDAD DEL VIDEO
=============================================*/

var video = document.getElementById("myVideo");

$(".velocidadVideo a").click(function(e){

	e.preventDefault();

	video.playbackRate =  $(this).attr("velocidad");
	
	$(".velocidadVideo a").removeClass("active");
	$(this).addClass("active");

})


/*=============================================
REPRODUCCIÓN HLS
=============================================*/

var videoSrcHls = $(".visorVideos").attr("rutaVideo");
// console.log("videoSrcHls", videoSrcHls);

if(Hls.isSupported()) {
  var hls = new Hls();
  hls.loadSource(videoSrcHls);
  hls.attachMedia(video);
  hls.on(Hls.Events.MANIFEST_PARSED,function() {
    video[0].play();
  });
}

/*=============================================
SOMBREAR ITEM VIDEO
=============================================*/

var numeroClase = $(".visorVideos").attr("numeroClase");
console.log("numeroClase", numeroClase);

$(".botonesVideos ul li[numeroClase='"+numeroClase+"']").css({"background":"#ddd", "color":"#000"});
