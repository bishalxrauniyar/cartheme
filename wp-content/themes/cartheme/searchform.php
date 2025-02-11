<!-- // this file is used for the search page attributes like taxonomy and meta fields. -->
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
                                        $selected_year = isset($_GET['car_year']) ? $_GET['car_year'] : '';

                                        // Fetch all terms from 'car_year' taxonomy
                                        $car_years = get_terms(array('taxonomy' => 'car_year', 'hide_empty' => false));

                                        foreach ($car_years as $car_year) {
                                            $is_selected_year = ($selected_year == $car_year->slug) ? 'selected' : ''; // Use a new variable
                                            echo '<option value="' . esc_attr($car_year->slug) . '" ' . $is_selected_year . '>' . esc_html($car_year->name) . '</option>';
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
                                        $selected_type = isset($_GET['car_type']) ? $_GET['car_type'] : '';

                                        // Fetch all terms from 'car_type' taxonomy
                                        $car_types = get_terms(array(
                                            'taxonomy' => 'car_type',
                                            'hide_empty' => false,
                                        ));

                                        foreach ($car_types as $car_type) {
                                            $is_selected_type = ($selected_type == $car_type->slug) ? ' selected' : ''; // Correct 'selected' attribute
                                            echo '<option value="' . esc_attr($car_type->slug) . '"' . $is_selected_type . '>' . esc_html($car_type->name) . '</option>';
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
                                        // Get the selected brand from the request
                                        $selected_brand = isset($_GET['car_brand']) ? $_GET['car_brand'] : '';

                                        // Fetch all terms from 'car_brand' taxonomy
                                        $car_brands = get_terms(array(
                                            'taxonomy' => 'car_brand',
                                            'hide_empty' => false,
                                        ));

                                        foreach ($car_brands as $car_brand) {
                                            $is_selected = ($selected_brand == $car_brand->slug) ? ' selected' : ''; // Correct selection logic
                                            echo '<option value="' . esc_attr($car_brand->slug) . '"' . $is_selected . '>' . esc_html($car_brand->name) . '</option>';
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
                                        // Get the selected condition from the request
                                        $selected_condition = isset($_GET['car_condition']) ? $_GET['car_condition'] : '';

                                        // Fetch all terms from 'car_condition' taxonomy
                                        $car_conditions = get_terms(array(
                                            'taxonomy' => 'car_condition',
                                            'hide_empty' => false,
                                        ));

                                        foreach ($car_conditions as $car_condition) {
                                            $is_selected = ($selected_condition == $car_condition->slug) ? ' selected' : ''; // Apply selection
                                            echo '<option value="' . esc_attr($car_condition->slug) . '"' . $is_selected . '>' . esc_html($car_condition->name) . '</option>';
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
                                        // Get the selected model from the request
                                        $selected_model = isset($_GET['car_model']) ? $_GET['car_model'] : '';

                                        // Fetch all terms from 'car_model' taxonomy
                                        $car_models = get_terms(array(
                                            'taxonomy' => 'car_model',
                                            'hide_empty' => false,
                                        ));

                                        foreach ($car_models as $car_model) {
                                            $is_selected = ($selected_model == $car_model->slug) ? ' selected' : ''; // Apply selection
                                            echo '<option value="' . esc_attr($car_model->slug) . '"' . $is_selected . '>' . esc_html($car_model->name) . '</option>';
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
                                        <?php
                                        // Get selected price from the request
                                        $selected_price = isset($_GET['car_price']) ? $_GET['car_price'] : '';

                                        // Query 'featured_car' post type to get unique price meta values
                                        $args = array(
                                            'post_type'      => 'featured_car',
                                            'posts_per_page' => -1, // Fetch all posts
                                            'meta_key'       => 'car_price',
                                            'orderby'        => 'meta_value_num', // Sort by price
                                            'order'          => 'ASC',
                                        );

                                        $featured_cars = new WP_Query($args);
                                        $unique_prices = [];

                                        if ($featured_cars->have_posts()) :
                                            while ($featured_cars->have_posts()) : $featured_cars->the_post();
                                                $car_price = get_post_meta(get_the_ID(), 'car_price', true); // Get single value
                                                if (!empty($car_price) && !in_array($car_price, $unique_prices)) {
                                                    $unique_prices[] = $car_price; // Store unique prices
                                                }
                                            endwhile;
                                            wp_reset_postdata();
                                        endif;

                                        // Sort prices numerically
                                        sort($unique_prices, SORT_NUMERIC);

                                        // Display options
                                        foreach ($unique_prices as $price) {
                                            $is_selected = ($selected_price == $price) ? ' selected' : ''; // Retain selection
                                            echo '<option value="' . esc_attr($price) . '"' . $is_selected . '>' . esc_html($price) . '</option>';
                                        }
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