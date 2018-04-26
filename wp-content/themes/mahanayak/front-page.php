<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<section class="section-content" data-bg-image="<?php echo get_template_directory_uri(); ?>/images/coming-bg.jpg">
   <!-- start MOVIES COLLECTION -->
   <?php 
   /*
    * display all the active movie
    */
   $query = new WP_Query( array( 'post_type' => 'movie', 'posts_per_page'=> -1 ) );
   ?>
   <div class="container-fluid pv11 container ">
      <div class="row">
         <div class="col-sm-12">
            <h3 class="heading text-center">MOVIES COLLECTION</h3>
            <div id="carousel_coming" class="flexslider">
               <ul class="slides">
               
                <?php                
                if(!empty($query))
                {	  
                  foreach($query->posts as $movie)
                    {
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $movie->ID ), 'full' );
                ?>
                  <li class="thumb_item bg-cover">
                     <div class="m-coll">
                        <img src="<?php echo $image[0]; ?>" alt="<?php echo $movie->post_title; ?>"/>
                        <a href="<?php echo $movie->post_content; ?>" id="<?php echo $movie->ID; ?>"  class="youtybe_player" data-video-id="202177974"><i class="fa fa-play"></i></a>
                         
                     </div>
                  </li>  
                                  
                <?php 
                    }
                } 
                ?> 
                  
               </ul>
            </div>
            <?php /*<!--Start Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                        
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header" style="padding:35px 50px;">
  
</div>
<div class="modal-body" style="padding:40px 50px;">
      <iframe  width="420" id="iframeclass" height="315"
src="">
</iframe>
    </div>
    <div class="modal-footer">
      
    </div>
  </div>
  
</div>
</div> 
<!-- end modal -->*/  ?>
         </div>
      </div>
   </div>
   <!-- end MOVIES COLLECTION -->
   <div class="fullscreen-section bg-black pvb0">
      <div class="container wpc-boxoffice pvb40">
         <div class="row">
            <div class="col-sm-7 col-xs-12">
               <h3>SONG COLLECTION</h3>
                <?php 
                /*
                * display all the active songs
                */
                $query = new WP_Query( array( 'post_type' => 'song','posts_per_page'=> 5 ) );
                ?>
               <ul class="wpc-box-list">
               
               <?php                
                if(!empty($query))
                {	  
                  foreach($query->posts as $song)
                    {
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $song->ID ), array(30,30) );
                        $strFile = get_post_meta($song -> ID, $key = 'mp3_file', true);
                        $terms = get_the_terms( $song -> ID, 'song-category' );  
                        $movie_name = get_post_meta($song -> ID, $key = 'movie_name', true);
                        /*echo "<pre>";
                        print_r($terms);
                        echo "</pre>";*/
                        $songcat = array();
                        foreach($terms as $songCategory)
                        {
                            $songcat[] = $songCategory->name;
                        }
                        
                ?>               
               
                  <li class="wpc-box-item" >
                     <ol>
                        <li class="bx-item-t">
                        <?php if(!empty($image[0])) {?>
                         <img src="<?php echo $image[0]; ?>" alt="<?php echo $song->post_title; ?>">
                        <?php }else{ ?> 
                         <img src="<?php echo get_template_directory_uri(); ?>/images/poster/poster-1(58X87).jpg" alt="<?php echo $song->post_title; ?>">
                        <?php } ?>
                        </li>
                        <li class="bx-item-c"></li>
                        <li class="bx-item-title">
                           <h4><?php echo $song->post_title; ?></h4>
                           <span><?php echo $movie_name; ?></span>
                        </li>
                        <li class="bx-item-d">
                           <?php /*<button type="button" id="button_play" class="btn btn-pl" onclick='buttonPlayPress()'>
                           <i class="fa fa-play"></i>
                           </button>
                           <button type="button" id="button_stop" class="btn btn-pl" onclick='buttonStopPress()'>
                           <i class="fa fa-stop"></i>
                           </button>*/                
                           echo do_shortcode('[sc_embed_player fileurl="'.$strFile.'"]');
                           ?> 
                        </li>
                     </ol>
                  </li>
                  
               <?php } }else{ echo "<li>No Result Found</li>"; } ?>                     
               </ul>
               <a href="<?php echo site_url()."/song"; ?>" class="btn-vew">View All</a>
            </div>
            <div class="col-sm-5 col-xs-12 ">
               <?php 
                /*
                * display all the active testimonial
                */
               $query = new WP_Query( array( 'post_type' => 'testimonial','posts_per_page'=> -1 ) );
                ?>	
               <h3>testimonials</h3>
               <div class="wpc-testimonails">
                  <div class="swiper-container carousel-container">
                     <div class="swiper-wrapper">
                     	<?php                
                            if(!empty($query))
                            {	  
                                foreach($query->posts as $testimonial)
                                {
                                    
                                    /*echo "<pre>";
                                    print_r($testimonial);
                                    echo "</pre>";*/
                                    $author_id=$testimonial->post_author; 
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $song->ID ), array(50,50) );
                                    
                        ?>
                        <div class="swiper-slide">
                           <div class="testimonial">
                              <?php if(empty($image[0])) {?>
                              <img src="<?php echo get_template_directory_uri(); ?>/images/post-thumb.jpg" alt="<?php echo $testimonial->post_title; ?>" class="tes-img">
                              <?php } else { ?>
                              <img src="<?php echo $image[0]; ?>" alt="<?php echo $testimonial->post_title; ?>" class="tes-img">
                              <?php } ?>
                              <div class="entry-meta">
                                 <h4><?php echo $testimonial->post_title; ?></h4>
                              </div>
                              <p>
                                 <?php echo $testimonial->post_content; ?>
                              </p>
                           </div>
                        </div>
                        <?php }}else{ echo "No result found"; } ?>
                     </div>
                     <div class="swiper-pagination"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container mt3 mb5">
			<?php 
            /*
            * display all the active event
            */
			$query = new WP_Query( array( 'post_type' => 'event','posts_per_page'=> 3 ) );
            ?>
      <h3 class="heading text-center mb5">Events</h3>
      <div class="index-eve fl">
         <ul>
         
         <?php                
         if(!empty($query->posts))
                            {	  
                                foreach($query->posts as $event)
                                {
                                    
                                    /*echo "<pre>";
                                    print_r($testimonial);
                                    echo "</pre>";*/
                                    $author_id=$event->post_author; 
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), array(50,50) );
                                    $startDate = get_post_meta( $event->ID, 'event_start_date', true );
                                    $endDate = get_post_meta( $event->ID, 'event_end_date', true );
                        ?>
                     
             <li class="col-sm-4 col-xs-12">
               <span class="border fl">
                  <div class="in-eve-left mt2">
                  	 <?php if(empty($image[0])) {?>	
                     <img src="<?php echo get_template_directory_uri(); ?>/images/poster/poster-4.jpg" alt="">
                     <?php } else { ?>
                     <img src="<?php echo $image[0]; ?>" alt="<?php echo $event->post_title; ?>">
                     <?php } ?>
                  </div>
                  <div class="in-eve-right mt2">
                     <h2 class="host-title"><?php echo $event->post_title; ?></h2>
                     <p class="host-name"><?php the_author_meta( 'user_nicename' , $author_id ); ?></p>
                     <div class="row">
                        <div class="col-xs-12">
                           <div>Start from Date</div>
                           <div class="time-box fl"><?php echo date('d / m / Y',strtotime($startDate)); ?></div>
                        </div>
                        <div class="col-xs-12 mt1 mb2">
                           <div>End Date</div>
                           <div class="time-box fl"><?php echo date('d / m / Y',strtotime($endDate)); ?></div>
                        </div>
                     </div>
                  </div>
               </span>
            </li>
             <?php }}else{ echo "<li>No result found</li>"; } ?>
         </ul>
      </div>
      <a href="<?php echo site_url()."/event"; ?>" class="btn-vew">View All</a>
   </div>
   <div class="container mt3 mb5">
	<?php 
    /*
    * display all the active gallery
    */
	$query = new WP_Query( array( 'post_type' => 'gallery','posts_per_page'=> 5 ) );
    ?>
      <h3 class="heading text-center mb5">GALLERY</h3>
      <div class="gla">
         <ul>
         <?php			
			$args = array(
			'post_type' => 'gallery',
			'posts_per_page' => 3
			);
			$query = new WP_Query( $args );
			/*echo "<pre>";
			print_r($query);
			echo "</pre>";*/
			if(!empty($query->posts))
			{	  
			    foreach($query->posts as $gallery)
			{
			    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $gallery->ID ), 'thumbnail' );
			    $fullimage = wp_get_attachment_image_src( get_post_thumbnail_id( $gallery->ID ), 'full' );
			    $author_id=$gallery->post_author;
			    $comments_count = wp_count_comments($gallery->ID);
			    $tot_comments = $comments_count->total_comments;
			       
			?>
            <li class="col-xs-6 col-sm-6 col-lg-3">
               <div class="gla-img">
                  <a href="#modal<?php echo $gallery->ID; ?>"><img src="<?php echo $image[0]; ?>" alt="<?php echo $gallery->post_title; ?>"></a>
               </div>
            <!-- start modal--->
            <div class="remodal" data-remodal-id="modal<?php echo $gallery->ID; ?>" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
            <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
            <div class="all-remo">
               <p id="modal1Desc">
               <div class="col-sm-7 ph1 col-sm-12">
                  <div class="w3-content w3-display-container">
                     <div class="w3-lft-img">
                        <img class="mySlides111" src="<?php echo $fullimage[0]; ?>">                        
                     </div>
                  </div>
               </div>
               <div id="content-1" class="content">
                  <div class="pop-cmm">
                     <div class="comment-avatar">
                        <?php echo get_avatar( $author_id, 32 );  ?>
                        <?php /*<img alt="Image" src="<?php echo get_template_directory_uri(); ?>/images/author.png" class="avatar">*/ ?>
                        <a href="<?php echo site_url(); ?>" class="comment-name"><?php echo get_the_author_meta( 'first_name' , $author_id )." ".get_the_author_meta( 'last_name' , $author_id ); ?></a>
                        <span><?php echo date('d M Y',strtotime($gallery->post_date)); ?></span>
                     </div>
                  </div>
                  <div class="cmm-up-box">
                     <?php echo get_avatar( $author_id, 32 );  ?>
                     <?php /*<img alt="Image" src="<?php echo get_template_directory_uri(); ?>/images/author.png" class="avatar">*/ ?>
                     <p class="up-box-text">
                       <?php echo $gallery->post_content; ?>
                     </p>
                     <div class="share-box">                        
                        <span><i class="fa fa-comment-o"></i><?php echo $tot_comments; ?></span>
                        <span><?php echo do_shortcode('[WPLIKE post_id="'.$gallery->ID.'"]'); ?></span>                     
                     </div>
                  </div>
                  <?php
				$args = array(					
				    'post_id' => $gallery->ID, // use post_id, not post_ID
				);
				$comments = get_comments($args);
				foreach($comments as $comment) :  
				?>
                  <div class="cmm-up-box">
                  	<?php echo get_avatar( $comments->user_id, 32 );  ?>                     
                     <p class="up-box-text">
                        <?php echo $comment->comment_content; ?>
                     </p>
                     <!-- <div class="share-box">                        
                        <span><i class="fa fa-comment-o"></i>11</span>
                        <span><i class="fa fa-thumbs-o-up"></i>14</span>
                     </div>-->
                  </div>
                <?php endforeach; ?>  
                  <div class="pop-cmm-box">
                     <?php echo get_avatar( $current_user->ID, 32 );  ?>
                     <?php
                     $fields =  array(
                         
                         'author' =>
                         '<div class="col-md-6"><div class="form-group"><label class="ui-form__label">' . __( 'Your Name', 'domainreference' ) .
                         ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
                         '<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                         '" size="30"' . $aria_req . ' /></div></div>',
                         
                         'email' =>
                         '<div class="col-md-6"><div class="form-group"><label class="ui-form__label">' . __( 'Email address', 'domainreference' ) .
                         ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
                         '<input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                         '" size="30"' . $aria_req . ' /></div></div>',
                         
                         
                     );
                     
                     $comments_args = array(
                         'id_form'           => 'commentform',
                         'class_form'      => 'comment-form',
                         'id_submit'         => 'submit',
                         'class_submit'      => 'submit btn btn-lg btn-info btn-effect',
                         'name_submit'       => 'submit',
                         'title_reply'       => __( '' ),
                         'title_reply_to'    => __( '' ),
                         'cancel_reply_link' => __( 'Cancel Reply' ),
                         'label_submit'      => __( 'Post Comment' ),
                         'format'            => 'xhtml',
                         
                         'comment_field' =>  '<textarea id="comment" name="comment" class="cmm-box rs-size" >' .
                         '</textarea>',
                         
                         'must_log_in' => '<p class="must-log-in">' .
                         sprintf(
                             __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                             wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
                             ) . '</p>',
                         
                         'logged_in_as' => '',
                         
                         'comment_notes_before' => '',
                         
                         'comment_notes_after' => '',
                         
                         'fields' => apply_filters( 'comment_form_default_fields', $fields ),
                     );
                     
                     comment_form($comments_args, $gallery->ID);
                     
                     ?>
                     <!--<textarea class="cmm-box rs-size" placeholder="Write a comment....."></textarea>-->
                  </div>
               </div>
               </p>
            </div>
         </div>
            <!-- end modal -->
            </li>            
         <?php }}else { echo "<li>No result found.</li>"; } ?>            
         </ul>
         
         <div class="cl"></div>
         
      </div>
      <a href="<?php echo site_url()."/gallery"; ?>" class="btn-vew">View All</a>
   </div>
   <section class="section-content  bg-cover" data-bg-image="<?php echo get_template_directory_uri(); ?>/images/coming-bg.jpg">
      <div class="container">
         <div class="row">
            <div class="col-sm-12 page-title mb5">
               <h2>FAN'S CLUB</h2>
            </div>
         </div>
      </div>
      <div class="container mt4">
         <div class="row">
            <div class="col-sm-8 col-xs-12 pl0">
               <div class="blog-container">
                <?php			
                $args = array(
                'post_type' => 'fans-club',
                'posts_per_page' => 5,                	
                );
                $queryfans = new WP_Query( $args );
                /*echo "<pre>";
                print_r($query);
                echo "</pre>";*/
                if(!empty($queryfans->posts))
                {	  
                foreach($queryfans->posts as $fans)
                {
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $fans->ID ), 'thumbnail' );
                    $author_id=$fans->post_author; 
                    $comments_count = wp_count_comments();
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
                        <div class="post-content">
                           <div class="entry-meta">
                              <ul class="category">
                                 <li><a href="<?php echo get_the_permalink($fans->ID); ?>"><?php the_author_meta( 'user_nicename' , $author_id ); ?></a></li>
                                 <li><a href="<?php echo get_the_permalink($fans->ID); ?>"><?php echo date('d M Y',strtotime($fans->post_date)); ?></a></li>                                 
                              </ul>
                              <div class="social-links">
                                 <a href="http://www.facebook.com/sharer.php?u=<?php echo get_the_permalink($fans->ID); ?>&t=<?php echo $fans->post_title; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                 <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( $fans->post_title ) ?>&amp;url=<?php echo urlencode( get_the_permalink($fans->ID) ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                 <a href="https://plus.google.com/share?url=<?php echo get_the_permalink($fans->ID); ?>" target="_blank"><i class="fa fa-user"></i></a>
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
                        </div>
                     </div>
                  </article>
               <?php } } ?>    
               </div>
               <a href="<?php echo site_url()."/fans-club"; ?>" class="btn-vew">View All</a>
            </div>
            <div class="col-sm-4">
             <?php get_sidebar(); ?>
            </div>
         </div>
      </div>
   </section>
</section>
<?php get_footer();
