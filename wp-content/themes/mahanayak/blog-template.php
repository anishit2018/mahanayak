<?php
/*
* Template Name: Blog Post
*/
get_header(); ?>

<div class="main-wrap">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="section-blog">
		    
			<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;  
			$args = array(
			'post_type' => 'post',
			'posts_per_page' => 12,
  			'paged'=> $paged	
			);
			$query = new WP_Query( $args );
			/*echo "<pre>";
			print_r($query);
			echo "</pre>";*/
			if(!empty($query))
			{	  
			foreach($query->posts as $blog)
			{
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $blog->ID ), 'full' );
			//echo $image[0]
			$imageUrl = $image[0]; 
				
				$categories = get_the_category($blog->ID);
				/*echo "<pre>";
				print_r($categories);
				echo "</pre>";*/				
				$allcategory = array();
				if(!empty($categories))
				{
					foreach($categories as $category)
					{
						$allcategory[] = $category->name;
					}	
				}	
				
			?>  
			  
            <div class="col-md-6">
              <article class="post reveal clearfix">
                <div class="entry-media">
					<?php if(!empty($imageUrl)) {?>
					<a class="prettyPhoto" href="<?php echo $imageUrl; ?>"> <img class="img-responsive" src="<?php echo $imageUrl; ?>"  alt="<?php echo $blog->post_title; ?>"> </a> 
					<?php } ?>
				</div>
                <div class="entry-main">
                  <div class="entry-header">
                    <h2 class="entry-title"><?php echo $blog->post_title; ?></h2>
                    <div class="entry-meta"> <span class="entry-meta__item"><i class="icon pe-7s-folder"></i><?php echo implode(',',$allcategory); ?></span><br>
                      <span class="entry-meta__item"><i class="icon pe-7s-clock"></i><a class="entry-meta__link" href="<?php echo get_the_permalink($blog->ID); ?>">
                      <time class="comment-datetime"><?php echo date('d M Y',strtotime($blog->post_date)); ?></time>
                      </a></span> </div>
                  </div>
                  <div class="entry-content">
                    <p><?php echo substr($blog->post_content, 0, 100); ?>....</p>
                  </div>
                </div>
                <footer class="entry-footer clearfix">
                  <div class="col-md-6"> <a class="entry-btn btn btn-info btn-effect" href="<?php echo get_the_permalink($blog->ID); ?>">read more</a></div>
                  <div class="col-md-6">
                    <div class="social-sharing"><?php echo do_shortcode('[social_share_button]'); ?></div>
                  </div>
                </footer>
              </article>
            </div>
			  
			<?php 
			}}
			?>  
            
            
		  </div>		  
          <ul class="pagination pagination_mod-a text-center">
            <li><?php previous_posts_link( '&laquo; PREV', $query->max_num_pages) ?></li>
    		<li><?php next_posts_link( 'NEXT &raquo;', $query->max_num_pages) ?></li>
          </ul>
		  </div>
		  <div class="col-md-3">
          <?php get_sidebar(); ?>
        </div>
      </div>
    </div>
  </div>

<?php get_footer();
