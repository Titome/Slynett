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