jQuery(document).ready(function($){
    $('.slider').css({
        'margin-bottom':'50px'
    });
    
    $('.slider .box_skitter').skitter({
        animation: 'cube',
        interval: 4000,
        animateNumberOut: {
            backgroundColor:'#555', 
            color:'#fff'
        }, 
        animateNumberOver: {
            backgroundColor:'#333', 
            color:'#fff'
        }, 
        animateNumberActive: {
            backgroundColor:'#bf3604', 
            color:'#fff'
        }
    });		
});