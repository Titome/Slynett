jQuery(function($){
    $('div.tabs').tabs();
    $('select, input:checkbox, input:radio, input:file').uniform();
    
    /* --- Main Search ----------------- */
    
    $('#search input:text').focus(function(){
        /* searchFilters($(this), true); */
    }).keypress(function(e) {
        if (e.keyCode == 27) {
            searchFilters($(this), false);
        }
        else
        {
            searchFilters($(this), true);
        }
    });
        
    $('#search span.closefilters').click(function(){
        searchFilters($(this), false);
        
        return false;
    });
});

/* --- Main Search ----------------- */

function searchFilters(obj, sfActive)
{
    if (sfActive == true)
    {
        $('#search').addClass('active');
        
        var filtersDiv = obj.parents('div').nextAll('div.filters');
        filtersDiv.slideDown();
    }
    else
    {
        $('#search').removeClass('active');
        
        var filtersDiv = obj.parents('div').nextAll('div.filters');
        filtersDiv.slideUp();
    }
}

/* --- TopMenu Scroll ----------------- */

var menuYloc = -260;

$(window).scroll(function(){
    scrollTop = $(document).scrollTop();
    
    if (scrollTop > Math.abs(menuYloc))
        $('#top-nav').fadeIn('slow');
    else
        $('#top-nav').fadeOut('slow');
});

/* --- Scroll to Top link ----------------- */

$('#top-nav ul li.sws.reply').click(function(){
    $('html, body').animate({ scrollTop: 0 }, 400);
    
    return false; 
});