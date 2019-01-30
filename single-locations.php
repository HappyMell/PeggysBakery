<?php


get_header();

while(have_posts()) {
    the_post(); 
    pageBanner();
    ?>

  
    <div class="container page-section">
    

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