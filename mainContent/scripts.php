<!-- jScripts -->
     
        <script src="assets/js/css3-animate-it.js"></script>
	<script>
	 (function() {
	  $('a.popup-window').on('click', function() {
	    var popupBox = $(this).attr('href');
	    $(popupBox).fadeIn(1000);
	    
	    var popMargTop = ($(popupBox).height() + 24 ) / 2;
	    var popMargLeft = ($(popupBox).width() + 24 ) / 2;
	    
	    $(popupBox).css({
	      'margin-top': '-popMargTop',
	      'margin-left': '-popMargleft'
	    });
	    
	    $('body').append('<div id="mask"></div>');
	    $('#mask').fadeIn(1000);
	 
	  });
	  
	  $(document).on('click', '#mask, button.close', function() {
	    
	    $('#mask, .popupInfo').fadeOut(400, function() {
	      $('#mask').remove();
	    });   

	  });
	  
	  $(document).keyup(function(e) {
	    if(e.keyCode === 27) {
	      $('#mask, .popupInfo, #popup-box').fadeOut(400, function() {
	         $('#mask').remove() 
	      });

	    }
	  });
	  
	})();
	</script>