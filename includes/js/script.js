jQuery(document).ready(function($){

/*-----------------------------------------------------------------------------------*/
/* Add alt-row styling to tables */
/*-----------------------------------------------------------------------------------*/
	$( 'table tr:odd').addClass( 'alt' );

/*-----------------------------------------------------------------------------------*/
/* Wrap ampersands in spans for styling purposes */
/*-----------------------------------------------------------------------------------*/
	$("p:contains('&')").each(function(){
    	$(this).html($(this).html().replace(/&amp;/, "<span class='ampersand'>&amp;</span>"))
  	});


/*-----------------------------------------------------------------------------------*/
/* Avoid widows in headings */
/*-----------------------------------------------------------------------------------*/
	$(".product_title, .page-title, h1.title a, .product a h3").each(function() {
	         var wordArray = $(this).text().split(" ");
	         var finalTitle = "";
	         for (i=0;i<=wordArray.length-1;i++) {
	            finalTitle += wordArray[i];
	            if (i == (wordArray.length-2)) {
	                finalTitle += "&nbsp;";
	            } else {
	                finalTitle += " ";
	            }
	          }
	          $(this).html(finalTitle);
	});

/*-----------------------------------------------------------------------------------*/
/* Fire Tipsy */
/*-----------------------------------------------------------------------------------*/
	$('.tooltip').tipsy({gravity: 's'}); // nw | n | ne | w | e | sw | s | se

/*-----------------------------------------------------------------------------------*/
/* Fire Uniform js */
/*-----------------------------------------------------------------------------------*/
	$("select.orderby, .variations select, input[type=radio]").uniform();

/*-----------------------------------------------------------------------------------*/
/* Fire FitVids js */
/*-----------------------------------------------------------------------------------*/	
	//$("#content").fitVids();

/*-----------------------------------------------------------------------------------*/
/* Fire Responsive Menus */
/*-----------------------------------------------------------------------------------*/	
	$('ul#top-nav').mobileMenu({
	  switchWidth: 767,                   //width (in px to switch at)
	  topOptionText: 'Select a page',     //first option text
	  indentString: '&nbsp;&nbsp;&nbsp;'  //string for indenting nested items
	});
			
/*-----------------------------------------------------------------------------------*/
/* Simple tabs */
/*-----------------------------------------------------------------------------------*/ 
	$('.tab-nav li a').click(function() {
		
		var href = $(this).attr("href");
		$('.tab').hide();
		$('.tab-nav li').removeClass('active');
		$(this).parent().addClass('active');
		$(href).show();
		return false;
		jQuery.cookie('open_tab', href);
		
	});
	if ($('.tab-nav li.active').size() > 0) {
		$('.tab-nav li.active a').click();
	} else {
		$('.tab-nav li:first a').click();
	}

	
});