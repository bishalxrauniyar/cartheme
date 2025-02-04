<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- meta data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- title of site -->
    <title>CarVilla</title>
    <?php wp_head(); ?>
</head>

<body>
    <!--welcome-hero start -->
    <section id="home" class="welcome-hero">

        <!-- top-area Start -->
        <div class="top-area">
            <div class="header-area">
                <!-- Start Navigation -->
                <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy" data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

                    <div class="container">

                        <!-- Start Header Navigation -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="index.html">carvilla<span></span></a>

                        </div><!--/.navbar-header-->
                        <!-- End Header Navigation -->

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">




                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'header',
                                    'menu_class' => 'nav navbar-nav navbar-right',
                                    'container' => 'ul',
                                )
                            );
                            ?>


                            <!-- <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                                                            <li class=" scroll active"><a href="#home">home</a></li>
                                                            <li class="scroll"><a href="#service">service</a></li>
                                                            <li class="scroll"><a href="#featured-cars">featured cars</a></li>
                                                            <li class="scroll"><a href="#new-cars">new cars</a></li>
                                                            <li class="scroll"><a href="#brand">brands</a></li>
                                                            <li class="scroll"><a href="#contact">contact</a></li>
                                                        </ul>/.nav -->

                        </div><!-- /.navbar-collapse -->
                    </div><!--/.container-->
                </nav><!--/nav-->
                <!-- End Navigation -->
            </div><!--/.header-area-->
            <div class="clearfix"></div>

        </div><!-- /.top-area-->
        <!-- top-area End -->