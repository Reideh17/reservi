/*=============================================
SLIDE PLAN DE COMPENSACIÓN
=============================================*/

$('.slide-plan-compensacion').jdSlider({
	wrap: '.slide-inner',
    isAuto: true,
    isLoop: true

});

/*=============================================
TABLA UNINIVEL
=============================================*/

var enlace_afiliado = $("#enlace_afiliado").val();

// $.ajax({

// 	"url":"ajax/tabla-uninivel.ajax.php?enlace_afiliado="+enlace_afiliado,
// 	success: function(respuesta){
		
// 		console.log("respuesta", respuesta);

//     }

// })

$(".tablaUninivel").DataTable({
  "ajax":"ajax/tabla-uninivel.ajax.php?enlace_afiliado="+enlace_afiliado,
  "deferRender": true,
  "retrieve": true,
  "processing": true,
	"language": {

	 	"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

 	}

});

/*=============================================
Gráfico multinivel
=============================================*/

$("#tree_view").jOrgChart({
	chartElement: '#tree',
	dragAndDrop: false
})

$(".verGanancias").click(function(){

	$(".tablaGanancias").toggle();

})

/*=============================================
TABLA GANANCIAS RED BINARIA
=============================================*/

if($(".habilitarGananciasBinarias").attr("verGanancias") == "ok"){

	// Capturamos la cantidad de usuarios que están en cada lado

	var lineasDescendientesIzq = $(".node img.lineaDescendienteIzq").parents()[6];
	var lineasDescendientesDer = $(".node img.lineaDescendienteDer").parents()[6];

	var totalIzq = $(lineasDescendientesIzq).find("img.Izq").length + $(lineasDescendientesIzq).find("img.Der").length +$(lineasDescendientesIzq).length;

	var totalDer = $(lineasDescendientesDer).find("img.Izq").length + $(lineasDescendientesDer).find("img.Der").length +$(lineasDescendientesDer).length;

	//Separamos los referidos directos de los indirectos

	var patrocinador = $("#summary").attr("patrocinador");

	var directoIzq = $(lineasDescendientesIzq).find("img[patrocinador='"+patrocinador+"']").length;

	var directoDer = $(lineasDescendientesDer).find("img[patrocinador='"+patrocinador+"']").length;

	var derrameIzq = totalIzq - directoIzq; 
	var derrameDer = totalDer - directoDer;

	//Calculamos las comisiones y las mostramos en la tabla de ganancias

	var valorSuscripcion = $("#valorSuscripcion").val();

	var totalLadoIzq = valorSuscripcion*0.4*directoIzq + valorSuscripcion*0.1*derrameIzq;
	var totalLadoDer = valorSuscripcion*0.4*directoDer + valorSuscripcion*0.1*derrameDer;

	$(".directoIzq").html(directoIzq +" <small class='text-muted'>(x 4 puntos)</small>"); 
	$(".directoDer").html(directoDer +" <small class='text-muted'>(x 4 puntos)</small>"); 
	$(".derrameIzq").html(derrameIzq +" <small class='text-muted'>(x 1 punto)</small>"); 
	$(".derrameDer").html(derrameDer +" <small class='text-muted'>(x 1 punto)</small>");
	$(".totalLadoIzq").html(totalLadoIzq); 
	$(".totalLadoDer ").html(totalLadoDer);

	//Calcular la comisión definitva del presente periodo

	var periodoComision = null;

	if(Number(totalLadoIzq) <= Number(totalLadoDer)){

		periodoComision = totalLadoIzq;

	}else{

		periodoComision = totalLadoDer;
	
	}

	var totalVentas = (valorSuscripcion*totalIzq) + (valorSuscripcion*totalDer);

	localStorage.setItem("periodoComision", periodoComision);
	localStorage.setItem("totalVentas", totalVentas);

	/*=============================================
	ACTUALIZAR COMISIONES Y VENTAS EN LA BD
	=============================================*/

	var id_usuario = $("#id_usuario").val();

	var datos = new FormData();
	datos.append("periodoComision", periodoComision);
	datos.append("periodoVenta", totalVentas);
	datos.append("idUsuario", id_usuario);

	$.ajax({

		url:"ajax/red-binaria.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success:function(respuesta){
			
			// console.log("respuesta", respuesta);

		}

	})

}

