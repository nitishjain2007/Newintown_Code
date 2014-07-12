$(function(){
      // SyntaxHighlighter.all();
    });
    $("#imp").click(function(){
      
      $( "#container" ).toggle( "slow", function() {
        // Animation complete.
      });
      $( "#container1" ).toggle( "slow", function() {
        // Animation complete.
      });
      $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 210,
        itemMargin: 5,
        asNavFor: '#slider'
      });
	$('#carousel1').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 210,
        itemMargin: 5,
        asNavFor: '#slider1'
      });


      $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
	$('#slider1').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel1",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });

    $( "#first_div" ).click(function() {
      $( "#container" ).toggle( "slow", function() {
        
      });
    });
	$( "#second_div" ).click(function() {
      $( "#container1" ).toggle( "slow", function() {
        
      });
    });
