<?php
/*
* Template Name: Login
*/
/*
 * if user allready logged in then
 * redirect this user to profile page.
 */
logged_in_user_checking(FALSE,site_url());
/*
 * check user login
 * 19/04/2018
 * @anish
 */
if($_POST["login_submit"]!='')
{
    /*echo "<pre>";
    print_r($_POST);
    echo "</pre>";*/
    
    $creds = array(
        'user_login'    => $_POST["user_name"],
        'user_password' => $_POST["user_pass"],
        'remember'      => true
    );
    
    $user = wp_signon( $creds, false );
    
    if ( is_wp_error( $user ) ) {
        $errormsg = $user->get_error_message();
        $errormsg = "Invalid login";
    }
    else
    {
        logged_in_user_checking(FALSE,site_url().'/profile');
        exit();
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
                <h1 class="blog-title">LOgin</h1>
            </div>
            <div class="clearfix"></div>
        <div class="row"> 
            <div class="ma-login">
            <div class="row login-content">
                <div class="col-sm-6 col-xs-6 box">
                    <div class="entry-order-content">
                        <div class="errmsg"><?php echo $errormsg; ?></div>
                        <form id="loginform" name="loginform" method="post" action="">
                                <div class="wpc-content log-sub-text">
                                    <input name="user_name" placeholder="User Name" class="txt-box" type="text" >
                                    <input name="user_pass" placeholder="Password" class="txt-box" type="password">
                                </div>
                                <a class="login_frg" href="#">Forgot Pasword?</a>
                                <div class="cl"></div>
                                <input name="login_submit" class="next1 action-button" value="LOGIN" type="submit">
                        </form>
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
$(document).ready(function () {

    $('#loginform').validate({ // initialize the plugin        
        rules: {
        	user_name: {
                required: true,
                //email: true
            },
            user_pass: {
                required: true,
                //minlength: 5
            }
        },
        submitHandler: function (form) { 
            //alert('valid form submitted'); 
            return true; // for demo
        }
    });

});  
</script>
