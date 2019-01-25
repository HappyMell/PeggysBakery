<?php 
get_header(); 
pageBanner(array(
  'title' => 'All Sales',
  'subtitle' => 'Always new sales, keep checking back!'
));
?>




<div class="container container--narrow page-section">
  <?php 
  
  while(have_posts()) {
    the_post(); 
    get_template_part('template-parts/content-sales');
   }

    echo paginate_links();

  ?>
<hr class="section-break">


</div>
<?php get_footer();

?>