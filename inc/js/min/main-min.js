jQuery(document).ready(function($){"function"==typeof $.fn.magnificPopup&&($("article.post a[href$='.jpg'], article.post a[href$='.png'], article.post a[href$='.gif']").magnificPopup({type:"image"}),$(".popup-image").magnificPopup({type:"image"}),$(".popup-product").magnificPopup({type:"inline",closeOnContentClick:!1})),$(".same-height").matchHeight({byRow:!1}),$(".same-height-by-row").matchHeight({byRow:!0,property:"min-height",remove:!1}),$(".add-scroll-down").append('<span class="scroll-down"><a class="fa fa-chevron-circle-down" aria-hidden="true"></a></span>'),$(".scroll-down a").click(function(){var o=$(this).closest(".add-scroll-down").position(),e=$(this).closest(".add-scroll-down").height(),i=o.top+e;$("html, body").stop().animate({scrollTop:i})})});