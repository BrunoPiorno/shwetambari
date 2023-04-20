<?php /* Template Name: Stories */ ?>
<?php get_header(); ?>

<section class="stories-page">

    <div class="stories-page__cont">
        <div class="container">    
            <?php if ($story_text = get_field('story_text')): ?>
                <h1 class="stories-page__story_text"><?php echo $story_text ?></h1>
            <?php endif; ?>
            <div class="stories-page__cont--grid">
                <?php $query = new WP_Query(array(
                    'post_type' => 'stories', 
                    'posts_per_page' => -1, 
                    'post_status' => 'publish', 
                    'orderby' => 'date', 
                    'order' => 'DESC',
                ));?>
        
                <?php if( $query->have_posts() ): ?>
                    <?php  while( $query->have_posts() ): $query->the_post();  ?>
                    <?php $read_more = get_field('read_more'); ?>
                        <?php if($external_resource = get_field('external_resource')): ?>
                            <div class="stories-page__item">
                                <a href="<?php echo $read_more['url']; ?>" target="<?php echo $read_more['target']; ?>" class="stories-page__item__title"><p><?php the_title(); ?></p></a> 
                                <a href="<?php echo $read_more['url']; ?>" target="<?php echo $read_more['target']; ?>" class="stories-page__item__text">
                                    <?php if ($text_post = get_field('text_post')): ?>
                                        <?php echo $text_post ?>
                                        <span>|</span>
                                    <?php endif; ?>
                                    <?php if ($date_post = get_field('date_post')): ?>
                                        <p><?php echo $date_post; ?></p>
                                    <?php endif; ?>
                                </a> 
                                <a href="<?php echo $read_more['url']; ?>" target="<?php echo $read_more['target']; ?>" class="stories-page__item__image">
                                    <div class="image-background">
                                        <?php the_post_thumbnail( 'large' ); ?>
                                    </div>
                                </a>     
                                <?php if($read_more): ?>
                                    <a class="stories-page__item__read-more" href="<?php echo $read_more['url']; ?>" target="<?php echo $read_more['target']; ?>"><?php echo $read_more['title']; ?></a>
                                <?php endif; ?>                      
                            </div>  
                            

                            <?php else: ?>
                                <a class="stories-page__item" href="<?php the_permalink(); ?>"> 
                                    <div class="stories-page__item__title"><p><?php the_title(); ?></p></div> 
                                    <div class="stories-page__item__image">
                                        <div class="image-background">
                                            <?php the_post_thumbnail( 'large' ); ?>
                                        </div>
                                    </div>                         
                                </a> 
                                <a class="stories-page__item__read-more" href="<?php the_permalink(); ?>">Read More</a>
                        <?php endif; ?>
                     <?php endwhile;  ?>   
                <?php endif; ?> 
            </div>
        </div>       
    </div>
</section>

<?php get_footer(); ?>