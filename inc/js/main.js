jQuery(document).ready(function($) {

	//MagnificPopup initialize
	if (typeof $.fn.magnificPopup == "function") {
		$("article.post a[href$='.jpg'], article.post a[href$='.png'], article.post a[href$='.gif']").magnificPopup({type:'image'});	
	  $('.popup-image').magnificPopup({type:'image'});		
		$('.popup-product').magnificPopup({
			type:'inline',
		  closeOnContentClick: false,
		});
	}
	
	//matchheight	
	$('.same-height').matchHeight({
    byRow: false,
	});	
	$('.same-height-by-row').matchHeight({
	    byRow: true,
	    property: 'min-height',
	    remove: false
	});


//Scroll to next section icon
	$(".add-scroll-down").append( '<span class="scroll-down"><a class="fa fa-chevron-circle-down" aria-hidden="true"></a></span>' );

	$(".scroll-down a").click(function(){
			var pos = $(this).closest('.add-scroll-down').position(),
					height = $(this).closest('.add-scroll-down').height(),
					nextPos = pos.top + height;
	    $("html, body").stop().animate({scrollTop: nextPos});
	});	
		
	
});




