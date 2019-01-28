<?php

get_header();

while(have_posts()) {
    the_post(); 
    pageBanner();
    ?>
    

  <div class="container container--narrow page-section">

   <div class="one-third">
                <?php the_post_thumbnail('peggysPortrait');?>
            </div>
   

    <div class="generic-content">
     <?php the_content(); ?>
    </div>

  </div>

    
<?php }

get_footer();

?>