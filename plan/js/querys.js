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
			console.log(response);
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

});