<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
	</div> <!-- ast-container -->
	</div><!-- #content -->
<?php 
	astra_content_after();
		
	astra_footer_before();
		
	astra_footer();
		
	astra_footer_after(); 
?>
	</div><!-- #page -->
<?php 
	astra_body_bottom();    
	wp_footer(); 
?>
</body>
</html>


<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/unminified/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/unminified/aos.js"></script>
<script>
AOS.init();

jQuery(document).ready(function(){
	jQuery(".btnEnquireNow a").click(function() {
	    jQuery('html, body').animate({
	        scrollTop: jQuery(".banner-form").offset().top
	    }, 2000);
	});
	var gethref = window.location.href;
	jQuery('.get_url_class').attr('value',gethref);
	
});

jQuery(document).ready(function(){
	jQuery('.client_wrap_ul').slick({
	  dots: false,
	  infinite: true,
	  speed: 300,
	  slidesToShow: 6,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1400,
	      settings: {
	        slidesToShow: 5,
	        slidesToScroll: 1,
	        infinite: true,
	        dots: false
	      }
	    },
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 4,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 999,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 767,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});
    
	jQuery('.testimonial_wrap_ul').slick({
	  dots: true,
	  infinite: true,
      arrow: false,  
  	  centerMode: true,
	  speed: 300,
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 999,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});
    jQuery(window).resize(function(){
       checkpadd()
    });
});

function checkpadd(){
    var getwindowwidth = jQuery(window).width();
    var getwidth = jQuery('.site-primary-header-wrap').width();
    var calpadding = getwindowwidth - getwidth;
    var calpadding1 = calpadding/2;
    jQuery('.banner_section').css('padding-left',calpadding1);
}setTimeout('checkpadd()',1000);


</script>