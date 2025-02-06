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
    wp_enqueue_style('custom_css', get_template_directory_uri() . '/style.css', array(), 'Version', 'all');
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
            'hierarchical' => true,
        )
    );


    register_taxonomy(
        'car_brand',
        'featured_car',
        array(
            'label' => __('Car Brand', 'textdomain'),
            'rewrite' => array('slug' => 'car-brand'),
            'hierarchical' => true,
        )
    );


    register_taxonomy(
        'car_condition',
        'featured_car',
        array(
            'label' => __('Car Condition', 'textdomain'),
            'rewrite' => array('slug' => 'car-condition'),
            'hierarchical' => true,
        )
    );



    register_taxonomy(
        'car_model',
        'featured_car',
        array(
            'label' => __('Car Model', 'textdomain'),
            'rewrite' => array('slug' => 'car-model'),
            'hierarchical' => true,
        )
    );

    register_taxonomy(
        'car_transmission',
        'featured_car',
        array(
            'label' => __('Car Transmission', 'textdomain'),
            'rewrite' => array('slug' => 'car-transmission'),
            'hierarchical' => true,
        )
    );
}
add_action('init', 'create_featured_cars_taxonomies');

//adding meta boxes to featured cars post type for price ,mileage and hp

function add_featured_car_meta_boxes()
{
    add_meta_box(
        'featured_car_meta_box',
        'Car Details',
        'display_featured_car_meta_box',
        'featured_car',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_featured_car_meta_boxes');

function display_featured_car_meta_box($featured_car)
{
    // Retrieve current name of the Director and Movie Rating based on review ID

    $car_price = esc_html(get_post_meta($featured_car->ID, 'car_price', true));
    $car_mileage = esc_html(get_post_meta($featured_car->ID, 'car_mileage', true));
    $car_hp = esc_html(get_post_meta($featured_car->ID, 'car_hp', true));

?>
    <table>

        <tr>
            <td style="width: 100%">Car Price</td>
            <td><input type="number" size="80" name="car_price" value="<?php echo $car_price; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">Car Mileage</td>
            <td><input type="number" size="80" name="car_mileage" value="<?php echo $car_mileage; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">Car Horsepower</td>
            <td><input type="number" size="80" name="car_hp" value="<?php echo $car_hp; ?>" /></td>
        </tr>
    </table>
<?php
}

function save_featured_car_meta_box($featured_car_id, $featured_car)
{
    if (isset($_POST['car_price'])) {
        update_post_meta($featured_car_id, 'car_price', sanitize_text_field($_POST['car_price']));
    }
    if (isset($_POST['car_mileage'])) {
        update_post_meta($featured_car_id, 'car_mileage', sanitize_text_field($_POST['car_mileage']));
    }
    if (isset($_POST['car_hp'])) {
        update_post_meta($featured_car_id, 'car_hp', sanitize_text_field($_POST['car_hp']));
    }
}

add_action('save_post', 'save_featured_car_meta_box', 10, 2);

// custom post type for testimonials

function create_testimonial_cars_cpt()
{
    $labels = array(
        'name' => __('Testimonials', 'textdomain'),
        'singular_name' => __('Testimonial', 'textdomain'),
        'menu_name' => __('Testimonials', 'textdomain'),
        'add_new' => __('Add New Testimonial', 'textdomain'),
        'add_new_item' => __('Add New Testimonial ', 'textdomain'),
        'edit_item' => __('Edit Testimonial', 'textdomain'),
        'new_item' => __('New Testimonial', 'textdomain'),
        'view_item' => __('View Testimonial', 'textdomain'),
        'search_items' => __('Search Testimonial', 'textdomain'),
        'not_found' => __('No Testimonial found', 'textdomain'),
        'not_found_in_trash' => __('No Testimonial found in trash', 'textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-testimonial',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'rewrite' => array('slug' => 'Testimonial-cars'),
    );

    register_post_type('testimonials', $args);
}
add_action('init', 'create_testimonial_cars_cpt');

//adding custom fields to testimonial post type
function add_testimonial_meta_boxes()
{
    add_meta_box(
        'testimonial_meta_box',
        'Testimonial Details',
        'display_testimonial_meta_box',
        'testimonials',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_testimonial_meta_boxes');

function display_testimonial_meta_box($testimonial)
{
    // Retrieve current name of the Director and Movie Rating based on review ID

    $testimonial_country = esc_html(get_post_meta($testimonial->ID, 'testimonial_country', true));


?>
    <table>

        <tr>
            <td style="width: 100%">Testimonial Location</td>
            <td><input type="text" size="80" name="testimonial_country" value="<?php echo $testimonial_country; ?>" /></td>
        </tr>

    </table>
<?php
}

function save_testimonial_meta_box($testimonial_id, $testimonial)
{
    if (isset($_POST['testimonial_country'])) {
        update_post_meta($testimonial_id, 'testimonial_country', sanitize_text_field($_POST['testimonial_country']));
    }
}

add_action('save_post', 'save_testimonial_meta_box', 10, 2);
