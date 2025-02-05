<?php
get_header();
?>
</section>
<style>

</style>
<div class="container">
    <div class="single-cars-content">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                $car_model = get_the_terms(get_the_ID(), 'car_model');
                $car_year = get_the_terms(get_the_ID(), 'car_year');
                $car_mileage = get_the_terms(get_the_ID(), 'car_mileage');
                $car_hp = get_the_terms(get_the_ID(), 'car_hp');
                $car_transmission = get_the_terms(get_the_ID(), 'car_transmission');
        ?>
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
                                    </h2>
                                    <p><?php the_content(); ?></p>

                                    <div class="featured-model-info">
                                        <p>
                                            <strong>Model:</strong> <?php echo ($car_year && !is_wp_error($car_year)) ? esc_html($car_year[0]->name) : 'N/A'; ?>
                                            <span class="featured-mi-span">
                                                <strong>Mileage:</strong> <?php echo ($car_mileage && !is_wp_error($car_mileage)) ? esc_html($car_mileage[0]->name) . ' mi' : 'N/A'; ?>
                                            </span>
                                            <span class="featured-hp-span">
                                                <strong>Horsepower:</strong> <?php echo ($car_hp && !is_wp_error($car_hp)) ? esc_html($car_hp[0]->name) . ' HP' : 'N/A'; ?>
                                            </span>
                                            <strong>Transmission:</strong> <?php echo ($car_transmission && !is_wp_error($car_transmission)) ? esc_html($car_transmission[0]->name) : 'N/A'; ?>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <?php
            endwhile;
        else :
            echo '<p>' . __('No car details found', 'textdomain') . '</p>';
        endif;
        ?>
    </div>

    <!-- Contact Form -->
    <form action="#" id="ContactForm" method="post" enctype="multipart/form-data">
        <div class="contact-form-container">
            <h2 class="text-center">Contact Us</h2>
            <table>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input name="name" id="name" type="text" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input name="email" id="email" type="email" required></td>
                </tr>
                <tr>
                    <td><label for="message">Message:</label></td>
                    <td><textarea name="message" id="message" required></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <input name="sub" type="submit" value="Submit" class="btn btn-success">
                    </td>
                </tr>
            </table>
        </div>
    </form>



    <?php
    if (isset($_POST['sub'])) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);

        $to = "rauniyar.bishal@gmail.com";
        $subject = "Contact Form - $name";
        $messageToAdmin = "Name: $name\nEmail: $email\nMessage: $message";
        $headers = "From: $email";

        if (wp_mail($to, $subject, $messageToAdmin, $headers)) {
            echo "<p class='text-success text-center'>Mail Sent Successfully.</p>";
        } else {
            echo "<p class='text-danger text-center'>Mail Not Sent.</p>";
        }
    }
    ?>
</div>

<?php
get_footer();
?>