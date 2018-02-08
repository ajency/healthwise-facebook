<?php 
/**
 * Homepage Posts Carosuel
 * Page Composer Section
 *
 * @package SimpleMag
 * @since 	SimpleMag 3.0
**/
?>

<section class="home-section full-width-media full-width-section posts-carousel">

    <?php
    /** 
     * Add posts to slider only if the 'Add To Slider' 
     * custom field checkbox was checked on the Post edit page
    **/
    $carousel_slides_num = get_sub_field( 'carousel_slides_to_show' );
    $ti_posts_carousel = new WP_Query(
    array(
        'meta_value' => '1',
        'post_type' => 'pledge',
        'no_found_rows' => true,
    )
    );
    ?>

    <?php if ( $ti_posts_carousel->have_posts() ) : ?>
        <div class="text-grey">You may also want to pledge for</div>
            <hr>
    
        <div class="gallery-carousel global-sliders1 content-over-image ptop">
            
            <?php while ( $ti_posts_carousel->have_posts() ) : $ti_posts_carousel->the_post(); ?>
            
                <div class="gallery-item">
                    <div class="image_box1">
                    	<figure class="entry-image">
                            <?php 
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'n' );
                            } ?>
                        </figure>
                    </div>
    				
                    <header class="entry-header">
                       <a class="entry-link" href="<?php the_permalink(); ?>"></a>
                       <div class="inner">
                           <div class="inner-cell">
                               <div class="entry-meta black-text">
                                   <span class="entry-titlex black-text">
                                 <!--   <?php 
                                    /*$data=get_the_category($post->ID);
                                    if (empty($data[0])) {
                                        echo("<span class='text-grey'>Uncategorized</span>");
                                    }
                                    else
                                    {
                                        for ($i=0;!empty($data[$i]);$i++) {
                                            if($i>0)
                                                echo "<span class='text-grey'> , </span>";
                                        echo("<span class='text-grey'>".$data[$i]->name."</span>");
                                        }
                                    }*/
                                   ?> -->
                                   </span>
                               </div>
                               <h2 class="entry-titlex black-text">
                                 <!--   <a class="black-text" href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a> -->
                                  
                               </h2>
                           </div>
                       </div>
                   </header>
                    <h2 class="entry-titlex black-text nodec">
                        <a class="black-text nodec" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                </div>
            
            
        <?php endwhile; ?>
        
        <?php wp_reset_postdata(); ?>

    </div>
    
    <?php else: ?>
        
        <p class="message">
			<?php _e( 'Sorry, there are no posts in the carousel', 'themetext' ); ?>
        </p>
         
    <?php endif; ?>

</section><!-- Posts Carousel -->