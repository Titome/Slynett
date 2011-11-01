jQuery(document).ready(function($){
    $('.goto').click(function(){
        $.scrollTo($(this).attr('href'), 'slow');

        return false;
    });
});
