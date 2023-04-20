(function($) { "use strict";

 	//Parallax

	function scrollBanner() {
	  $(document).on('scroll', function(){
      var scrollPos = $(this).scrollTop();
      if($('body').hasClass('home')) {
        $('.home__hero__text-cont .square').css({
          'margin-bottom' : (scrollPos/5)+'px'
        });
        $('.home__story__text-cont .square').css({
          'margin-top' : (scrollPos/2)+'px'
        });
        $('.home__image-text__content .square').css({
          'margin-top' : (scrollPos/-5)+'px'
        });
        $('.parallax-1').css({
          'top' : (scrollPos/-1.5)+'px'
        });
        $('.parallax-2').css({
          'top' : (scrollPos/-3.5)+'px'
        });
        $('.parallax-3').css({
          'top' : (scrollPos/-5)+'px'
        });
        $('.parallax-4').css({
          'top' : (scrollPos/-10)+'px'
        });

      var home__awards__image = scrollPos - $('.home__awards__image').offset().top;
        $('.home__awards__image').css({
          'margin-bottom' : (home__awards__image/5)+'px'
        });

      /*var home__contact__image = scrollPos - $('.home__contact__image').offset().top;
        $('.home__contact__image').css({
          'margin-bottom' : (home__contact__image/2)+'px'
        });*/
      }

      });
	  }
	scrollBanner();

})(jQuery);
