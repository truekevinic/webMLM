(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();
	if(!sessionStorage.getItem('open')){
		sessionStorage.setItem('open','yes');
	}

	if(sessionStorage.getItem('open') == 'yes'){
		$('#sidebar').toggleClass('active');
		$('#sidebtn').toggleClass('active');
	}
	$('#sidebarCollapse').on('click', function () {
		
	  $('#sidebar').toggleClass('active');
	  $('#sidebtn').toggleClass('active');
	  if(sessionStorage.getItem('open') == 'yes' ){
		sessionStorage.setItem('open','not');
	  }else if(sessionStorage.getItem('open') == 'not' ){
		sessionStorage.setItem('open','yes');
	  }
  });

})(jQuery);
