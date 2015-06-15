$(function(){
	$('.adminnav > li').bind('mouseover', openSubMenu);
	$('.adminnav > li').bind('mouseout', closeSubMenu);
	function openSubMenu() {
		$(this).find('ul').css('visibility', 'visible');	
	};
	function closeSubMenu() {
		$(this).find('ul').css('visibility', 'hidden');	
	};	   
});

$(function() {
	$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
	$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
	$( "div.juvenileform").hide(); $( "div.female").hide();
	$( "#juvdistinct" ).click(function () {
		if (this.value == 0) {
			$("div.juvenileform").hide();
		} else {
			$("div.juvenileform").show();
		}
		
	});
	$( "#femdistinct" ).click(function () {
		if (this.value == 0) {
			$("div.female").hide();
		} else {
			$("div.female").show();
		}
		
	});
});


