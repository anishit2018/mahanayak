<?php
/*
* Template Name: Fan's club edit
*/
/*
 * if user allready logged in then
 * redirect this user to profile page.
 */
logged_in_user_checking(TRUE,site_url());
if($_REQUEST["action"]=='remove')
{
    $encrypted_id = $_GET["postId"];
    $decrypted_id_raw = base64_decode($encrypted_id);    
    $decrypted_id = intval(str_replace('MY_SECRET_STUFF', '', $decrypted_id_raw));
    wp_trash_post( $decrypted_id  );
    wp_redirect(site_url()."/fans-club-edit?action=removedone");
    //echo $decrypted_id; exit();
}
get_header(); ?>

<section class="section-content pv12 bg-cover" data-bg-image="images/coming-bg.jpg">
    <div class="container">
                 <div class="col-sm-12 page-title mt5 mb5">
                <h1 class="blog-title">Wellcome <?php echo $current_user->user_firstname.' '.$current_user->user_lastname; ?></h1>
            </div>
        <div class="row"> 
            <div class="col-sm-8 col-xs-12 pl0">
                <div class="blog-container">
                    <article class="blog-item">
                        <div class="col-sm-4 col-xs-12 ">
                            <img class="post-image" src="<?php echo get_template_directory_uri(); ?>/images/jogen.jpg">
                        </div>
                        <div class="col-sm-8 col-xs-12 ml-r-15">
                            <div class="post-content">
                                <h2 class="user-tit"><?php echo $current_user->user_firstname.' '.$current_user->user_lastname; ?></h2>
                                <p class="entry-excepts"><?php echo $current_user->user_description; ?></p>
                            </div>
                        </div>
                    </article>
                    
                    <?php 
                    if($_REQUEST["action"]=='removedone')
                    {
                        echo "<div class='successdiv'>Fan's club post has been removed successfully.</div>";
                    }
                    ?>
                    
                    <hr>

                        <div class="mh-tab mt2" id="tabs">
                            <div class="tabs-pro">
                                <a href="<?php echo site_url()."/gallery-edit"; ?>" class="tabs-pro-link col-md-3 col-xs-12">IMAGES</a>
                                <a href="<?php echo site_url()."/song-edit"; ?>" class="tabs-pro-link col-md-3 col-xs-12">MUSIC</a>
                                <a href="<?php echo site_url()."/fans-club-edit"; ?>" class="tabs-pro-link col-md-3 col-xs-12 active">FANS CLUB</a>
                                <a href="<?php echo site_url()."/profile"; ?>" class="tabs-pro-link col-md-3 col-xs-12 ">EVENTS</a>
                            </div>
                            <div class="tab-wraps" id="tabs-1">
                                <div class="tabcontents">
                                    <a href="#rat-popup" class="btn-vew"><i class="fa fa-plus"></i>Add Fan's Club Post</a>

                                    <div id="rat-popup" class="rat-overlay over-scr">
                                      <?php echo do_shortcode( '[cr_fans_form]' ); ?>
                                    </div>

                                    <div class="tab_body">
                                      <div class="row">
                                        <div class="col-xs-12 pl0">
                                         
                                         <div class="blog-container">
                
            <?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;  
			$args = array(
			'post_type' => 'fans-club',
			'posts_per_page' => 3,
			'post_status' =>  array( 'publish', 'draft'),
			'author' => $current_user->ID,
  			'paged'=> $paged	
			);
			$query = new WP_Query( $args );
			/*echo "<pre>";
			print_r($query);
			echo "</pre>";*/
			if(!empty($query->posts))
			{	  
			foreach($query->posts as $fans)
			{
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $fans->ID ), 'thumbnail' );
			//echo $image[0]
			$imageUrl = $image[0]; 
			$author_id=$fans->post_author;
			$comments_count = wp_count_comments($fans->ID);
			$tot_comments = $comments_count->total_comments;
			?>
                    
                   <article class="blog-item mt35">
                                                      <div class="col-sm-4 col-xs-12">
                                                          <?php if(!empty($image[0])) { ?>
                        <a href="<?php echo get_the_permalink($fans->ID); ?>" class="rp-media">
    						<img src="<?php echo $image[0]; ?>" alt="<?php echo $fans->post_title; ?>">
    					</a>
    					<?php } else { ?>
    					<a href="<?php echo get_the_permalink($fans->ID); ?>" class="rp-media">
    						<img src="<?php echo get_template_directory_uri(); ?>/images/post-thumb.jpg" alt="<?php echo $fans->post_title; ?>">
    					</a>
    					<?php }?>
                                                      </div>
                                                      <div class="col-sm-8 ml-r-15">
                                                          <div class="overlay bg-cover" data-bg-image="images/blog/post-3.jpg"> </div>
                                                          <div class="post-content">
                                                          <div class="entry-meta">
                                                              <ul class="category">
                                                                  <li><?php the_author_meta( 'user_nicename' , $author_id ); ?></li>
                                 								  <li><?php echo date('d M Y',strtotime($fans->post_date)); ?></li>     
                                                              </ul> 
                                                              <div class="social-links">
                                                                  <div class="social-links">
                                                                     <a href="http://www.facebook.com/sharer.php?u=<?php echo get_the_permalink($fans->ID); ?>&t=<?php echo $fans->post_title; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                                                     <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $fans->post_title ) ?>&amp;url=<?php echo urlencode( get_the_permalink($fans->ID) ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                                                     <a href="https://plus.google.com/share?url=<?php echo get_the_permalink($fans->ID); ?>" target="_blank"><i class="fa fa-user"></i></a>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                              <h2 class="entry-title"><a href="<?php echo get_the_permalink($fans->ID); ?>"><?php echo $fans->post_title; ?></a>
                           </h2>
                           <p class="entry-excepts"><?php  echo substr($fans->post_content,0,100); ?></p>
                           <a href="<?php echo get_the_permalink($fans->ID); ?>" class="btn more mt1"> Read more</a>
                           <div class="social-icon mt1">
                              <span><?php echo do_shortcode('[WPLIKE post_id="'.$fans->ID.'"]'); ?></span>
                              <span><i class="fa fa-comment-o"></i><?php echo $tot_comments; ?></span>
                           </div>
                           <div style="clear:both;"></div>
                                   <?php 
                                   $salt="MY_SECRET_STUFF";
                                   $encrypted_id = base64_encode($fans->ID . $salt);
                                   ?>
                                   <span class="poststatus"><?php echo $fans->post_status; ?></span><a href="<?php echo site_url()."/edit?action=remove&postId=".$encrypted_id; ?>" class="btn-vew">Edit</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url()."/fans-club-edit?action=remove&postId=".$encrypted_id; ?>" class="btn-vew" onclick="return confirm('Are you sure to remove <?php echo $fans->post_title; ?> ?')">Remove</a>
                                                          </div>
                                                      </div>
                                                  </article> 
                    
              <?php }}else { echo "<div class='noresult'>No result found.</div>"; } ?>      
                    
                </div>
                <?php if(!empty($query->posts)) { ?>
                <div class="post-navigation mv3">
                    <ul>
                        <li><?php previous_posts_link( '&laquo; PREV', $query->max_num_pages) ?></li>
    					<li><?php next_posts_link( 'NEXT &raquo;', $query->max_num_pages) ?></li>
                    </ul>
                </div>
                <?php } ?>
                                         
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                </div>
            </div>
        <div class="col-sm-4">
            <?php get_sidebar(); ?>
        </div>
