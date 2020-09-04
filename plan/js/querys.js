/*$(document).ready(function(){
	$('.addp').click(function(e){
		e.preventDefault();
		var producto = $(this).attr('product');
		alert(producto);
		$('.modal').fadeInt();
		

	});
});
*/

function cerrarmodal(){
	$('.modal').fadeOut();
}

function abrir(){
	$('.addp').click(function(e){
	var producto = $(this).attr('product');
	var accion='infoProducto';
	$.ajax({
		url: 'ajax.php',
		type: 'POST',
		async: true,
		data: {accion:accion, producto:producto},

		success: function(response){
			if (response!='error') {
				var info= JSON.parse(response);
				$('#idproducto').val(info.codproducto);
				$('.nombreproducto').html(info.descripcion);
			}
		},
		error: function(error){
			console.log(error);
		}
	});
	document.getElementById("mod").style.display="block";

	});
}