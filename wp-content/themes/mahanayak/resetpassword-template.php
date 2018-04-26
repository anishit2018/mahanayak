<?php
ob_start();
/*
* Template Name: Reset Password
*/
/*
 * if user allready logged in then
 * redirect this user to profile page.
 */
if($_POST["login_submit"]!='')
{
    
    if(!email_exists( $_POST["user_name"] ) && !username_exists($_POST["user_name"]))
    {
        $errormsg = "This user name/email is not valid.";
    }
    else
    {
        $successmsg = custom_retrieve_password($_POST["user_name"]);
        
    }
}
logged_in_user_checking(FALSE,site_url());
/*
 * check user login
 * 19/04/2018
 * @anish
 */
get_header(); ?>

<section class="section-content pv12" data-bg-image="<?php echo get_template_directory_uri(); ?>/images/coming-bg.jpg">
    <div class="container">
        <div class="row">
            
        </div>        
    </div> 
    <div class="container">

         <div class="col-sm-12 page-title mt5 mb5">
                <h1 class="blog-title">Reset Password</h1>
            </div>
            <div class="clearfix"></div>
        <div class="row"> 
            <div class="ma-login">
            <div class="row login-content">
                <div class="col-sm-6 col-xs-6 box">
                    <div class="entry-order-content">
                        <div class="errmsg"><?php echo $errormsg; ?></div>
                        <div class="successmsg"><?php echo $successmsg; ?></div>
                        <form id="loginform" name="loginform" method="post" action="">
                                <div class="wpc-content log-sub-text">
                                	<i>Please enter your username or email.</i>
                                    <input name="user_name" id="user_name" placeholder="User Name" class="txt-box" type="text" >                                    
                                </div>                                
                                <div class="cl"></div>
                                <input name="login_submit" class="next1 action-button" value="SEND" type="submit">
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
        },
        submitHandler: function (form) { 
            //alert('valid form submitted'); 
            return true; // for demo
        }
    });

});  
</script>
