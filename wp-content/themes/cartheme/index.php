<?php get_header(); ?>
<!-- Banner section start ------------------------------------------------------------------------------------------------------------------------>
<div class="container">
    <div class="welcome-hero-txt">
        <h2>get your desired car in resonable price</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
        <button class="welcome-btn" onclick="window.location.href='#contact'">
            contact us
        </button>
    </div>
</div>
<!-- Banner section end -->

<!-- search section  ------------------------------------------------------------------------------------------------------------------------------->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="model-search-content">
                <form action="<?php echo site_url('/search-results'); ?>" method="GET">
                    <div class="row">
                        <!-- Year Selection -->
                        <div class="col-md-offset-1 col-md-2 col-sm-12">
                            <div class="single-model-search">
                                <h2>select year</h2>
                                <div class="model-select-icon">
                                    <select name="car_year" class="form-control">
                                        <option value="">Select Year</option>
                                        <?php
                                        // Fetch all terms from 'car_year' taxonomy
                                        $car_years = get_terms(array('taxonomy' => 'car_year', 'hide_empty' => false));
                                        foreach ($car_years as $car_year) {
                                            echo '<option value="' . esc_attr($car_year->slug) . '">' . esc_html($car_year->name) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- /.model-select-icon -->
                            </div>
                            <div class="single-model-search">
                                <h2>body style</h2>
                                <div class="model-select-icon">
                                    <select name="car_type" class="form-control">
                                        <option value="">Select Style</option>
                                        <?php
                                        // Fetch all terms from 'car_type' taxonomy
                                        $car_types = get_terms(array(
                                            'taxonomy' => 'car_type',
                                            'hide_empty' => false,
                                        ));


                                        foreach ($car_types as $car_type) {
                                            echo '<option value="' . esc_attr($car_type->slug) . '">' . esc_html($car_type->name) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- /.model-select-icon -->
                            </div>
                        </div>

                        <!-- Brand & Condition Selection -->
                        <div class="col-md-offset-1 col-md-2 col-sm-12">
                            <div class="single-model-search">
                                <h2>select brand</h2>
                                <div class="model-select-icon">
                                    <select name="car_brand" class="form-control">
                                        <option value="">Select Brand</option>
                                        <?php
                                        // Fetch all terms from 'car_brand' taxonomy
                                        $car_brands = get_terms(array(
                                            'taxonomy' => 'car_brand',
                                            'hide_empty' => false,
                                        ));
                                        foreach ($car_brands as $car_brand) {
                                            echo '<option value="' . esc_attr($car_brand->slug) . '">' . esc_html($car_brand->name) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- /.model-select-icon -->
                            </div>
                            <div class="single-model-search">
                                <h2>car condition</h2>
                                <div class="model-select-icon">
                                    <select name="car_condition" class="form-control">
                                        <option value="">Select Condition</option>
                                        <?php
                                        // Fetch all terms from 'car_condition' taxonomy
                                        $car_conditions = get_terms(array(
                                            'taxonomy' => 'car_condition',
                                            'hide_empty' => false,
                                        ));
                                        foreach ($car_conditions as $car_condition) {
                                            echo '<option value="' . esc_attr($car_condition->slug) . '">' . esc_html($car_condition->name) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- /.model-select-icon -->
                            </div>
                        </div>

                        <!-- Model & Price Selection -->
                        <div class="col-md-offset-1 col-md-2 col-sm-12">
                            <div class="single-model-search">
                                <h2>select model</h2>
                                <div class="model-select-icon">
                                    <select name="car_model" class="form-control">
                                        <option value="">Select Model</option>
                                        <?php
                                        // Fetch all terms from 'car_model' taxonomy
                                        $car_models = get_terms(array(
                                            'taxonomy' => 'car_model',
                                            'hide_empty' => false,
                                        ));
                                        foreach ($car_models as $car_model) {
                                            echo '<option value="' . esc_attr($car_model->slug) . '">' . esc_html($car_model->name) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- /.model-select-icon -->
                            </div>
                            <div class="single-model-search">
                                <h2>select price</h2>
                                <div class="model-select-icon">
                                    <select name="car_price" class="form-control">
                                        <option value="">Select Price</option>
                                        <!-- need to define the post type for the featured car that have the meta key car_price which will loop through every post and get the car_price meta value and display it as an option in the select dropdown -->
                                        <?php
                                        // Query 'featured_car' post type to get price meta values

                                        $args = array(
                                            'post_type' => 'featured_car',
                                            'posts_per_page' => -1, // Fetch all posts
                                        );
                                        $featured_cars = new WP_Query($args);
                                        if ($featured_cars->have_posts()) :
                                            while ($featured_cars->have_posts()) : $featured_cars->the_post();
                                                $car_prices = get_post_meta(get_the_ID(), 'car_price');
                                                if (!empty($car_prices)) {
                                                    foreach ($car_prices as $car_price) {
                                                        echo '<option value="' . esc_html($car_price) . '">' . esc_html($car_price) . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="">No price available</option>';
                                                }
                                            endwhile;
                                            wp_reset_postdata();
                                        endif;
                                        ?>
                                    </select>
                                </div>
                                <!-- /.model-select-icon -->
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="col-md-2 col-sm-12">
                            <div class="single-model-search text-center">
                                <button type="submit" class="welcome-btn model-search-btn">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






<!-- search section end  -->
</section>


<!--service start ------------------------------------------------------------------------------------------------------------------------>
<section id="service" class="service">
    <div class="container">
        <div class="service-content">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="single-service-item">
                        <div class="single-service-icon">
                            <i class="flaticon-car"></i>
                        </div>
                        <h2>
                            <a href="#">largest dealership <span> of</span> car</a>
                        </h2>
                        <p>
                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut
                            odit aut den fugit sed quia.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-service-item">
                        <div class="single-service-icon">
                            <i class="flaticon-car-repair"></i>
                        </div>
                        <h2><a href="#">unlimited repair warrenty</a></h2>
                        <p>
                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut
                            odit aut den fugit sed quia.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="single-service-item">
                        <div class="single-service-icon">
                            <i class="flaticon-car-1"></i>
                        </div>
                        <h2><a href="#">insurence support</a></h2>
                        <p>
                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut
                            odit aut den fugit sed quia.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.container-->
</section>
<!--/.service-->




<!--new-cars start --------------------------------------------------------------------------------------------------------------------------->
<section id="new-cars" class="new-cars">
    <div class="container">
        <div class="section-header">
            <p>checkout <span>the</span> latest cars</p>
            <h2>newest cars</h2>
        </div>
        <!--/.section-header-->
        <div class="new-cars-content">

            <?php
            $args = array(
                'post_type' => 'featured_car',
                'posts_per_page' => 3, // Fetch multiple posts
            );
            $featured_cars = new WP_Query($args);
            if ($featured_cars->have_posts()) :
            ?>
                <div class="owl-carousel owl-theme" id="new-cars-carousel">
                    <?php
                    while ($featured_cars->have_posts()) : $featured_cars->the_post();
                        $car_model = get_the_terms(get_the_ID(), 'car_model');
                    ?>
                        <div class="new-cars-item">
                            <div class="single-new-cars-item">
                                <div class="row">
                                    <div class="col-md-7 col-sm-12">
                                        <div class="new-cars-img">
                                            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"
                                                alt="<?php echo esc_attr(get_the_title()); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-12">
                                        <div class="new-cars-txt">
                                            <h2>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?> <span><?php echo ($car_model) ? esc_html($car_model[0]->name) : 'N/A'; ?></span>
                                                </a>
                                            </h2>
                                            <p><?php the_excerpt(); ?></p>
                                            <button class="welcome-btn new-cars-btn"
                                                onclick="window.location.href='<?php the_permalink(); ?>'">
                                                view details
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php
                wp_reset_postdata();
            else :
                echo '<p>' . __('No featured cars found', 'textdomain') . '</p>';
            endif;
            ?>

            <!--/.col-->
        </div>
        <!--/.row-->
    </div>
    <!--/.single-new-cars-item-->
    </div>
    <!--/.new-cars-item-->
    </div>
    <!--/#new-cars-carousel-->
    </div>
    <!--/.new-cars-content-->
    </div>
    <!--/.container-->
</section>
<!--/.new-cars-->
<!--new-cars end -->



<!-- 
    Custom post type: car -->
<!--featured-cars start ------------------------------------------------------------------------------------------------------------------------>

<section id="featured-cars" class="featured-cars">
    <div class="container">
        <div class="section-header">
            <p>Checkout <span>the</span> featured cars</p>
            <h2>Featured Cars</h2>
        </div>

        <div class="featured-cars-content">
            <?php
            $args = array(
                'post_type'      => 'featured_car',
                'posts_per_page' => 8,
            );
            $featured_cars = new WP_Query($args);

            if ($featured_cars->have_posts()) :
                $posts = $featured_cars->posts;
                $chunks = array_chunk($posts, 4); // Split posts into chunks of 4

                foreach ($chunks as $chunk) :
                    echo '<div class="row">';
                    foreach ($chunk as $post) :
                        setup_postdata($post);

                        // Get metadata and taxonomy terms
                        $car_year    = get_the_terms($post->ID, 'car_year');
                        $car_mileage = get_post_meta(get_the_ID(), 'car_mileage', true);
                        $car_hp      = get_post_meta(get_the_ID(), 'car_hp', true);
                        $car_type    = get_the_terms($post->ID, 'car_type');
                        $car_price   = get_post_meta(get_the_ID(), 'car_price', true);
                        $car_model   = get_the_terms($post->ID, 'car_model');
                        $car_trasmission = get_the_terms($post->ID, 'car_transmission');
            ?>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-featured-cars">
                                <div class="featured-img-box">
                                    <div class="featured-cars-img">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="featured-model-info">
                                        <p>
                                            Model: <?php echo (!empty($car_model) && !is_wp_error($car_model)) ? esc_html($car_model[0]->name) : 'N/A'; ?>
                                            <span class="featured-mi-span">
                                                <?php echo (!empty($car_mileage)) ? esc_html($car_mileage) . ' mi' : ''; ?>
                                            </span>
                                            <span class="featured-hp-span">
                                                <?php echo (!empty($car_hp)) ? esc_html($car_hp) . ' HP' : ''; ?>
                                            </span>
                                            <?php echo (!empty($car_trasmission) && !is_wp_error($car_trasmission)) ? esc_html($car_trasmission[0]->name) : ''; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="featured-cars-txt">
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <h3>
                                        <?php echo (!empty($car_price)) ? '$' . esc_html(number_format($car_price)) : 'Price not available'; ?>
                                    </h3>
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                            </div>
                        </div>

            <?php
                    endforeach;
                    echo '</div>'; // .row
                endforeach;

                wp_reset_postdata();
            else :
                echo '<p>' . __('No featured cars found', 'textdomain') . '</p>';
            endif;
            ?>
        </div>
    </div>
</section>


<!--/.featured-cars-->
<!--featured-cars end -->


<!-- testimonial-carousel ------------------------------------------------------------------------------------------------------------------------------------------>
<!-- clients-say strat -->
<section id="clients-say" class="clients-say">
    <div class="container">
        <div class="section-header">
            <h2>what our clients say</h2>
        </div>
        <!--/.section-header-->
        <div class="row">

            <?php
            $args = array(
                'post_type' => 'testimonials',
                'posts_per_page' => -1, // Fetch all posts
            );
            $testimonial = new WP_Query($args);
            if ($testimonial->have_posts()) :
            ?>
                <div class="owl-carousel testimonial-carousel">
                    <?php
                    while ($testimonial->have_posts()) : $testimonial->the_post();
                    ?>
                        <div class="col-sm-3 col-xs-12">
                            <div class="single-testimonial-box">
                                <div class="testimonial-description">
                                    <div class="testimonial-info">
                                        <div class="testimonial-img">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="image of clients person" />
                                            <?php endif; ?>
                                        </div>
                                        <!--/.testimonial-img-->
                                    </div>
                                    <!--/.testimonial-info-->
                                    <div class="testimonial-comment">
                                        <p>
                                            <?php the_excerpt(); ?>
                                        </p>
                                    </div>
                                    <!--/.testimonial-comment-->
                                    <div class="testimonial-person">
                                        <h2><a href="#"><?php the_title(); ?></a></h2>
                                        <h4><?php echo get_post_meta(get_the_ID(), 'testimonial_country', true); ?></h4>
                                    </div>
                                    <!--/.testimonial-person-->
                                </div>
                                <!--/.testimonial-description-->
                            </div>
                            <!--/.single-testimonial-box-->
                        </div>
                    <?php endwhile; ?>

                </div>
                <!--/.testimonial-carousel-->
            <?php
                wp_reset_postdata();
            else :
                echo '<p>' . __('No Testimonial found', 'textdomain') . '</p>';
            endif;
            ?>

        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
<!--/.clients-say-->
<!-- clients-say end -->

<!-- brands logo -------------------------------------------------------------------------------------------------------------------------->
<!--brand strat -->
<section id="brand" class="brand">
    <div class="container">
        <div class="brand-area">
            <div class="owl-carousel owl-theme brand-item">
                <div class="item">
                    <a href="#">
                        <img src="wp-content/themes/cartheme/assets/images/brand/br1.png" alt="brand-image" />
                    </a>
                </div>
                <!--/.item-->
                <div class="item">
                    <a href="#">
                        <img src="wp-content/themes/cartheme/assets/images/brand/br2.png" alt="brand-image" />
                    </a>
                </div>
                <!--/.item-->
                <div class="item">
                    <a href="#">
                        <img src="wp-content/themes/cartheme/assets/images/brand/br3.png" alt="brand-image" />
                    </a>
                </div>
                <!--/.item-->
                <div class="item">
                    <a href="#">
                        <img src="wp-content/themes/cartheme/assets/images/brand/br4.png" alt="brand-image" />
                    </a>
                </div>
                <!--/.item-->

                <div class="item">
                    <a href="#">
                        <img src="wp-content/themes/cartheme/assets/images/brand/br5.png" alt="brand-image" />
                    </a>
                </div>
                <!--/.item-->

                <div class="item">
                    <a href="#">
                        <img src="wp-content/themes/cartheme/assets/images/brand/br6.png" alt="brand-image" />
                    </a>
                </div>
                <!--/.item-->
            </div>
            <!--/.owl-carousel-->
        </div>
        <!--/.clients-area-->
    </div>
    <!--/.container-->
</section>
<!--/brand-->
<!--brand end -->

<!--blog start -->
<section id="blog" class="blog"></section>



<!--/.blog-->
<!--blog end -->


<?php get_footer(); ?>