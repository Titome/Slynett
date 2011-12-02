jQuery(function($){
    // initImgs();
    $('div.tabs').tabs();
    
    /* --- Others ---------------------- */
    
    // $('select, input:checkbox, input:radio, input:file').uniform();
    
    /* --- Main Search ----------------- */
    
    var searchInput = $('form.search input:text:not(.locked)');
    
    if (searchInput.val() == false)
    {
        searchInput.animate({'width': '85px'});
    }
    
    searchInput.focus(function(){
        $(this).animate({'width': '300px'});
    });
    
    searchInput.focusout(function(){
        if ($(this).val() == false)
        {
            $(this).animate({'width': '85px'});
        }
    });
    
    /* --- K -------------- */
    
    var kkeys = [], konami = '38,38,38,38,38';
    // 38,38,40,40,37,39,37,39,66,65

    $(document).keydown(function(e){
      kkeys.push(e.keyCode);

      if (kkeys.toString().indexOf(konami) >= 0)
      {
        $(document).unbind('keydown', arguments.callee);
        
        $('body').prepend('<a href="http://www.youtube.com/-ecg5_Y08KI?autoplay=1" onclick="var w=window.open(this.href); w.focus(); return false;"><img id="k" src="/uploads/chicken.gif" alt="Chicken" /></a>');
               
        $('#header *').fadeOut();
        
        $('#header')
            .animate({'height': '200px', 'width': '100%'})
            .animate({'backgroundColor': '#ff0000'}, 1200)
            .animate({'backgroundColor': '#00ff00'}, 1200)
            .animate({'backgroundColor': '#fe00ee'}, 1200)
            .animate({'backgroundColor': '#ff0000'}, 1200)
            .animate({'backgroundColor': '#00ff00'}, 1200)
            .animate({'backgroundColor': '#fe00ee'}, 1200)
            .animate({'backgroundColor': '#ffffff', 'height': '100px', 'width': '1024px'}, 1200);
        
        $('#k').animate({
            'left': '70%'
        }, {'duration': 3000, 'easing': 'easeInOutCirc'}).animate({
            'left': '23%'
        }, {'duration': 1000, 'easing': 'easeInOutBack'});
        
        $('#k').delay(9000).animate({'zIndex': '-1'}, 100).animate({'top': '200px'}, 1200).animate({'opacity': '0'}, 800);
        $('#header *').delay(9000).fadeIn();
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
    $.scrollTo('#author', 800, { offset: -90 });
}

/* --- SyntaxHighlighter --------------- */

SyntaxHighlighter.all();

/* --- HTML5/Canvas greyscale convertor  */

function initImgs(){
  $("img.item").each(function(){
    var el = $(this);
    var parent = el.parent();
    $(this).one("load",function() {
      el.animate({
        opacity : 1
      }, 500);
  
      el.wrap('<div class="imgwrapper">').clone().addClass('grayscale').css({
        "position" : "absolute",
        "z-index" : "0",
        "opacity" : "0"
      }).insertBefore(el).mouseover(function(){
        parent.find('img:first').stop().animate({
          opacity : 1
        }, 500);
      }).mouseout(function(){
        $(this).stop().animate({
          opacity : 0
        }, 1000);
      });
      if($.browser.msie){
        grayscaleIE(this);
      } else {
        this.src = grayscale(this);
      }
    }).each(function(){
      if(this.complete || (jQuery.browser.msie && parseInt(jQuery.browser.version) == 6))
        $(this).trigger("load");
    });
  });
};


function grayscaleIE(img) {
  img.style.filter = 'progid:DXImageTransform.Microsoft.BasicImage(grayScale=1)';
}
    
function grayscale(img) {
  var canvas = document.createElement('canvas');

  var ctx = canvas.getContext('2d');
  var imgObj = new Image();
  imgObj.src = img.src;
  canvas.width = imgObj.width;
  canvas.height = imgObj.height;
  ctx.drawImage(imgObj, 0, 0);
  var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
  for(var y = 0; y < imgPixels.height; y++) {
    for(var x = 0; x < imgPixels.width; x++) {
      var i = (y * 4) * imgPixels.width + x * 4;
      var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
      imgPixels.data[i] = avg;
      imgPixels.data[i + 1] = avg;
      imgPixels.data[i + 2] = avg;
    }
  }
  ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
  return canvas.toDataURL();
}