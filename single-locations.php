<?php


get_header();

while(have_posts()) {
    the_post(); 
    pageBanner();
    ?>

  
    <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('locations') ?>">
            <i class="fa fa-home" aria-hidden="true"></i>All Locations</a> 
            <span class="metabox__main"><?php the_title(); ?></span></p>
          </div>

    <div class="generic-content">
        <?php the_content();?></div>

        <?php 
        $mapLocation = get_field('locations');
        ?>

            <div class="acf-map">
               
            <div class="marker" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'];?>">
            <h3><?php the_title();?></h3>
            <?php echo $mapLocation['address'];?>
            </div>
        
            </div>
    </div>
<?php } 

get_footer();

?>