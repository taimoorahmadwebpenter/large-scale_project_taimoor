<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('inc/head.php'); ?>
</head>
<body>
    <div class="nav-area header-type-1">
        <!-- desktop nav -->
        <header class="header-nav hidden-sm hidden-xs">
            <div class="container">
                <div class="header-inner table-block">
                    <div class="header-comp-logo">
                        <?php include ('inc/header/logo.php'); ?>
                    </div>
                    <div class="header-comp-nav text-left">
                        <?php include ('inc/header/main-nav.php'); ?>
                    </div>
                    <div class="header-comp-right">
                        <?php include ('inc/header/login-register-v1.php'); ?>
                    </div>
                </div>
            </div>
        </header>
        <!-- mobile header -->
        <?php include ('inc/header/header-mobile.php'); ?>

        <!-- desktop and tablet search -->
        <?php //include ('inc/header-1-search.php'); ?>
        <?php //include ('inc/header-1-search-mobile.php'); ?>
    </div>
    
    <section class="top-banner-wrap">    

        <div id="video-background" class="video-background" data-vide-bg="mp4: video/ocean, webm: video/ocean, ogv: http://localhost/homey-html/video/ocean, poster: video/ocean" data-vide-options="position: 0% 50%">
        </div>

        <div class="banner-caption">

            <h1 class="banner-title">Book and Experience Unique Places</h1>
            <p class="banner-subtitle">WordPress Theme For Rentals</p>

            <?php include ('inc/search/search-for-banners.php'); ?>

        </div><!-- banner-caption -->

    </section><!-- header-parallax -->

    <section class="main-content-area" style="height: 1000px;">
        <!-- Page content goes here  -->
    </section><!-- main-content-area -->

    <?php include ('inc/scripts.php'); ?>
    <?php include ('inc/footer.php'); ?>
</body>
</html>