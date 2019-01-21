<?php

// Pulling in JS from includes folder
require get_theme_file_path('/includes/like-route.php');
require get_theme_file_path('/includes/search-route.php');

// Custom rest
add_action('rest_api_init', 'university_custom_rest');

function university_custom_rest() {
    register_rest_field('post', 'authorName', array(
        'get_callback' => function() {
            return get_the_author();
        }
    ));
}

// Customise page banner
function pageBanner($args = NULL) {
if(!$args['title']) {
   $args['title'] = get_the_title();
}

if(!$args['subtitle']) {
    $args['subtitle'] = get_field('page_banner_subtitle');
}

if(!$args['photo']) {
   if(get_field('page_banner_background_image')){
        $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];

   } else {
       $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
   }
}
?>
    
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'] ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div> 
    </div>

<?php }


// Imported files CSS/icons/googe maps
function university_files() {

    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyC0NwzCmf3qZ6rSC26iWzTbA5JKHZjWy1w', NULL, microtime(), true);
    wp_enqueue_script('main_university_js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);

    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('custom-google-fonts-lobster', '//fonts.googleapis.com/css?family=Lobster');
    wp_enqueue_style('font_awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri(), NULL, microtime());

    wp_localize_script('main_university_js', 'universityData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
        ));
}

add_action('wp_enqueue_scripts', 'university_files');

// Custom photo sizes
function university_features() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}
add_action('after_setup_theme', 'university_features');


// Custom Event dates
function university_adjust_queries($query) {
   // if(!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()) {
    //    $query->set('post_per_page', -1);
    //}


    //if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
    //    $query->set('orderby', 'title');
    //    $query->set('order', 'ASC');
   //     $query->set('post_per_page', -1);
   // }

    if(!is_admin()  AND is_post_type_archive('sale') AND $query->is_main_query()) {

        $today = date('Ymd');

        $query->set('meta-key', 'sales');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
              'key' => 'sales',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            )
         ));

        }         
    
}
add_action('pre_get_posts', 'university_adjust_queries');

//Google maps API Key

function universityMapKey($api) {
    $api['key'] = 'AIzaSyC0NwzCmf3qZ6rSC26iWzTbA5JKHZjWy1w';
    return $api;
}

add_filter('acf/fields/google_map/api', 'universityMapKey');

// Redirect Subscriber out of admin and to homepage

add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend() {
    $ourCurrentUser = wp_get_current_user();

    if(count($ourCurrentUser->roles)== 1 && $ourCurrentUser->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}

// Removes admin bar from WP for subscribers

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
    $ourCurrentUser = wp_get_current_user();

    if(count($ourCurrentUser->roles)== 1 && $ourCurrentUser->roles[0] == 'subscriber') {
        show_admin_bar(false);
    }    
}

// Customise login screen

add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
    return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS() {
   wp_enqueue_style('university_main_styles', get_stylesheet_uri());
   wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
   wp_enqueue_style('custom-google-fonts-lobster','//fonts.googleapis.com/css?family=Lobster');

}

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle() {
    return get_bloginfo('name');
}

?>