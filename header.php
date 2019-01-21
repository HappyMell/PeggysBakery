<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left"><a href="<?php echo site_url()?>"><strong>Peggy's</strong>Bakery</a></h1>
      <a href="<?php echo esc_url(site_url('/search')); ?>" class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <!-- Dynamic WP Menu -->

        <?php  /* wp_nav_menu(array(
          'theme_location' => 'headerMenuLocation'
        )); */?>

        <!-- Custom Menu --> 
            <ul>
            <li <?php if(is_page('about-us') | wp_get_post_parent_id(0) == 11) echo 'class="current-menu-item"'?>><a href="<?php echo site_url('/about-us')?>">About Us</a></li>
            <li <?php if(get_post_type() == 'bakes') echo 'class="current-menu-item"'?>><a href="<?php echo get_post_type_archive_link('program')?>">Bakes</a></li>
            <li <?php if(get_post_type() == 'sales' | is_page('past-sales')) echo 'class="current-menu-item"' ?>><a href="<?php echo get_post_type_archive_link('sales') ?>">Sales</a></li>
            <li <?php if(get_post_type() == 'locations') echo 'class="current-menu-item"'?>><a href="<?php echo get_post_type_archive_link('campus')?>">Locations</a></li>
          </ul> 
        </nav>
        <div class="site-header__util">
          
          <a href="<?php echo esc_url(site_url('/search')); ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </header>
    
