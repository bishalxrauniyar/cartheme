<!-- search from the search bar -->
<?php
get_header();

// Get query parameters
//  checks if the `car_year` parameter is present in the URL. If it is, it sanitizes the value and assigns it to the `$car_year` variable. If it is not present, it assigns an empty string to `$car_year`. This ensures that the variable is always set to a safe value.
$car_year = isset($_GET['car_year']) ? sanitize_text_field($_GET['car_year']) : '';
$car_type = isset($_GET['car_type']) ? sanitize_text_field($_GET['car_type']) : '';
$car_brand = isset($_GET['car_brand']) ? sanitize_text_field($_GET['car_brand']) : '';
$car_condition = isset($_GET['car_condition']) ? sanitize_text_field($_GET['car_condition']) : '';
$car_model = isset($_GET['car_model']) ? sanitize_text_field($_GET['car_model']) : '';
$car_price = isset($_GET['car_price']) ? sanitize_text_field($_GET['car_price']) : '';

// Build WP_Query arguments
$args = array(
    'post_type' => 'featured_car',
    'posts_per_page' => -1,
    'tax_query' => array(
        'relation' => 'AND',
    ),
    'meta_query' => array(),
);

// Add taxonomy filters
if (!empty($car_year)) {
    $args['tax_query'][] = array(
        'taxonomy' => 'car_year',
        'field' => 'slug',
        'terms' => $car_year,
    );
}
if (!empty($car_type)) {
    $args['tax_query'][] = array(
        'taxonomy' => 'car_type',
        'field' => 'slug',
        'terms' => $car_type,
    );
}
if (!empty($car_brand)) {
    $args['tax_query'][] = array(
        'taxonomy' => 'car_brand',
        'field' => 'slug',
        'terms' => $car_brand,
    );
}
if (!empty($car_condition)) {
    $args['tax_query'][] = array(
        'taxonomy' => 'car_condition',
        'field' => 'slug',
        'terms' => $car_condition,
    );
}
if (!empty($car_model)) {
    $args['tax_query'][] = array(
        'taxonomy' => 'car_model',
        'field' => 'slug',
        'terms' => $car_model,
    );
}

// Add price filter
if (!empty($car_price)) {
    $args['meta_query'][] = array(
        'key' => 'car_price',
        'value' => $car_price,
        'compare' => '='
    );
}

// Run WP_Query
$query = new WP_Query($args);

if ($query->have_posts()) :
    echo '<div class="search-results">';
    while ($query->have_posts()) : $query->the_post();
        // Display the car details here
?>
        <div class="car-item">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p>Price: <?php echo get_post_meta(get_the_ID(), 'car_price', true); ?></p>
        </div>
<?php
    endwhile;
    echo '</div>';
else :
    echo '<p>No results found.</p>';
endif;

wp_reset_postdata();

get_footer();
