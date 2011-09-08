jQuery(document).ready(function($){

});

var menuYloc = -200;

$(window).scroll(function () { 
	offset = menuYloc+$(document).scrollTop();
	if(offset<0){offset=0;}
	$('.p_sidebar').animate({top:offset+"px"},{duration:500,queue:false});
});