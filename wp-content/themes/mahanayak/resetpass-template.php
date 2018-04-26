<?php
/*
* Template Name: Reset Password
*/
/*
 * if user allready logged in then
 * redirect this user to profile page.
 */
logged_in_user_checking(FALSE,site_url());
get_header(); ?>

<section class="section-content pv12" data-bg-image="<?php echo get_template_directory_uri(); ?>/images/coming-bg.jpg">
    <div class="container">
        <div class="row">
            
        </div>        
    </div> 
    <div class="container">

         <div class="col-sm-12 page-title mt5 mb5">
                <h1 class="blog-title">LOgin</h1>
            </div>
            <div class="clearfix"></div>
        <div class="row"> 
            <div class="ma-login">
            <div class="row login-content">
                <div class="col-sm-6 col-xs-6 box">
                    <div class="entry-order-content">
                        <!-- start forgot password -->
                        <!--<form name="lostpass" id="lostpass" method="post">
                         <input type="text" name="user_name" id="user_name">
                         <input type="submit" value="Reset Password">
                        </form>-->
                        <div id="lostPassword">
                        <div id="message"></div>
                        <form id="lostPasswordForm" method="post">
                        	<?php
                        	// this prevent automated script for unwanted spam
                        	if ( function_exists( 'wp_nonce_field' ) )
                        		wp_nonce_field( 'rs_user_lost_password_action', 'rs_user_lost_password_nonce' );
                        ?>
                        
                        <p>
                        	<label for="user_login"><?php _e('Username or E-mail:') ?> <br />
                        <input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr($user_login); ?>" size="20" />
                        	</label>
                        </p>
                        <?php
                        /**
                         * Fires inside the lostpassword <form> tags, before the hidden fields.
                         *
                         * @since 2.1.0
                         */
                        do_action( 'lostpassword_form' ); ?>
                        
                        	<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Get New Password'); ?>" />
                        
                        	</form>
                        </div>
                        <!-- end forgot password -->
                    </div>
                <div class="clearfix"></div>
                <div class="log-rh-cont ">
                    <h2>Sign In with your curent Facebook Account below.</h2>
                    <div class="order-details">
                      <div class="fb-box">
                        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/fb_logo.png" alt=""></a> 
                      </div>
                      
                    </div>
                </div>
                <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div> 
</section>

<?php get_footer();
?>
<script>
jQuery(document).ready(function($) {

	// for lost password
	$("#lostPasswordForm").submit(function(){
		alert('nnnnn');
		var submit = $("div#lostPassword #submit"),
			//preloader = $("div#lostPassword #preloader"),
			message	= $("div#lostPassword #message"),
			contents = {
				action: 	'lost_pass',
				nonce: 		this.rs_user_lost_password_nonce.value,
				user_login:	this.user_login.value
			};
		var theme_ajax_url = "http://localhost/mahanayak/admin/admin-ajax.php";
		alert(theme_ajax_url);
		// disable button onsubmit to avoid double submision
		//submit.attr("disabled", "disabled").addClass('disabled');

		// Display our pre-loading
		//preloader.css({'visibility':'visible'});

		$.post( theme_ajax_url, contents, function( data ){
			submit.removeAttr("disabled").removeClass('disabled');

			// hide pre-loader
			preloader.css({'visibility':'hidden'});

			// display return data
			message.html( data );
		});

		return false;
	});


	// for reset password
	$("form#resetPasswordForm").submit(function(){
		var submit = $("div#resetPassword #submit"),
			preloader = $("div#resetPassword #preloader"),
			message	= $("div#resetPassword #message"),
			contents = {
				action: 	'reset_pass',
				nonce: 		this.rs_user_reset_password_nonce.value,
				pass1:		this.pass1.value,
				pass2:		this.pass2.value,
				user_key:	this.user_key.value,
				user_login:	this.user_login.value
			};

		// disable button onsubmit to avoid double submision
		submit.attr("disabled", "disabled").addClass('disabled');

		// Display our pre-loading
		preloader.css({'visibility':'visible'});

		$.post( theme_ajax.url, contents, function( data ){
			submit.removeAttr("disabled").removeClass('disabled');

			// hide pre-loader
			preloader.css({'visibility':'hidden'});

			// display return data
			message.html( data );
		});

		return false;
	});

});
</script>
