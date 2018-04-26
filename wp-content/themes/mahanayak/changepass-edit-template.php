<?php
/*
* Template Name: Change Password
*/
/*
 * if user allready logged in then
 * redirect this user to profile page.
 */
logged_in_user_checking(TRUE,site_url());

if(isset($_REQUEST["submit_password"]))
{
    
    $pass=$_POST["old_pass"];
    $user = get_user_by( 'login', $current_user->user_login );
    if ( $user && wp_check_password( $pass, $user->data->user_pass, $user->ID) )
    {
        if(strlen($_POST["new_pass"])>4)
        {
            if($_POST["new_pass"]==$_POST["con_pass"])
            {
                $password = $_POST["new_pass"];
                wp_set_password( $password, $current_user->ID );
                header('Location: '.site_url());
            }
            else 
            {
                $allerror = "Password does not match.";
            }
        }
        else 
        {
            $allerror = "New password is wrong (5 charecter min).".strlen($_POST["new_pass"]);
        }
            
            
    }
    else
    {
        $allerror = "Old password is wrong.";
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
                <h1 class="blog-title">Change Password</h1>
            </div>
        <div class="row"> 
            <div class="ma-login">
            <div class="row login-content">
                <div class="col-sm-7 col-xs-12">
                    <div class="entry-order-content">
                     <div class="errmsg"><?php echo $allerror; ?></div>
                     <div class="successmsg"><?php echo $allsuccess; ?></div>
                        <form id="msform" name="msform" method="post" action="">
                                <div class="wpc-content log-sub-text">
                                  <i>New password must be at least five characters long.</i>
                                	<input  placeholder="Old Password" class="txt-box" type="password" name="old_pass" id="old_pass">
                                    <input  placeholder="New Password" class="txt-box" type="password" name="new_pass" id="new_pass">
                                    <input  placeholder="Confirm Password" class="txt-box" type="password" name="con_pass" id="con_pass">                                                            
                                </div>
                                <div class="cl"></div>
                                <input name="submit_password" class="next123 action-button" value="UPDATE" type="submit">
                        </form>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-12 log-rh-cont">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div> 
</section>
<script>
$(document).ready(function () {

});  
</script>
<?php get_footer();