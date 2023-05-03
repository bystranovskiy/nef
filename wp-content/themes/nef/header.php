<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NRK36KJ568"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-NRK36KJ568');
    </script>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php $fonts_google = 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap'; ?>
    <!-- connect to domain of font files -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- optionally increase loading priority -->
    <link rel="preload" as="style" href=<?php echo $fonts_google; ?>>
    <!-- async CSS -->
    <link rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');"
          href="<?php echo $fonts_google; ?>">
    <!-- no-JS fallback -->
    <noscript>
        <link rel="stylesheet" href="<?php echo $fonts_google; ?>">
    </noscript>
    <?php wp_head(); ?>
    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '770230924717972');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=770230924717972&ev=PageView&noscript=1"/></noscript>
    <!-- End Meta Pixel Code -->
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
    <div class="container">
        <div class="inner-wrapper py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <?php if (function_exists('the_custom_logo')) {
                        the_custom_logo();
                    } ?>
                </div>
                <div class="col d-lg-block mobile-menu">
                    <div class="row flex-column flex-lg-row align-items-center flex-nowrap h-100">
                        <div class="col pb-3 pt-5 py-lg-0">
                            <?php wp_nav_menu(array('theme_location' => 'header-menu', 'menu_class' => 'menu menu-header')); ?>
                        </div>
                        <div class="col-auto py-3 py-lg-0">
                            <form class="search-form brd brd-rad-m" action="<?php echo get_site_url() . '/search/'; ?>" method="get">
                                <button class="icon-search" type="submit"></button>
                                <?php if ($_GET["categories"]) { ?>
                                    <input type="hidden" name="categories" value="<?php echo $_GET["categories"]; ?>">
                                <?php } ?>
                                <input class="brd-rad-m" name="text" type="text" value="<?php echo $_GET["text"] ?: '' ?>"
                                       placeholder="<?php echo __("Пошук", THEME_NAME); ?>">
                            </form>
                        </div>
                        <div class="col-auto py-3 pb-5 py-lg-0">
                            <a href="/apply/" class="link"><?php echo __("У мене є ідея", THEME_NAME); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-auto d-lg-none">
                    <div class="mobile-menu-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
