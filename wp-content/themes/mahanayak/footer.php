<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */
?>
<footer id="footer">
   <?php if(is_front_page()) {?>
   <div class="container footer-container">
      <div class="row">
         <div class="col-md-2 col-sm-6">
            <div class="widget">
               <h5 class="widget-title">Menu</h5>
               <?php 
                  $args = array( 'menu' => 'Footer Menu','echo' => false);
                  echo wp_nav_menu($args);
               ?> 
            </div>
            <div class="widget">
               <div class="social-links">
                  <a href="javascript:;"><i class="fa fa-facebook"></i></a>
                  <a href="javascript:;"><i class="fa fa-twitter"></i></a>
                  <a href="javascript:;"><i class="fa fa-google-plus"></i></a>
               </div>
            </div>
         </div>
         <div class="col-md-3 col-sm-6">
            <div class="widget">
               <h5 class="widget-title">Address information</h5>
               <p>
                  California. AMC Dine-In Theatres Marina,
                  Street 26, Distritc 543 #108
               </p>
               <p>
                  <i class="fa fa-mail"></i>Example@mail.com<br>
                  <i class="fa fa-phone"></i> + 123 456 7890
               </p>
            </div>
         </div>
         <div class="col-md-1"></div>
         <div class="col-md-6">
            <div class="widget">
               <h5 class="widget-title">Leave a message</h5>               
                  <div class="row">
                     <?php echo do_shortcode('[contact-form-7 id="58" title="Contact form"]'); ?>
                  </div>               
               <div class="errorMessage"></div>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
   <div class="sub-footer">
      <div class="container">
         <div class="row copyright-text">
            <div class="col-sm-12 text-center">
               <p class="mv3 mvt0">&copy; Copyrights <?php echo date('Y'); ?> Mahanayak. All rights reserved</p>
            </div>
         </div>
      </div>
   </div>
</footer>
<!-- Include jQuery and Scripts -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/custom-file-input.js"></script>
<?php /*<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>*/ ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/packages.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scripts.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/d3.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/index.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-modal-video.min.js"></script>

<!-- custom scrollbar plugin -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/scroll.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>  
<script>
   (function($){
     $(window).on("load",function(){
       
       $("#content-1").mCustomScrollbar({
         autoHideScrollbar:true,
         theme:"rounded"
       });
       
     });
   })(jQuery);
</script>
<?php if(is_front_page()) {?>
<!-- images slider plugin -->
<script>
   var slideIndex = 1;
   showDivs(slideIndex);
   
   function plusDivs(n) {
     showDivs(slideIndex += n);
   }
   
   function showDivs(n) {
     var i;
     var x = document.getElementsByClassName("mySlides");
     if (n > x.length) {slideIndex = 1}    
     if (n < 1) {slideIndex = x.length}
     for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
     }
     x[slideIndex-1].style.display = "block";  
   }
</script>
<?php } ?>
<!-- popup plugin -->
<!--<script src="jquery.min.js"></script>-->
<script src="<?php echo get_template_directory_uri(); ?>/js/remodal.js"></script>
<!-- Events -->
<script>
   jQuery(document).on('opening', '.remodal', function () {
     console.log('opening');
   });
   
   jQuery(document).on('opened', '.remodal', function () {
     console.log('opened');
   });
   
   jQuery(document).on('closing', '.remodal', function (e) {
     console.log('closing' + (e.reason ? ', reason: ' + e.reason : ''));
   });
   
   jQuery(document).on('closed', '.remodal', function (e) {
     console.log('closed' + (e.reason ? ', reason: ' + e.reason : ''));
   });
   
   jQuery(document).on('confirmation', '.remodal', function () {
     console.log('confirmation');
   });
   
   jQuery(document).on('cancellation', '.remodal', function () {
     console.log('cancellation');
   });
   
   //  Usage:
   //  $(function() {
   //
   //    // In this case the initialization function returns the already created instance
   //    var inst = $('[data-remodal-id=modal]').remodal();
   //
   //    inst.open();
   //    inst.close();
   //    inst.getState();
   //    inst.destroy();
   //  });
   
   //  The second way to initialize:
   $('[data-remodal-id=modal2]').remodal({
     modifier: 'with-red-theme'
   });
</script>
<!-- For time Picker -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/additional-methods.js"></script>
<script src='<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js'></script>
<script src='<?php echo get_template_directory_uri(); ?>/js/moment.min.js'></script>
<script src='<?php echo get_template_directory_uri(); ?>/js/bootstrap-datetimepicker.min.js'></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/index-time.js"></script>
<!-- For Date Picker -->
<!--<script src='js/jquery.min.js'></script>-->
<script src='<?php echo get_template_directory_uri(); ?>/js/jquery-ui.min.js'></script>
<script  src="<?php echo get_template_directory_uri(); ?>/js/index-date.js"></script>
<!--<script src="js/prefixfree.min.js"></script>-->
<script>
$( document ).ready(function() {
	//$(".youtybe_player").modalVideo({channel:'vimeo'});
    //console.log( "ready!" );
    $('.youtybe_player').click(function(){
    	//$("#myModal").modal();
    	 var id = $(this).attr("id");
    	    alert(id);
    	 alert($('#'+id+'').attr("href")); 
    	 //alert($("#myModal").closest("iframe").attr("src"));  
    	 //alert($('#iframeclass').attr('src'));
    	 //var modalname =  "#myModal"+id+"";
    	 //$('#iframeclass').attr('src', $('#'+id+'').attr("href"));
    	 //alert(modalname);  
    	//$(".youtybe_player").modalVideo({channel:'vimeo'}); 
    	 //$("#model_"+id+"").modal();   
    });
});
</script>
</body>
<?php wp_footer(); ?>
</html>