</div> 
</section>
<?php get_footer();
?>
<script>
$(document).ready(function () {

	$( "#tabs" ).tabs();

    $('#frmevent').validate({ // initialize the plugin        
        rules: {
        	event_name: {
                required: true,
                //email: true
            },
            hosted_by: {
                required: true,
                //minlength: 5
            },
            start_from_date: {
                required: true,
                //minlength: 5
            },
            end_from_date: {
                required: true,
                //minlength: 5
            },
            start_time: {
                required: true,
                //minlength: 5
            },
            end_time: {
                required: true,
                //minlength: 5
            },
            venue: {
                required: true,
                //minlength: 5
            },
            contact_name: {
                required: true,
                //minlength: 5
            }, 
            contact_number: {
                required: true,
                //minlength: 5
            },
            contact_email: {
                required: true,
                //minlength: 5
            },
            event_file: {
                required: true,
                extension: "jpg|jpeg|png"
            },
        },
        submitHandler: function (form) { 
            //alert('valid form submitted'); 
            return true; // for demo
        }
    });

    $('#frmfans').validate({ // initialize the plugin        
        rules: {
        	fans_title: {
                required: true,
                //email: true
            },
            fans_content: {
                required: true,
                //email: true
            },  
            fans_file: {
                required: true,
                //email: true
            },          
        },
        submitHandler: function (form) { 
            //alert('valid form submitted'); 
            return true; // for demo
        }
    });

    $('#frmgallery').validate({ // initialize the plugin        
        rules: {
        	image_title: {
                required: true,
                //email: true
            },             
            image_file: {
                required: true,
                //email: true
            },          
        },
        submitHandler: function (form) { 
            //alert('valid form submitted'); 
            return true; // for demo
        }
    });

    $('#frmsong').validate({ // initialize the plugin        
        rules: {
        	music_title: {
                required: true,
                //email: true
            },             
            movie_name: {
                required: true,
                //email: true
            },          
        },
        submitHandler: function (form) { 
            //alert('valid form submitted'); 
            return true; // for demo
        }
    });

    

    $(".close").click(function(){
    	//location.reload();
    });

    
    function delConfirm() {
        var txt;
        if (confirm("Press a button!")) {
            return true;
        } else {
        	return false;
        }        
    }
    

});  
</script>
