<?php
/*
* Template Name: Registration
*/
/*
 * if user allready logged in then
 * redirect this user to profile page.
 */
logged_in_user_checking(FALSE,site_url());
if($_POST["submit_registration"]!='')
{
    /*echo "<pre>";
     print_r($_POST);
     echo "</pre>";
    exit();*/
    $regerror = "";
    $regsuccess = "";
    $creds = array(
        'user_login'    => $_POST["fname"],
        'user_password' => $_POST["user_pass"],
        'remember'      => true
    );
    
    $username = sanitize_text_field( $_POST['user_name'] );
    $emailId = sanitize_text_field( $_POST['email_id'] );
    if ( username_exists( $username ) ) 
     $regerror = "Username In Use!";
    if (email_exists($emailId))
     $regerror = "Email In Use!";
    if($_POST['terms_check']!=on)
     $regerror = "You must accept terms and conditions.";
    
    if(empty($regerror)) 
    {
        $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
        $user_id = wp_create_user( $username, $random_password, $emailId );
        
        // Email the user
        wp_mail( $emailId, 'Welcome!', 'Your Password: ' . $password );
        $regsuccess = "Your registration has been successfully completed. Please check your email for password";
        
        $user_id = wp_update_user( array( 'ID' => $user_id, 'first_name' => $_POST['fname'], 'last_name' => $_POST['lname']) );        
        if ( is_wp_error( $user_id ) ) {
            // There was an error, probably that user doesn't exist.
            $regerror = "There was an error, probably that user doesn't exist.";
        } else {
            $regsuccess = "Your registration has been successfully completed. Please check your email for password.";
        }	
    }
    
    
}
get_header(); ?>

<section class="section-content pv12" data-bg-image="<?php echo get_template_directory_uri(); ?>/images/coming-bg.jpg">
    <div class="container">
        <div class="row">
            
        </div>        
    </div> 
    <div class="container">
         <div class="col-sm-12 page-title mt5 mb5">
                <h1 class="blog-title">Register</h1>
            </div>
        <div class="row"> 
            <div class="ma-login">
            <div class="row login-content">
                <div class="col-sm-7 col-xs-12">
                    <div class="entry-order-content">
                     <div class="errmsg"><?php echo $regerror; ?></div>
                     <div class="successmsg"><?php echo $regsuccess; ?></div>
                        <form id="msform" name="msform" method="post" action="">
                                <div class="wpc-content log-sub-text">
                                    <input  placeholder="First Name" class="txt-box" type="text" name="fname" id="fname">
                                    <input  placeholder="Last Name" class="txt-box" type="text" name="lname" id="lname">
                                    <input name="email_id" placeholder="Email Id" class="txt-box" type="text">
                                    <input name="user_name" placeholder="User Name" class="txt-box" type="text">                                    
                                </div>                                

                                <div class="reg_lebel">
                                    <label>
                                        <input type="checkbox" name="terms_check" id="terms_check"><span></span> Agree to our <a class="reg_terms" href="<?php echo site_url()."/terms-and-conditions"; ?>" target="_blank">Terms and Conditions</a> and <a class="reg_terms" href="<?php echo site_url()."/privacy-policy"; ?>" target="_blank">Privacy Policy</a>
                                    </label>
                                </div>

                                <div class="cl"></div>
                                <input name="submit_registration" class="next123 action-button" value="REGISTER" type="submit">
                        </form>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-12 log-rh-cont">
                    <h2>Sign In with your curent Facebook Account below.</h2>
                    <div class="order-details">
                      <?php echo do_shortcode('[fbl_login_button redirect="" hide_if_logged="" size="large" type="continue_with" show_face="true"]');?>
                      <div class="fb-box">
                        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/fb_logo.png" alt=""></a> 
                      </div>
                      <div class="logo-box">
                        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt=""></a> 
                      </div> 
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
<?php get_footer();
?>
<script>
$(document).ready(function () {

    $('#msform').validate({ // initialize the plugin        
    	// Specify validation rules
        rules: {
          // The key name on the left side is the name attribute
          // of an input field. Validation rules are defined
          // on the right side
          fname: "required",
          lname: "required",
          email_id: {
            required: true,
            // Specify that email should be validated
            // by the built-in "email" rule
            email: true
          },
          user_name: "required",
          terms_check: "required", 
        },
        // Specify validation error messages
        messages: {
          firstname: "Please enter your firstname",
          lastname: "Please enter your lastname",
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
          email: "Please enter a valid email address"
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
          form.submit();
        }
    });

});  
</script>

