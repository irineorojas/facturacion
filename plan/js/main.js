$(document).ready(function(){
	$('#button-menu').click(function(){
		if($('#button-menu').attr('class') == 'fa fa-bars' ){
			$('.navegacion').css({'width':'100%', 'background':'rgba(0,0,0,.5)'});
			$('#button-menu').removeClass('fa fa-bars').addClass('fa fa-close'); 
			$('.navegacion .menu').css({'left':'0px'}); 
		} else{
			$('.navegacion').css({'width':'0%', 'background':'rgba(0,0,0,.0)'});
			$('#button-menu').removeClass('fa fa-close').addClass('fa fa-bars'); 
			$('.navegacion .submenu').css({'left':'-320px'});
			$('.navegacion .menu').css({'left':'-320px'});
		}
	});
	$('.navegacion .menu > .item-submenu a').click(function(){
		var positionMenu = $(this).parent().attr('menu'); 
		console.log(positionMenu); 
		$('.item-submenu[menu='+positionMenu+'] .submenu').css({'left':'0px'});
	});
	$('.navegacion .submenu li.go-back').click(function(){
		$(this).parent().css({'left':'-320px'}); 
	});

});