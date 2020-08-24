<?php 
date_default_timezone_set('America/Lima');
function fecha(){
$mes= array('','Enero',
	'Febrero',
	'Marzo',
	'Abril',
	'Mayo',
	'Junio',
	'Julio',
	'Agosto',
	'Setiembre',
	'Octubre',
	'Novienbre',
	'Diciembre');
return date('d') . ' de ' . $mes[date('n')] . ' de '. date('Y');
}
 ?>