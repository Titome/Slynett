jQuery(function($){
    $('div.tabs').tabs();
    
    /* --- Others ---------------------- */
    
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
        var zIndexOverlay = $('#overlay').css('zIndex');
        var shareElementZIndex = (zIndexOverlay*1) + 1;
        
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
        
        $('#overlay').css('zIndex', zIndexOverlay);
        
        return false;
    });
    
    /* --- Scroll To Links ------------- */
    
    $('.sgoto').click(function(){
        var linkDestinationID = $(this).attr('href');
        
        $.scrollTo(linkDestinationID, 800, { offset: -120 });
        
        return false;
    });
    
    /* --- Active Menus - Author Part -- */
    
    $('#top-nav ul.author li:not(.reply) a').click(function(){
        $(this).parent('li').addClass('active').siblings('li').removeClass('active');
        
        linkHref = $(this).attr('href');
        $('#author-main ul.categories li').removeClass('active');
        $('#author-main ul.categories li a[href='+linkHref+']').parent('li').addClass('active');

        return false;
    });
    
    $('#author-main ul.categories li a').click(function(){
        $(this).parent('li').addClass('active').siblings('li').removeClass('active');
        
        linkHref = $(this).attr('href');
        $('#top-nav ul.author li').removeClass('active');
        $('#top-nav ul.author li a[href='+linkHref+']').parent('li').addClass('active');

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

/* --- Sidebar persistence --------- */

var name = 'aside.sidebar.persistent';
var menuYloc = -380;

$(window).scroll(function(){
    offset = menuYloc + $(document).scrollTop();
    if (offset < 0) offset = 0;
    $(name).animate({
        top: offset + 'px'
    }, { duration: 500, queue: false });
});

/* --- Scroll to Top link -------------- */

$('#top-nav ul li.sws.totop').click(function(){
    $('html, body').animate({ scrollTop: 0 }, 400);
    
    return false; 
});

/* --- Let's show Item ----------------- */

function letsShowItem()
{
    if (window.location.hash == '')
        $.scrollTo('section[role=contentinfo] h2:first', 800, { offset: -100 });
}

/* --- Let's show Author --------------- */

function letsShowAuthor()
{
    $.scrollTo('#author', 800, { offset: -130 });
}

/* --- SyntaxHighlighter --------------- */

SyntaxHighlighter.all();