$(document).ready(function(){
		$('.btncliente').click(function(e){
		e.preventDefault();

		$('#nombreclie').removeAttr('disabled');
		$('#telefonoclie').removeAttr('disabled');
		$('#direccionclie').removeAttr('disabled');

		$('#saves').slideDown();
	});
//buacar clente
$('#dniclie').keyup(function(e){
	e.preventDefault();
	var cl=$(this).val();
	var accion='clientes';

	$.ajax({
		url: 'ajax.php',
		type: "POST",
		async: true,
		data: {accion:accion, cliente:cl},

		success: function(response){
			if (response==0) {
				$('#idcliente').val('');
				$('#nombreclie').val('');
				$('#telefonoclie').val('');
				$('#direccionclie').val('');

				$('.btncliente').slideDown();
			}else{
				var data=$.parseJSON(response);
				$('#idcliente').val(data.idcliente);
				$('#nombreclie').val(data.nombre);
				$('#telefonoclie').val(data.telefono);
				$('#direccionclie').val(data.direccion);

				$('.btncliente').slideUp();

				$('#nombreclie').attr('disabled','disabled');
				$('#telefonoclie').attr('disabled','disabled');
				$('#direccionclie').attr('disabled','disabled');

				$('#saves').slideUp();
			}
		},
		error: function(error){

		}
	});
});

//guardas cliente desde ventas 

$('#formnewcliente').submit(function(e){
	e.preventDefault();
	$.ajax({
		url: 'ajax.php',
		type: "POST",
		async: true,
		data: $('#formnewcliente').serialize(),

		success: function(response){
			if (response!='error') {
				$('#idcliente').val(response);
				$('#nombreclie').attr('disabled', 'disabled');
				$('#telefonoclie').attr('disabled', 'disabled');
				$('#direccionclie').attr('disabled', 'disabled');
				
				$('.btncliente').slideUp();

				$('#saves').slideUp();
			}

		},
		error: function(error){

		}
	});

});

$('#codproduct').keyup(function(e){
	e.preventDefault();
	var producto=$(this).val();
	var accion='infproductos';

	if (producto!='') {
			$.ajax({
			url: 'ajax.php',
			type: "POST",
			async: true,
			data: {accion:accion, producto:producto},

			success: function(response){
				if (response!='error') {
					var info=JSON.parse(response);
					$('#descrip').html(info.descripcion);
					$('#exis').html(info.existencia);
					$('#cantproduct').val(1);
					$('#precio').html(info.precio);
					$('#preciototal').html(info.precio);

					$('#cantproduct').removeAttr('disabled');
					$('#addproduct').slideDown();					
				}else{
					$('#descrip').html('--');
					$('#exis').html('--');
					$('#cantproduct').val(0);
					$('#precio').html('00.00');
					$('#preciototal').html('00.00');

					$('#cantproduct').attr('disabled','disabled');
					$('#addproduct').slideUp();
				}

			},
			error: function(error){

			}
		});
	}
});

//total de producto
$('#cantproduct').keyup(function(e){
	e.preventDefault();
	var preciototal=$(this).val()*$('#precio').html();
	var existencia=parseInt($('#exis').html());
	$('#preciototal').html(preciototal);

	if ( ($(this).val()<1 || isNaN($(this).val())) || ($(this).val()>existencia)) {
		$('#addproduct').slideUp();
	}else{
		$('#addproduct').slideDown();
	}
});

//agregar pordunto a tem
$('#addproduct').click(function(e){
	e.preventDefault();
	if ($('#cantproduct').val()>0) {
		var codproducto=$('#codproduct').val();
		var cantidad=$('#cantproduct').val();
		var accion ='agregaProducto';

		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data:{accion:accion, producto:codproducto, cantidad:cantidad},

			success: function(response){
				if (response!='error') {
					var info=JSON.parse(response); 
					
					$('#detalventa').html(info.detalle);
					$('#detaltotal').html(info.totales)

					$('#codproduct').val('');
					$('#descrip').html('--');
					$('#exis').html('--');
					$('#cantproduct').val(0);
					$('#precio').html('00.00');
					$('#preciototal').html('00.00');

					$('#cantproduct').attr('disabled','disabled');
					$('#addproduct').slideUp();


				}else{
					console.log('no hay dato');

				}
			},
			error: function(error){

			}
		});
	}
});

});


function mostDetalle(id){
	var accion='mostDetalle';
	var user=id;

	$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data:{accion:accion, user:user},

			success: function(response){
				if (response!='error') {
					var info=JSON.parse(response); 
					
					$('#detalventa').html(info.detalle);
					$('#detaltotal').html(info.totales);

				}else{
					console.log('no hay dato');

				}

			},
			error: function(error){

			}
		});
}