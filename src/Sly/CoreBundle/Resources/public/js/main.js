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
    
    /* --- K -------------- */
    
    var kkeys = [], konami = '38,38,38,38,38';
    // 38,38,40,40,37,39,37,39,66,65

    $(document).keydown(function(e){
      kkeys.push(e.keyCode);

      if (kkeys.toString().indexOf(konami) >= 0)
      {
        $(document).unbind('keydown', arguments.callee);
        
        $('body').prepend('<div id="k"><object style="height: 390px; width: 640px"><param name="movie" value="http://www.youtube.com/v/-ecg5_Y08KI?version=3&feature=player_detailpage&autoplay=1"><param name="autoplay" value="true"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><embed src="http://www.youtube.com/v/-ecg5_Y08KI?version=3&autoplay=1&feature=player_detailpage" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="640" height="360"></object></div>');
      }
    });
    
    /* --- Share Overlay ------------------- */

    $('.go-share').click(function(){
        var parentTabs = $('ul.share:last').parents('div.tabs');
        var zIndexOverlay = $('#overlay').css('z-index');
        var shareElementZIndex = (zIndexOverlay*1) + 1;
        
        console.log(shareElementZIndex);
        
        $('#overlay').fadeIn();
        
        if (parentTabs.length > 0)
        {
            parentTabs.tabs('select', 0);
            
            parentTabs.css('zIndex', shareElementZIndex);
            $.scrollTo(parentTabs, 800, { offset: -200 });
            
            var shareInvertTimer = setTimeout((function(){
                $('#overlay').fadeOut(1000);
                parentTabs.css('zIndex', 0);
            }), 2500);
        }
        else
        {
            var shareElement = $('ul.share:last');
            
            shareElement.css('zIndex', shareElementZIndex);
            $.scrollTo(shareElement, 800, { offset: -200 });
            
            var shareInvertTimer = setTimeout((function(){
                $('#overlay').fadeOut(1000).css('zIndex', 0);
                shareElement.css('zIndex', 0);
            }), 2500);
        }
        
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

/* --- Scroll to Top link -------------- */

$('#top-nav ul li.sws.reply').click(function(){
    $('html, body').animate({ scrollTop: 0 }, 400);
    
    return false; 
});

/* --- Let's show Item ----------------- */

function letsShowItem()
{
    if (window.location.hash == '')
        $.scrollTo('section[role=contentinfo] h2:first', 800, { offset: -100 });
}

/* --- SyntaxHighlighter --------------- */

SyntaxHighlighter.all();
