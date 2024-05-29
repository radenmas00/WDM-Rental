$(function() {
    "use strict";
  
    //****************************
    /* sidebar position */
    //****************************
    function handlesidebarposition() {
		$('#sidebar-position').change(function() {
            if( $(this).is(":checked")) {
                $('#main-wrapper').attr("data-sidebar-position", 'fixed' );
                $('.topbar .top-navbar .navbar-header').attr("data-navheader", 'fixed' );
            }else {
                $('#main-wrapper').attr("data-sidebar-position", 'absolute' ); 
                $('.topbar .top-navbar .navbar-header').attr("data-navheader", 'relative' );
            }
        });
        
	};
    handlesidebarposition ();
    //****************************
    /* Header position */
    //****************************
    function handleheaderposition() {
		$('#header-position').change(function() {
            if( $(this).is(":checked")) {
                $('#main-wrapper').attr("data-header-position", 'fixed' );
            }else {
                $('#main-wrapper').attr("data-header-position", 'relative' ); 
            }      
        });
	};
    handleheaderposition ();
    //****************************
    /* sidebar position */
    //****************************
    function handleboxedlayout() {
		$('#boxed-layout').change(function() {
            if( $(this).is(":checked")) {
                $('#main-wrapper').attr("data-boxed-layout", 'boxed' );
            }else {
                $('#main-wrapper').attr("data-boxed-layout", 'full' ); 
            }
        });
        
	};
    handleboxedlayout ();
    //****************************
    /* Header position */
    //****************************
    function handlethemeview() {
		$('#theme-view').change(function() {
            if( $(this).is(":checked")) {
                $('body').attr("data-theme", 'dark' );
            }else {
                $('body').attr("data-theme", 'light' ); 
            }      
        });
	};
    handlethemeview ();
});