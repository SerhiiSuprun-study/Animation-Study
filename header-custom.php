<?php
/**
 * Custom Header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Set up Meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta charset="<?php bloginfo('charset'); ?>">

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <!-- Remove Microsoft Edge's & Safari phone-email styling -->
    <meta name="format-detection" content="telephone=no,email=no,url=no">

    <!-- Add external fonts below (GoogleFonts / Typekit) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap">

    <?php wp_head(); ?>
</head>

<body <?php body_class('no-outline'); ?>>
<?php wp_body_open(); ?>

<!-- <div class="preloader hide-for-medium">
	<div class="preloader__icon"></div>
</div> -->

<!-- BEGIN of header -->
<header class="custom-header">
    <div class="header-container menu-grid-container">
        <div class="grid-x">
                <div class="logo text-center medium-text-left">
                    <?php
                    $custom_logo = get_field('our_year_header_logo', 'options');
                    ?>

                    <?php if ($custom_logo): ?>
                        <h1><a href="<?php echo esc_url(home_url('/')); ?>">
                                <img src="<?php echo esc_url($custom_logo['url']); ?>"
                                     alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                            </a>
                            <span class="css-clip"><?php echo get_bloginfo('name'); ?></span></h1>
                    <?php else: ?>
                        <h1><?php show_custom_logo(); ?><span
                                    class="css-clip"><?php echo get_bloginfo('name'); ?></span></h1>
                    <?php endif; ?>

                </div>
            <div class="medium-12 small-12 menu-wrapper">
                <?php $our_year_header_text = get_field('our_year_header_text', 'options');
                $our_year_header_button = get_field('our_year_header_button', 'options');
                if ($our_year_header_text || $our_year_header_button): ?>
                    <div class="top-bar-content">
                        <span class="top-bar-content__text"><?php echo esc_html($our_year_header_text) ?></span>
                        <a href="<?php echo esc_url($our_year_header_button['url']); ?>"
                           target="<?php echo $our_year_header_button['target']; ?>"
                           class="top-bar-content__button"><?php echo $our_year_header_button['title']; ?></a>
                    </div>
                <?php endif; ?>
                <?php if (has_nav_menu('custom-header-menu')) : ?>
                    <div class="title-bar">
                        <div class="custom-title-bar-title">Menu</div>
                        <button class="menu-icon" type="button" aria-label="Menu"><span></span></button>
                    </div>
                    <nav class="custom-top-bar" id="custom-main-menu">
                        <button class="close-button"><i class="fa-solid fa-xmark"></i></button>
                        <?php wp_nav_menu(array(
                            'theme_location' => 'custom-header-menu',
                            'menu_class' => 'menu custom-header-menu',
                            'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown" data-submenu-toggle="true" data-multi-open="false" data-close-on-click-inside="false">%3$s</ul>',
                            'walker' => new Starter_Navigation()
                        )); ?>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<!-- END of header -->
