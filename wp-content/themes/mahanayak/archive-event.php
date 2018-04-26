<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<section class="section-content pv12 bg-cover" data-bg-image="images/coming-bg.jpg">
    <div class="container">
        
            <div class="col-sm-12 page-title mt5 mb5">
                <h1 class="blog-title">Events</h1>
            </div>
          
    
        <div class="row">
            <div class="col-sm-8 col-xs-12 pl0">
                <div class="blog-container">
                    
            <?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;  
			$args = array(
			'post_type' => 'event',
			'posts_per_page' => 3,
  			'paged'=> $paged	
			);
			$query = new WP_Query( $args );
			/*echo "<pre>";
			print_r($query);
			echo "</pre>";*/
			if(!empty($query->posts))
			{	  
			    foreach($query->posts as $event)
			{
			    $author_id=$event->post_author;
			    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'thumbnail' );
			    $startDate = get_post_meta( $event->ID, 'event_start_date', true );
			    $endDate = get_post_meta( $event->ID, 'event_end_date', true );
			    $startTime = get_post_meta( $event->ID, 'event_start_time', true );
			    $endTime = get_post_meta( $event->ID, 'event_end_time', true );
			    $hosted_by = get_post_meta( $event->ID, 'hosted_by', true );
			    $contact_number = get_post_meta( $event->ID, 'contact_number', true );
			    $contact_email = get_post_meta( $event->ID, 'contact_email', true );
			       
			?>
                    
                    <article class="blog-item pty">
                       <div class="row">
                          <div class="col-sm-4 col-xs-12 ">
                             <?php if(empty($image[0])) {?>	
                             <img src="<?php echo get_template_directory_uri(); ?>/images/poster/poster-4.jpg" alt="">
                             <?php } else { ?>
                             <img src="<?php echo $image[0]; ?>" alt="<?php echo $event->post_title; ?>">
                             <?php } ?>
                          </div>
                          <div class="col-sm-8 ml-r-15">
                             <div class="post-content pvt0">
                                <h2 class="host-title">Event's Name : <?php echo $event->post_title; ?></h2>
                                <p class="host-name">Hosted By: <?php echo $hosted_by; ?></p>
                                <div class="time-icon">
                                   <div class="row">
                                      <div class="col-sm-6">
                                         <div>Start from Date</div>
                                         <div class="time-box fl"><?php echo date('d / m / Y',strtotime($startDate)); ?></div>
                                      </div>
                                      <div class="col-sm-6">
                                         <div>End Date</div>
                                         <div class="time-box fl"><?php echo date('d / m / Y',strtotime($endDate)); ?></div>
                                      </div>
                                   </div>
                                   <div class="row mt2">
                                      <div class="col-sm-6">
                                         <div>Start Time</div>
                                         <div class="time-box fl"><?php echo $startTime; ?></div>
                                      </div>
                                      <div class="col-sm-6">
                                         <div>End Time</div>
                                         <div class="time-box fl"><?php echo $endTime; ?></div>
                                      </div>
                                   </div>
                                   <hr>
                                </div>
                                <div class="time-icon mt1">
                                   <div class="venue">Venue</div>
                                   <span class="wt-80 fl"><?php echo $event->post_content; ?></span>
                                   <a href="#rat-popup<?php echo $event->ID; ?>" class="btn-vew">Show Map</a>
                                   <div id="rat-popup<?php echo $event->ID; ?>" class="rat-overlay">
                                      <div class="add-rat-pop">
                                         <a class="close" href="#">&times;</a>
                                         <div class="rat-pop-hed"><?php echo $event->post_title; ?> : Venu Map</div>
                                         <div class="mh_map">
                                            <?php echo do_shortcode('[google_map]'.$event->post_content.'[/google_map]'); ?>
                                            <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.540376422057!2d88.36133751458274!3d22.59628758517061!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a02763326bbc663%3A0xb32f8b4a2add00e5!2s151%2C+BK+Paul+Ave+Rd%2C+Sovabazar%2C+Shobhabazar%2C+Kolkata%2C+West+Bengal+700005!5e0!3m2!1sen!2sin!4v1517561915674" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe>-->
                                         </div>
                                         <div class="clearfix"></div>
                                      </div>
                                   </div>
                                </div>
                                <div class="time-icon mt3">
                                   <span class="fl"><i class="fa fa-phone"></i></span>
                                   <span class="fl">Contact No: <a href="tel:<?php echo $contact_number; ?>"><?php echo $contact_number; ?></a></span>
                                </div>
                                <div class="time-icon mt1">
                                   <span class="fl"><i class="fa fa-envelope-o"></i></span>
                                   <span class="fl">E-mail: <a href="mauilto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a></span>
                                </div>
                             </div>
                          </div>
                       </div>
                    </article>

         <?php }}else { echo "<article>No result found.</article>"; } ?>           
                    
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
        <div class="col-sm-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
    </div>
</section>

<?php get_footer();

