jQuery(document).ready(function() {
   // Mobile Site Menu - Nav Toggle 
	jQuery(".mobile-nav-toggle").click(function(e) {
		e.preventDefault();
		jQuery(this).toggleClass("active-mobile-menu");
		jQuery(".nav").toggle();
		jQuery("#mobile-search").hide();
		jQuery(".mobile-search-toggle").removeClass("active-mobile-menu");
		
		jQuery("#mobile-login").hide();
		jQuery(".mobile-login-toggle").removeClass("active-mobile-menu");
	});
	
   // Mobile Site Menu - Search Toggle 
	jQuery(".mobile-search-toggle").click(function(e) {
		e.preventDefault();
		if( jQuery("#mobile-search").is(":visible") ) {
			jQuery("#mobile-search").hide();
			jQuery(".mobile-search-toggle").removeClass("active-mobile-menu");
		} else {
			jQuery("#mobile-search").show();
			jQuery(".mobile-search-toggle").addClass("active-mobile-menu");
			
			jQuery("#mobile-login").hide();
			jQuery(".mobile-login-toggle").removeClass("active-mobile-menu");
			jQuery(".nav").hide();
			jQuery(".mobile-nav-toggle").removeClass("active-mobile-menu");
		}
	});

   // Mobile Site Menu - Login Toggle 
	jQuery(".mobile-login-toggle").click(function(e) {
		e.preventDefault();
		if( jQuery("#mobile-login").is(":visible") ) {
			jQuery("#mobile-login").hide();
			jQuery(".mobile-login-toggle").removeClass("active-mobile-menu");
		} else {
			jQuery("#mobile-login").show();
			jQuery(".mobile-login-toggle").addClass("active-mobile-menu");
			
			jQuery("#mobile-search").hide();
			jQuery(".mobile-search-toggle").removeClass("active-mobile-menu");
			jQuery(".nav").hide();
			jQuery(".mobile-nav-toggle").removeClass("active-mobile-menu");
		}
	});
	
	adjustMenu();
		
	//Edge detection for first-level drop down menus
	jQuery(".nav > li > a").on('mouseenter', function (e) {
		if ( !jQuery("#mobile-menu").is(':visible') ) {
			var subMenu = jQuery('ul:first', jQuery(this).parent() );
	      
         if ( subMenu.length ) { /* If we have a submenu */
            subMenu.removeClass('edge');

            var subMenuRight = subMenu.width() + subMenu.offset().left;
            var bodyRight = jQuery("body").offset().left + jQuery("body").width();
            if ( subMenuRight > bodyRight) {
               subMenu.addClass('edge');
            } 
         }
		}
	});

	//Edge detection for second-level drop down menus
	jQuery(".nav ul > .menu-item-has-children").on('mouseenter', function (e) {
		if ( !jQuery("#mobile-menu").is(':visible') ) {
			var subMenu = jQuery('ul:first', this );
			subMenu.removeClass("kick-left");
			
			var subMenuRight = subMenu.offset().left + subMenu.width();
			var bodyRight = jQuery("body").offset().left + jQuery("body").width();
         
			if ( subMenuRight > bodyRight ) {
				subMenu.addClass('kick-left');
			} 
		}
	});

   //Touch Device Menu Handling
   var isTouchDevice = false;
   jQuery ( "html" ) .on ( 'touchstart', function ( e ) { isTouchDevice = true; } );
   //It would be nice to do this, but ipads trigger mousemove events, so we can't
	//jQuery ( "html" ) .on ( 'mousemove', function ( e ) { isTouchDevice = false; } ); 
  
   //2017/01/25 - JDH - I'd like to have it go through the link if the item is clicked twice
   //But it's not too important. All functionality exists, and this is nice and simple
   jQuery ( ".menu-item-has-children > a" ) . on ( 'click', function ( e ) {
      if ( ! isTouchDevice ) return true;
      return false; //Prevents default behavior, i.e. going to the link
   } );
})

/* Hide or Show the mobile menu bar, depending on page size */
jQuery(window).bind('resize orientationchange', function() {
	adjustMenu();
});

/* The function that hides or shows the mobile menu */
var adjustMenu = function() {
	if ( jQuery("#mobile-menu").is(':visible') ) {
		if (jQuery(".mobile-nav-toggle").hasClass("active-mobile-menu")) {
			jQuery(".nav").show();
		} else {
			jQuery(".nav").hide();
			
		}
		jQuery(".nav .menu-item-has-children > a").unbind('click').bind('click', function(e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			jQuery(this).parent("li").toggleClass("show-sub-menu");
		});

	} else {
		jQuery("#mobile-search").hide();
		jQuery("#mobile-login").hide();
		jQuery(".nav").show();
		jQuery(".mobile-nav-toggle").removeClass("active-mobile-menu");
		
      jQuery(".nav li a").unbind('click');
		
      /*This causes the menu kick to stop functioning after resizing the screen
      jQuery(".nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
		 	// must be attached to li so that mouseleave is not triggered when hover over submenu
		 	jQuery(this).toggleClass('hover');
		});
      */
      
	}
}

