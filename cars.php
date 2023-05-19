<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Car Details</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/vendor.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script defer src="js/fontawesome/all.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

</head>

<body id="top">


    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader"></div>
    </div>


    <!-- header
    ================================================== -->
    <header class="s-header">
        <div class="row">

            <div class="s-header__logo">
                <a href="index.php">
                    <img src="images/logo.png" alt="Homepage">
                </a>
            </div>


            <nav class="s-header__nav">
                <ul>
                    <li><a href="index.php" target="_self">Home</a></li>
                    <li class="current"><a class="smoothscroll car-name" href="#home"></a></li>
                    <li><a class="smoothscroll" href="#details">Details</a></li>
                    <li><a class="smoothscroll" href="#buy-now">Buy Now</a></li>
                    <li><a href="account.php" style="color: #3ce6ec">My Account</a></li>
                </ul>
            </nav>

            <a class="s-header__menu-toggle" href="#0" title="Menu">
                <span class="s-header__menu-icon"></span>
            </a>

        </div> <!-- end row -->
    </header> <!-- end s-header -->

    <!-- home
    ================================================== -->
    <section id="home" class="s-home target-section car-bg" data-parallax="scroll" data-natural-width="3000" data-natural-height="2000">

        <div class="s-home__content">

            <div class="s-home__slider">

                <div class="s-home__slide s-home__slide--1">
                    <div class="row">
                        <div class="column large-12 s-home__slide-text">
                            <h2>
                             <span class="car-name"></span>.
                            </h2>
                            <p class="car-subtitle"></p>
                        </div>
                    </div>
                </div> <!-- end s-home__slide -->

            </div> <!-- end s-home__slider -->

        </div> <!-- end s-home__content -->

    </section> <!-- end s-home -->


    <!-- Details
    ================================================== -->
    <section id="details" class="s-services target-section s-dark">

        <div class="row section-head">
            <div class="column large-3 medium-12" data-aos="fade-up">
                <h2>Details</h2>
                <p class="desc car-name">Discover more about the </p>
            </div>

            <div class="column large-8 medium-12 align-x-right" data-aos="fade-up">
                <p class="car-desc lead">
            </div>
        </div> <!-- end section-head -->
       
        <div class="column large-6 row h-add-bottom" data-aos="fade-up">
            <ul class="disc">
                <li class="car-d-1"></li>
                <li class="car-d-2"></li>
                <li class="car-d-3"></li>
                <li class="car-d-4"></li>
                <li class="car-d-5"></li>
            </ul>
        </div>

    </section> <!-- end details -->



    <!-- buy now
    ================================================== -->
    <section id="buy-now" class="s-buynow target-section s-dark">

        <div class="row section-head">
            <div class="column large-12 medium-12">
                <h2 class="display-1">How To Buy</h2>
                <p class="car-price desc"></p>
            </div>
        </div> <!-- end section-head -->

                <h3 class="column">
                    <a href="#" id=financing-link>
                        Have a look at our financing options
                    </a>
                </h3>

                <h3 class="column">
                    <a href="#" id=purchase-link>
                        Purchase now
                    </a>
                </h3>

    </section> <!-- end s-buynow -->

        <!-- contact
    ================================================== -->
    <section id="contact" class="s-contact target-section s-dark">

        <div class="row section-head">
            <div class="column large-3 medium-12">
                <h2>Contact Us</h2>
                <p class="desc">Get in touch with us.</p>
            </div>
        </div> <!-- end section-head -->

        <div class="row s-contact__content">

            <div class="column large-7 medium-12">
                <h3 class="display-1">
                    Our customer support team are ready 24/7 to help you with anything you are
                    having trouble with!
                </h3>
            </div>

            <div class="column large-4 medium-12 s-contact__info-blocks">
                <div class="row">
                    <div class="column large-12 medium-6 tab-12">
                        <div class="s-contact__info-block">

                            <span class="s-contact__info-block-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                                    <path
                                        d="M12 14c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2z" />
                                    <path
                                        d="M11.42 21.814a.998.998 0 001.16 0C12.884 21.599 20.029 16.44 20 10c0-4.411-3.589-8-8-8S4 5.589 4 9.995c-.029 6.445 7.116 11.604 7.42 11.819zM12 4c3.309 0 6 2.691 6 6.005.021 4.438-4.388 8.423-6 9.73-1.611-1.308-6.021-5.294-6-9.735 0-3.309 2.691-6 6-6z" />
                                </svg>
                            </span>

                            <h5>Find us here</h5>
                            <p>
                                Global Finance HQ <br>
                                Coventry <br>
                                CV4 7AL, UK
                            </p>
                        </div> <!-- end s-contact__info-block -->
                    </div>

                    <div class="column large-12 medium-6 tab-12">
                        <div class="s-contact__info-block">
                            <span class="s-contact__info-block-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                                    <path
                                        d="M17.707 12.293a.999.999 0 00-1.414 0l-1.594 1.594c-.739-.22-2.118-.72-2.992-1.594s-1.374-2.253-1.594-2.992l1.594-1.594a.999.999 0 000-1.414l-4-4a.999.999 0 00-1.414 0L3.581 5.005c-.38.38-.594.902-.586 1.435.023 1.424.4 6.37 4.298 10.268s8.844 4.274 10.269 4.298h.028c.528 0 1.027-.208 1.405-.586l2.712-2.712a.999.999 0 000-1.414l-4-4.001zm-.127 6.712c-1.248-.021-5.518-.356-8.873-3.712-3.366-3.366-3.692-7.651-3.712-8.874L7 4.414 9.586 7 8.293 8.293a1 1 0 00-.272.912c.024.115.611 2.842 2.271 4.502s4.387 2.247 4.502 2.271a.991.991 0 00.912-.271L17 14.414 19.586 17l-2.006 2.005z" />
                                </svg>
                            </span>

                            <h5>Say hello</h5>
                            <p>
                                hello@globalfinance.com <br>
                                +44 7027 854172
                            </p>
                        </div> <!-- end s-contact__info-block -->
                    </div>
                </div> <!-- end row -->
            </div> <!-- end s-contact__info-blocks -->

        </div> <!-- end s-contact__content -->

    </section> <!-- end s-contact -->


    <!-- footer
    ================================================== -->
    <footer class="s-footer">
        <div class="row">

            <div class="column large-7 medium-6 w-1000-stack ss-copyright">
                 
                <span>Design by <a href="https://www.styleshout.com/">StyleShout</a></span>
            </div>
        </div>

        <div class="ss-go-top">
            <a class="smoothscroll" title="Back to Top" href="#top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6 4h12v2H6zm5 10v6h2v-6h5l-6-6-6 6z"/></svg>
            </a>
        </div> <!-- end ss-go-top -->
    </footer>


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script src="js/cars.js"></script>
    

</body>

</html>