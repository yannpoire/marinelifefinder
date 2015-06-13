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
	if ($('div.timedmsg')) {
		$( "div.timedmsg" ).slideDown( 1800, function() {
	  	}).delay( 5000 ).slideUp(1600);
	 }
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

tinymce.init({
    selector: "textarea.content",
    plugins : [ "link, image, hr, anchor, pagebreak, media, wordcount, table, responsivefilemanager"],
    image_advtab: true,
	external_filemanager_path:"../plugins/filemanager/",
	filemanager_title:"Responsive Filemanager" ,
	external_plugins: { "filemanager" : "plugins/responsivefilemanager/plugin.min.js"}
 });
