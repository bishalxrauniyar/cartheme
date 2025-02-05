<?php get_header(); ?>

<div class="container">
    <div class="section-header">
        <p>checkout <span>the</span> cars</p>
        <h2>All cars</h2>
    </div>

    <div class="featured-cars-content">
        <?php
        $args = array(
            'post_type' => 'featured_car',
            'posts_per_page' => -1, // Display all posts
        );
        $featured_cars = new WP_Query($args);

        if ($featured_cars->have_posts()) :
            $posts = $featured_cars->posts;
            $chunks = array_chunk($posts, 4); // Split the posts into chunks of 4

            foreach ($chunks as $chunk) :
                echo '<div class="row">';
                foreach ($chunk as $post) :
                    setup_postdata($post); // Set up post data

                    // Get taxonomy terms
                    $car_year = get_the_terms($post->ID, 'car_year');
                    $car_mileage = get_the_terms($post->ID, 'car_mileage');
                    $car_hp = get_the_terms($post->ID, 'car_hp');
                    $car_transmission = get_the_terms($post->ID, 'car_transmission');
                    $car_price = get_the_terms($post->ID, 'car_price');
                    $car_model = get_the_terms($post->ID, 'car_model');
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
                                        model: <?php echo ($car_year && !is_wp_error($car_model)) ? esc_html($car_model[0]->name) : 'N/A'; ?>
                                        <span class="featured-mi-span">
                                            <?php echo ($car_mileage && !is_wp_error($car_mileage)) ? esc_html($car_mileage[0]->name) . ' mi' : ''; ?>
                                        </span>
                                        <span class="featured-hp-span">
                                            <?php echo ($car_hp && !is_wp_error($car_hp)) ? esc_html($car_hp[0]->name) . 'HP' : ''; ?>
                                        </span>
                                        <?php echo ($car_transmission && !is_wp_error($car_transmission)) ? esc_html($car_transmission[0]->name) : ''; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="featured-cars-txt">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <h3>
                                    <?php
                                    if ($car_price && !is_wp_error($car_price)) {
                                        echo '$' . esc_html($car_price[0]->name);
                                    }
                                    ?>
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
<?php get_footer(); ?>