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
      <h1 class="school-logo-text"><a href="<?php echo site_url()?>"><strong>Peggy's</strong> Bakery</a></h1>
     
      <div class="site-header__menu group">
        <nav class="main-navigation">   
        <!-- Custom Menu --> 
         <ul>
            <li <?php if (get_post_type() == 'bakes') ?>><a href="<?php echo site_url('bakes') ?>">Bakes</a></li>
            <li <?php if (get_post_type() == 'about-us') ?>><a href="<?php echo site_url('about-us') ?>">About Us</a></li>
            <li <?php if (get_post_type() == 'locations') ?>><a href="<?php echo site_url('locations'); ?>">Locations</a></li>
            <li <?php if (get_post_type() == 'sales') ?>><a href="<?php echo site_url('sales'); ?>">Sales</a></li>
          </ul>


          
        </nav>
        <div class="site-header__util">
          <a href="<?php echo esc_url(site_url('/search')); ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </header>
    
