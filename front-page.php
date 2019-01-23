<?php get_header(); ?>

<!-- Heading page banner-->
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/pbakery.jpg')?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large">Welcome!</h1>
      <h2 class="headline headline--medium">Come see what's baking</h2>
      <h3 class="headline headline--small">Check out what's in the oven</h3>
      <a href="<?php echo get_post_type_archive_link('bakes');?>" class="btn btn--large btn--pink"><i class="fa fa-birthday-cake"></i></a>
    </div>
  </div>




<!-- Hero Slider -->

 <div class="hero-slider">
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/shelfcupcake.jpg')?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Large collection of cup cakes</h2>
        <p class="t-center">Over 20 combinations of cup cakes, filling and frosting, custom made just for you!</p>
        <p class="t-center no-margin"><a href="<?php echo site_url('/bakes'); ?>" class="btn btn--pink">Take a look</a></p>
      </div>
    </div>
  </div>
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/berrycake.jpg')?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Sweet Cakes</h2>
        <p class="t-center">Hand made cakes, made with love baked fresh daily. Best cakes in town!</p>
        <p class="t-center no-margin"><a href="<?php echo site_url('/bakes'); ?>" class="btn btn--pink">Take a look</a></p>
      </div>
    </div>
  </div>
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/cookie.jpg')?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Soft Cookies</h2>
        <p class="t-center">Like them crispy? Like them soft? We make cookies anyway you like</p>
        <p class="t-center no-margin"><a href="<?php echo site_url('/bakes'); ?>" class="btn btn--pink">Take a look</a></p>
      </div>
    </div>
  </div>
</div> 

<!-- Upcoming events left div-->
  <div class="full-width-split group">
    <div class="full-width-split__one" >
      <div class="full-width-split__inner" >
        <h2 class="headline headline--small-plus t-center">Upcoming Sales</h2>

      <!-- Page Event toggle, dates-->
          <?php

         $today = date('Ymd');

        $homePageSales = new WP_Query(array(
          'posts_per_page' => 2,
          'post_type' => 'sale',
          'meta_query' => array(
            array(
              'key' => 'sales',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            )
          ), 
          'meta_key' => 'sales',
          'orderby' => 'meta_value_num',
          'order' => 'ASC'
        ));

        while($homePageSales->have_posts()) {
              $homePageSales->the_post(); 
              get_template_part('template-parts/content', 'sale'); 



              } 
             ?> 
        
  <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('sale'); ?>" class="btn btn--pink">View All </a></p>

      </div>
    </div>

    <!-- Blog div right-->
    <div class="full-width-split__two">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">News</h2>

        <!-- Posts date and time-->
        <?php 
        
        $homePagePost = new WP_Query(array(
          'posts_per_page' => 2
        ));


            while($homePagePost->have_posts()) {
              $homePagePost->the_post(); ?>

          <div class="event-summary">
          <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink();?>">
            <span class="event-summary__month"><?php the_time('M')?></span>
            <span class="event-summary__day"><?php the_time('d')?></span>  
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h5>
            <p> 
              <!-- If post has an excerpt or not, show-->
            <?php if(has_excerpt()) {
             echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 18);
              }
              ?> 

            <a href="<?php the_permalink();?>" class="nu gray">Read more</a></p>
          </div>
        </div>
          <?php } wp_reset_postdata();
        ?>

        
        
        <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--yellow">View All News</a></p>
      </div>
    </div>
  </div>
  
</div>

<?php get_footer();?>



