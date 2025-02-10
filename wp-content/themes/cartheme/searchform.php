<!-- custom search form for the car post type -->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="model-search-content">
                <form role="search" method="get" action="search.php">
                    <div class="row">
                        <!-- Year Selection -->
                        <div class="col-md-offset-1 col-md-2 col-sm-12">
                            <div class="single-model-search">
                                <h2>select year</h2>
                                <div class="model-select-icon">
                                    <select id="car_year" name="car_year" class="form-control">
                                        <option value="">Select Year</option>
                                        <?php
                                        // Get the selected year from the request (POST or GET)
                                        $selected = isset($_GET['car_year']) ? $_GET['car_year'] : '';

                                        // Fetch all terms from 'car_year' taxonomy
                                        $car_years = get_terms(array('taxonomy' => 'car_year', 'hide_empty' => false));

                                        foreach ($car_years as $car_year) {
                                            $selected = ($selected == $car_year->slug) ? 'selected' : '';
                                            echo '<option value="' . esc_attr($car_year->slug) . '" ' . $selected . '>' . esc_html($car_year->name) . '</option>';
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