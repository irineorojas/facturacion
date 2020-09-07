$(document).ready(function(){
	$('.addp').click(function(e){
		//e.preventDefault();
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
					$('#nombreproducto').html(info.descripcion);
				}
			},
			error: function(error){
				console.log(error);
			}
		});
		alert(producto);
		$('.modal').fadeInt();
		

	});
});




/*function abrir(){
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
				$('#nombreproducto').html(info.descripcion);
			}
		},
		error: function(error){
			console.log(error);
		}
	});
	document.getElementById("mod").style.display="block";

	});
}
*/
function sentDataProduct(){
	$.ajax({
		url: 'ajax.php',
		type: 'POST',
		async: true,
		data: $('#addproducto').serialize(),

		success: function(response){
			console.log(response);
		},
		error: function(error){
			console.log(error);
		}
	});
}

function cerrarmodal(){
	$('#cantidad').val('');
	$('#precio').val('');  
	$('.modal').fadeOut();
}