/*=============================================
ACTUALIZAR ANALITICAS DE LA RED BINARIA
=============================================*/

if(localStorage.getItem("totalVentas") != null){

	$(".periodoComisionBinaria").html(localStorage.getItem("periodoComision")).number(true, 2, ",", ".");
	$(".periodoVentaBinaria").html(localStorage.getItem("totalVentas")).number(true, 2, ",", ".");
}

/*=============================================
OCULTAR FLECHAS DE DESCENDENCIA EN RED MATRIZ
=============================================*/

var lineasDescendientes = $(".node");
// console.log("lineasDescendientes", lineasDescendientes);

$(lineasDescendientes[1]).find("img.tree_down_icon").remove();
$(lineasDescendientes[6]).find("img.tree_down_icon").remove();
$(lineasDescendientes[11]).find("img.tree_down_icon").remove();
$(lineasDescendientes[16]).find("img.tree_down_icon").remove();

/*=============================================
COMISIONES MATRIZ 4X4
=============================================*/

if($(".habilitarGananciasMatriz").attr("verGanancias") == "ok"){

	var id_usuario = $("#id_usuario").val();

	var datos = new FormData();
	datos.append("idUsuario", id_usuario);

	$.ajax({

		url:"ajax/red-matriz.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			
			// console.log("respuesta", respuesta);

			$(".comisionNivel1").html(respuesta["comisionNivel1"]).number(true, 2, ",",".");
			$(".ventaNivel1").html(respuesta["ventaNivel1"]).number(true, 2, ",",".");

			$(".comisionNivel2").html(respuesta["comisionNivel2"]).number(true, 2, ",",".");
			$(".ventaNivel2").html(respuesta["ventaNivel2"]).number(true, 2, ",",".");

			$(".comisionNivel3").html(respuesta["comisionNivel3"]).number(true, 2, ",",".");
			$(".ventaNivel3").html(respuesta["ventaNivel3"]).number(true, 2, ",",".");

			$(".comisionNivel4").html(respuesta["comisionNivel4"]).number(true, 2, ",",".");
			$(".ventaNivel4").html(respuesta["ventaNivel4"]).number(true, 2, ",",".");

			$(".totalComisionMatriz").html(respuesta["totalComisionMatriz"]).number(true, 2, ",",".");
			$(".totalVentaMatriz").html(respuesta["totalVentaMatriz"]).number(true, 2, ",",".");

			$(".periodoComisionMatriz").html(respuesta["totalComisionMatriz"]).number(true, 2, ",",".");
			$(".periodoVentaMatriz").html(respuesta["totalVentaMatriz"]).number(true, 2, ",",".");

			var datosMatriz = new FormData();
			datosMatriz.append("periodoComision", respuesta["totalComisionMatriz"]);
			datosMatriz.append("periodoVenta", respuesta["totalVentaMatriz"]);
			datosMatriz.append("usuarioRed", id_usuario);

			$.ajax({

				url:"ajax/red-matriz.ajax.php",
				method: "POST",
				data: datosMatriz,
				cache: false,
				contentType: false,
				processData: false,
				success:function(respuesta){
					
					console.log("respuesta", respuesta);

				}

			})

		}

	})

}

/*=============================================
PRELOAD
=============================================*/

var incremento = 0;

$(".preloadRed").nitePreload({

	srcAttr: 'data-nite-src',
	onProgress: function(a) {

		incremento = Math.floor(a.percentage);

		if(incremento >= 90){

			$("#preload").delay(350).fadeOut("slow");
			$(".preloadRed").delay(350).show("slow");
			
		}

	}

})