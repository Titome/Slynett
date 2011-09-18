jQuery(document).ready(function($){
    $('.slider .box_skitter').skitter({
        dots: true,
        animation: 'cube',
        interval: 4000,
        animateNumberOut: {
            backgroundColor:'#ddd', 
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