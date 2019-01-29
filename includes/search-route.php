<?php

add_action('rest_api_init', 'bakeryRegisterSearch');

function bakeryRegisterSearch() {
  register_rest_route('bakeries/v2', 'search', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'bakerySearchResults'
  ));
}

function bakerySearchResults($data) {
  $mainQuery = new WP_Query(array(
    'post_type' => array('post', 'page', 'bakes', 'locations', 'sales'),
    's' => sanitize_text_field($data['term'])
  ));

  $results = array(
    'generalInfo' => array(),
    'bakes' => array(),
    'locations' => array(),
    'sales' => array()
    );

  while($mainQuery->have_posts()) {
    $mainQuery->the_post();

    if (get_post_type() == 'post' OR get_post_type() == 'page') {
      array_push($results['generalInfo'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'postType' => get_post_type()
      ));
    }

     if (get_post_type() == 'bakes') {
      array_push($results['bakes'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'content' => the_content()
            ));
    }

      if (get_post_type() == 'locations') {
            array_push($results['locations'], array(
              'title' => get_the_title(),
              'permalink' => get_the_permalink()
            ));
          }

       if (get_post_type() == 'sales') {
      $saleDate = DateTime :: createFromFormat('d/m/Y', get_field('sales'));
      $description = null;
      if(has_excerpt()) {
          $description = get_the_excerpt();
              } else {
                $description =  wp_trim_words(get_the_content(), 18);
              } 

      array_push($results['sales'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'month' => $saleDate->format('M'),
        'day' => $saleDate->format('d'),
        'description' => $description
      ));
    }  
    
    

  }
return $results;
}