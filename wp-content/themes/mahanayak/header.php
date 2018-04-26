<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
      <title>Mahanayak</title>      
      <!-- Favicon -->
      <link rel="shortcut icon" type="<?php echo get_template_directory_uri(); ?>/image/x-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png"/>
      <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css'>
      <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/remodal.css">
      <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/remodal-default-theme.css">
      <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/w3.css">
      <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.mCustomScrollbar.css">
      <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/packages.min.css">
      <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/default.css">
      <script src='<?php echo get_template_directory_uri(); ?>/js/jquery-2.2.4.min.js'></script>
      <?php wp_head(); ?>
   </head>
   <body class="sticky-menu">
      <div id="loader">
         <div class="loader-ring">
            <div class="loader-ring-light"></div>
            <div class="loader-ring-track"></div>
         </div>
      </div>
      <header id="header" class="menu-top-left">
         <div class="container">
            <div class="row">
               <div class="col-md-6 col-sm-4 col-xs-4">
                  <a href="<?php echo site_url(); ?>" id="logo" title="Tenguu" class="logo-image-white" data-bg-image="<?php echo get_template_directory_uri(); ?>/images/logo.png" style="background-image: url(&quot;<?php echo get_template_directory_uri(); ?>/images/logo.png&quot;);">Tenguu
                  </a>
               </div>
               <div class="col-md-5 col-md-offset-1 col-sm-8 col-xs-8 phl0">
                  <?php if(!is_user_logged_in()) {?>
                  <div class="header_author">
                     <a href="<?php echo site_url(); ?>/registration">Welcome guest</a>
                     <img src="<?php echo get_template_directory_uri(); ?>/images/user.png" class="user" alt="user">
                  </div>
                  <?php } else { 
                      
                      global $current_user;
                      get_currentuserinfo();
                      
                      /*echo "<pre>";
                      print_r($current_user);
                      echo "</pre>";                      
                      echo "<br>";*/ 
                      
                      /*echo 'Username: ' . $current_user->user_login . "\n";
                      echo 'User email: ' . $current_user->user_email . "\n";
                      echo 'User level: ' . $current_user->user_level . "\n";
                      echo 'User first name: ' . $current_user->user_firstname . "\n";
                      echo 'User last name: ' . $current_user->user_lastname . "\n";
                      echo 'User display name: ' . $current_user->display_name . "\n";
                      echo 'User ID: ' . $current_user->ID . "\n";*/
                      
                      
                  ?>
                  <div class="header_author">
                     <a href="<?php echo site_url().'/profile'; ?>"><?php echo $current_user->user_firstname.' '.$current_user->user_lastname; ?></a>
                     <img src="<?php echo get_template_directory_uri(); ?>/images/user.png" class="user" alt="user">
                  </div>
                  <?php } ?>
                  
                  <?php if(!is_user_logged_in()) {?>
                  <div class="header_ticket">
                     <a href="<?php echo site_url(); ?>/login">LOGIN</a>
                  </div>
                  <div class="header_ticket">
                     <a href="<?php echo site_url(); ?>/registration">REGISTER</a>
                  </div>
                  <?php } else { ?>
                  <div class="header_ticket">
                     <a href="<?php echo wp_logout_url( site_url().'/login' ); ?>">LOGOUT</a>
                  </div>
                  <?php /*<div class="header_ticket">
                     <a href="<?php echo site_url(); ?>/profile">PROFILE</a>
                  </div>*/ ?>
                  <?php } ?>
                  <div class="button_container" id="toggle">
                     <span class="top"></span>
                     <span class="middle"></span>
                     <span class="bottom"></span>
                  </div>
                  <div class="overlay" id="overlay">
                     <a href="javascript:;" class="close-window"></a>
                     <nav class="overlay-menu">                     
                     <?php 
                      $args = array( 'menu' => 'Main Menu','echo' => false);
                      echo wp_nav_menu($args);
                     ?>                     
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <?php if(is_front_page()) {?>
      <div class="fullwidth-slider">
      <div id="headerslider" class="carousel slide">
         <div class="carousel-inner" role="listbox">
            <div class="item active">
               <div class="fill" data-bg-image="<?php echo get_template_directory_uri(); ?>/images/unknown/banner4.png">
                  <div class="bs-slider-overlay"></div>
                  <div class="container movie-slider-container">
                     <div class="row">
                        <div class="col-sm-12 movie-slider-content">
                           <div class="slider-content" >
                              <div class="slide_right" data-animation="animated bounceInRight">
                                 <div class="dv1"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="" /></div>
                                 <div class="dv2">
                                    <h2>UTTAM KUMAR</h2>
                                    <p>The Legend of Bengali Cinema</p>
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Controls -->
         </div>
      </div>
    <?php } ?>