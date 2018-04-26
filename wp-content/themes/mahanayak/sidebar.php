<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>
    <div class="sidebar">
        <div class="widget">
            <div class="add-img">
                <img src="<?php echo get_template_directory_uri(); ?>/images/poster/add-banner1.jpg" alt="image">
            </div>
            <h5 class="widget-title">Recent Fan's Club Posts</h5>
            <?php
			
			$args = array(
			'post_type' => 'fans-club',
			'posts_per_page' => 4,  				
			);
			$querysidebar = new WP_Query( $args );
			
			?>
            <ul class="recent-posts">
            <?php             
            if(!empty($querysidebar->posts))
            {
                foreach($querysidebar->posts as $blog)
                {
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $blog->ID ), array(75, 75) );
            ?>
                <li>
                	<?php if(!empty($image[0])) { ?>
                    <a href="<?php echo get_the_permalink($blog->ID); ?>" class="rp-media">
						<img src="<?php echo $image[0]; ?>" alt="<?php echo $blog->post_title; ?>">
					</a>
					<?php } else { ?>
					<a href="<?php echo get_the_permalink($blog->ID); ?>" class="rp-media">
						<img src="<?php echo get_template_directory_uri(); ?>/images/post-thumb.jpg" alt="<?php echo $blog->post_title; ?>">
					</a>
					<?php }?>
                    <div class="rp-info">
                        <a href="<?php echo get_the_permalink($blog->ID); ?>" class="link-post"><?php echo $blog->post_title; ?></a>
                        <p class="mb0"><?php echo substr($blog->post_content,0,100); ?>....</p>                        
                        <a href="<?php echo get_the_permalink($blog->ID); ?>"><?php echo date('d M Y',strtotime($blog->post_date)); ?></a>
                    </div>
                </li>
            <?php }} ?>    
              
            </ul>
            <h5 class="widget-title">Events</h5>
            <?php
			
			$args = array(
			'post_type' => 'event',
			'posts_per_page' => 4,  				
			);
			$querysidebarevent = new WP_Query( $args );
			
			?>
            <ul class="recent-posts">
            
            <?php             
            if(!empty($querysidebarevent->posts))
            {
                foreach($querysidebarevent->posts as $event)
                {
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), array(75, 75) );
                    $startDate = get_post_meta( $event->ID, 'event_start_date', true );
                    $endDate = get_post_meta( $event->ID, 'event_end_date', true );
                    $startTime = get_post_meta( $event->ID, 'event_start_time', true );
                    $endTime = get_post_meta( $event->ID, 'event_end_time', true );
                    $hosted_by = get_post_meta( $event->ID, 'hosted_by', true );
                    $contact_number = get_post_meta( $event->ID, 'contact_number', true );
                    $contact_email = get_post_meta( $event->ID, 'contact_email', true );
            ?>
            
                <li>
                    <?php if(!empty($image[0])) { ?>
                    
						<img src="<?php echo $image[0]; ?>" alt="<?php echo $event->post_title; ?>">
					
					<?php } else { ?>
					
						<img src="<?php echo get_template_directory_uri(); ?>/images/post-thumb.jpg" alt="<?php echo $event->post_title; ?>">
					
					<?php }?>
                    <div class="rp-info">
                        <?php echo $event->post_title; ?>
                        <p class="mb0"><?php echo $event->post_content; ?>
                        </p>
                        <?php echo date('d / m / Y',strtotime($startDate)); ?> - <?php echo date('d / m / Y',strtotime($endDate)); ?>
                    </div>
                </li>
            <?php }} ?>      
                
            </ul>
        </div>
    </div>