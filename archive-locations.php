<?php

get_header();
pageBanner(array(
  'title' => 'Our Locations',
  'subtitle' => 'We have several locations all around London, take a look around!'
));
 ?>

<div class="container page-section">



<div class="acf-map">

<?php
  while(have_posts()) {
    the_post();
    $mapLocation = get_field('locations');
   ?>
    <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <?php echo $mapLocation['address']; ?>
    </div>
  <?php } ?>
</div>

<div class="container page-section">
    <ul class="box-list">
  <?php 
  
  while(have_posts()) {
    the_post(); ?>
    
   <div class=box> 
    <li>
        <a href="<?php the_permalink(); ?>"><?php the_title();?>
  </a></li>
  </div>
  <?php }

    echo paginate_links();

  ?>
 
  </ul>

</div>

<?php get_footer();

?>