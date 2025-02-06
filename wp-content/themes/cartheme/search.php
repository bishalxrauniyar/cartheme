<!-- search from the search bar -->
<?php
get_header();
?>


<section id="featured-cars" class="featured-cars">
    <div class="container">
        <div class="section-header">
            <p>Checkout <span>the</span> result of the cars search</p>
            <h2>Available Cars</h2>
        </div>

        <div class="featured-cars-content">
            <?php
            $args = array(
                'post_type'      => 'featured_car',
                'posts_per_page' => -1,
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
<?php
get_footer();
?>