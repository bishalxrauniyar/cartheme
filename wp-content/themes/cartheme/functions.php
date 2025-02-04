<?php
//load css
function cartheme_theme_load_styles()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('cartheme_animate', get_template_directory_uri() . '/assets/css/animate.css', array(), 'Version', 'all');
    wp_enqueue_style('cartheme_bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), 'Version', 'all');
    wp_enqueue_style('cartheme_bootsnav', get_template_directory_uri() . '/assets/css/bootsnav.css', array(), 'Version', 'all');
    wp_enqueue_style('cartheme_flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', array(), 'Version', 'all');
    wp_enqueue_style('cartheme_fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), 'Version', 'all');
    wp_enqueue_style('cartheme_linearicons', get_template_directory_uri() . '/assets/css/linearicons.css', array(), 'Version', 'all');
    wp_enqueue_style('cartheme_owlcarousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), 'Version', 'all');
    wp_enqueue_style('cartheme5_owlcarouseltheme', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css', array(), 'Version', 'all');
    wp_enqueue_style('cartheme_style', get_template_directory_uri() . '/assets/css/style.css', array(), 'Version', 'all');
    wp_enqueue_style('cartheme_responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), 'Version', 'all');
}
add_action('wp_enqueue_scripts', 'cartheme_theme_load_styles');


//load js
function cartheme_scripts()
{
    // wp_enqueue_script('cartheme_script_jquery', get_template_directory_uri() . '/assets/js/jquery.js', array(), '3.5.1', true); (we don't need this because it's already included in wordpress)
    wp_enqueue_script('cartheme_script_bootstrap.min', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.3.7', true);
    wp_enqueue_script('cartheme_script_bootsnav', get_template_directory_uri() . '/assets/js/bootsnav.js', array('jquery'), '1.2', true);
    wp_enqueue_script('cartheme_script_custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0', true);
    wp_enqueue_script('cartheme_script_feather', get_template_directory_uri() . '/assets/js/feather.min.js', array('jquery'), '2.5.3', true);
    wp_enqueue_script('cartheme_script_owlcarousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '2.2.0', true);
}
add_action('wp_enqueue_scripts', 'cartheme_scripts');

// google fonts
function cartheme_google_fonts()
{

    wp_register_style('google_poppins', 'https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', array(), null, 'all');
    wp_enqueue_style('google_poppins');
    wp_register_style('google_rufina', 'https://fonts.googleapis.com/css?family=Rufina:400,700', array(), null, 'all');
    wp_enqueue_style('google_rufina');
}
add_action('wp_enqueue_scripts', 'cartheme_google_fonts');

// adds dynamic title tag support,custom-logo,post thumbnail
function cartheme_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'cartheme_theme_support');

function cartheme_nav_menus()
{
    $locations = array(
        'header' => "Header Menu Items",
        'footer' => "Footer Menu Items",
    );
    register_nav_menus($locations);
}
add_action('init', 'cartheme_nav_menus');

// custom post type for featured cars
function create_featured_cars_cpt()
{
    $labels = array(
        'name' => __('Featured Cars', 'textdomain'),
        'singular_name' => __('Featured Car', 'textdomain'),
        'menu_name' => __('Featured Cars', 'textdomain'),
        'add_new' => __('Add New Car', 'textdomain'),
        'add_new_item' => __('Add New Featured Car', 'textdomain'),
        'edit_item' => __('Edit Featured Car', 'textdomain'),
        'new_item' => __('New Featured Car', 'textdomain'),
        'view_item' => __('View Featured Car', 'textdomain'),
        'search_items' => __('Search Featured Cars', 'textdomain'),
        'not_found' => __('No featured cars found', 'textdomain'),
        'not_found_in_trash' => __('No featured cars found in trash', 'textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-car',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'rewrite' => array('slug' => 'featured-cars'),
    );

    register_post_type('featured_car', $args);
}
add_action('init', 'create_featured_cars_cpt');

// custom taxonomies for featured cars
function create_featured_cars_taxonomies()
{
    register_taxonomy(
        'car_year',
        'featured_car',
        array(
            'label' => __('Car Year', 'textdomain'),
            'rewrite' => array('slug' => 'car-year'),
            'hierarchical' => false,
        )
    );



    register_taxonomy(
        'car_type',
        'featured_car',
        array(
            'label' => __('Car Body Type', 'textdomain'),
            'rewrite' => array('slug' => 'car-type'),
            'hierarchical' => false,
        )
    );


    register_taxonomy(
        'car_brand',
        'featured_car',
        array(
            'label' => __('Car Brand', 'textdomain'),
            'rewrite' => array('slug' => 'car-brand'),
            'hierarchical' => false,
        )
    );


    register_taxonomy(
        'car_condition',
        'featured_car',
        array(
            'label' => __('Car Condition', 'textdomain'),
            'rewrite' => array('slug' => 'car-condition'),
            'hierarchical' => false,
        )
    );



    register_taxonomy(
        'car_model',
        'featured_car',
        array(
            'label' => __('Car Model', 'textdomain'),
            'rewrite' => array('slug' => 'car-model'),
            'hierarchical' => false,
        )
    );

    register_taxonomy(
        'car_price',
        'featured_car',
        array(
            'label' => __('Car Price', 'textdomain'),
            'rewrite' => array('slug' => 'car-price'),
            'hierarchical' => false,
        )
    );


    register_taxonomy(
        'car_transmission',
        'featured_car',
        array(
            'label' => __('Car Transmission', 'textdomain'),
            'rewrite' => array('slug' => 'car-transmission'),
            'hierarchical' => false,
        )
    );

    register_taxonomy(
        'car_mileage',
        'featured_car',
        array(
            'label' => __('Car Mileage', 'textdomain'),
            'rewrite' => array('slug' => 'car-mileage'),
            'hierarchical' => false,
        )
    );

    register_taxonomy(
        'car_hp',
        'featured_car',
        array(
            'label' => __('Car Horsepower', 'textdomain'),
            'rewrite' => array('slug' => 'car-hp'),
            'hierarchical' => false,
        )
    );
}
add_action('init', 'create_featured_cars_taxonomies');
