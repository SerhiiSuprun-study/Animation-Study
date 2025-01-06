<?php
/**
 * Template Name: Our Year
 */
get_header('custom'); ?>
    <main class="our-year-main">
        <?php $banner_background = get_field('banner_background');
        $banner_title = get_field('banner_title');
        $banner_text = get_field('banner_text');
        if ($banner_background || $banner_title || $banner_text): ?>
            <section class="our-year__banner" <?php bg($banner_background); ?>>
                <div class="our-year__banner__text-wrapper">
                    <div class="banner-text">
                        <h5><?php echo esc_html($banner_title); ?></h5>
                        <?php echo $banner_text; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <section class="test-git">

        </section>
        <?php $about_text = get_field('about_text');
        $about_people = get_field('about_people');
        $about_ceo_title = get_field('about_ceo_title');
        $about_ceo_text = get_field('about_ceo_text');
        if ($about_text || $about_people || $about_ceo_title || $about_ceo_text): ?>

            <section class="about">
                <div class="grid-container">
                    <div class="about-text">
                        <?php echo $about_text; ?>
                    </div>
                    <div class="about-people">
                        <?php foreach ($about_people as $row):
                            $image = $row['phpto'];
                            $title = $row['name'];
                            $text = $row['prof'];
                            ?>
                            <div class="about-people-item">
                                <img src="<?php echo esc_url($image['url']); ?>"
                                     alt="<?php echo esc_attr($image['alt']); ?>"/>
                                <h5><?php echo esc_html($title); ?></h5>
                                <p><?php echo esc_html($text); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="about-ceo">
                        <div class="ceo-left">
                            <h3><?php echo esc_html($about_ceo_title); ?></h3>
                        </div>
                        <div class="ceo-right">
                            <?php echo $about_ceo_text; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <section class="rising-logo">
            <div class="grid-container">
                <?php $rising_comeents = get_field('rising_comeents');
                if ($rising_comeents):
                    ?>
                    <div class="logo-slider">
                        <?php foreach ($rising_comeents as $row):
                            $title = $row['title'];
                            $subtitle = $row['subtitle'];
                            $image = $row['image'];
                            ?>
                            <div class="logo-item">
                                <h4><?php echo esc_html($title); ?></h4>
                                <h5><?php echo esc_html($subtitle); ?></h5>
                                <img src="<?php echo esc_url($image['url']); ?>"
                                     alt="<?php echo esc_attr($image['alt']); ?>"/>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
<?php get_footer(); ?>