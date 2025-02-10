<!-- // custom search page for the carvilla theme , this page is used to display the search results of the custom search form in the searchform.php file in the theme.    -->
<?php
get_header();
?>
</section>
<br><br><br><br><br><br><br><br><br><br><br><br>

<?php include 'searchform.php'; ?>

<br><br><br><br>
<?php
// Get search parameters from the GET request
$car_year = isset($_GET['car_year']) ? sanitize_text_field($_GET['car_year']) : '';
$car_type = isset($_GET['car_type']) ? sanitize_text_field($_GET['car_type']) : '';
$car_brand = isset($_GET['car_brand']) ? sanitize_text_field($_GET['car_brand']) : '';
$car_condition = isset($_GET['car_condition']) ? sanitize_text_field($_GET['car_condition']) : '';
$car_model = isset($_GET['car_model']) ? sanitize_text_field($_GET['car_model']) : '';
$car_price = isset($_GET['car_price']) ? sanitize_text_field($_GET['car_price']) : '';

// Prepare tax query
$tax_query = array('relation' => 'AND');

if (!empty($car_year)) {
    $tax_query[] = array(
        'taxonomy' => 'car_year',
        'field'    => 'slug',
        'terms'    => $car_year,
    );
}
if (!empty($car_type)) {
    $tax_query[] = array(
        'taxonomy' => 'car_type',
        'field'    => 'slug',
        'terms'    => $car_type,
    );
}
if (!empty($car_brand)) {
    $tax_query[] = array(
        'taxonomy' => 'car_brand',
        'field'    => 'slug',
        'terms'    => $car_brand,
    );
}
if (!empty($car_condition)) {
    $tax_query[] = array(
        'taxonomy' => 'car_condition',
        'field'    => 'slug',
        'terms'    => $car_condition,
    );
}
if (!empty($car_model)) {
    $tax_query[] = array(
        'taxonomy' => 'car_model',
        'field'    => 'slug',
        'terms'    => $car_model,
    );
}

// Prepare meta query for price
$meta_query = array();

if (!empty($car_price)) {
    $meta_query[] = array(
        'key'     => 'car_price',
        'value'   => $car_price,
        'compare' => '=',
    );
}

// Query featured cars
$args = array(
    'post_type'      => 'featured_car',
    'posts_per_page' => -1,
    'tax_query'      => count($tax_query) > 1 ? $tax_query : [],
    'meta_query'     => !empty($meta_query) ? $meta_query : [],
);

$search_query = new WP_Query($args);
?>

<?php
if ($search_query->have_posts()) :
    while ($search_query->have_posts()) : $search_query->the_post();

        $car_model = get_the_terms(get_the_ID(), 'car_model');
        $car_year = get_the_terms(get_the_ID(), 'car_year');
        $car_price = get_post_meta(get_the_ID(), 'car_price', true);
        $car_mileage = get_post_meta(get_the_ID(), 'car_mileage', true);
        $car_hp = get_post_meta(get_the_ID(), 'car_hp', true);
        $car_transmission = get_the_terms(get_the_ID(), 'car_transmission');

?>
        <div class="container" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/featured-cars/single-page-wall.jpg'); no-repeat center center fixed; background-size: cover; padding: 10px 0; margin-left :20 px;">
            <div class="single-cars-content">
                <div class="single-cars-item">
                    <div class="single-single-cars-item">
                        <div class="row align-items-center"> <!-- Center content -->
                            <div class="col-md-6 col-sm-12 text-center">
                                <div class="single-cars-img">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"
                                        alt="<?php echo esc_attr(get_the_title()); ?>" class="img-fluid rounded">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="single-cars-txt">
                                    <h2 class="car-title">
                                        <?php the_title(); ?>
                                        <span class="car-model">
                                            <?php echo ($car_model && !is_wp_error($car_model)) ? esc_html($car_model[0]->name) : 'N/A'; ?>
                                        </span>
                                        <span class="car-price">
                                            <?php echo (!empty($car_price)) ? '$' . esc_html($car_price) : ''; ?>
                                        </span>
                                    </h2>
                                    <p><?php the_content(); ?></p>

                                    <div class="featured-model-info">
                                        <p>
                                            <strong>Model:</strong> <?php echo ($car_year && !is_wp_error($car_year)) ? esc_html($car_year[0]->name) : 'N/A'; ?>
                                            <span class="featured-mi-span">
                                                <strong>Mileage:</strong> <?php echo (!empty($car_mileage)) ? esc_html($car_mileage) . ' miles' : ''; ?>
                                            </span>
                                            <span class="featured-hp-span">
                                                <strong>Horsepower:</strong> <?php echo (!empty($car_hp)) ? esc_html($car_hp) . ' HP' : ''; ?>
                                            </span>
                                            <strong>Transmission:</strong> <?php echo ($car_transmission && !is_wp_error($car_transmission)) ? esc_html($car_transmission[0]->name) : 'N/A'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    endwhile;
// No results found

else :
    echo '<div class="noresult"><h1>No cars found</h1></div>';
endif;

?>
<?php
get_footer();
?>