<?php
/**
 * Template Name: Home Page
 */
get_header(); ?>

    <section class="scroll-button section">
        <div class="greed-container">
            <h2><?php echo esc_html(get_field('scroll_button_title')); ?></h2>
            <div class="button-container">
                <a class="arrow-down" href="#banner"><span><?php _e('Arrow') ?></span></a>
            </div>
        </div>
    </section>
    <section id="banner" class="banner section">
    </section>
    <section class="infographic section">
        <div class="grid-container">
            <?php if (have_rows('infographic_repeater')): ?>
                <div id="repeater-container" class="repeater-container">
                    <h2><?php echo esc_html(get_field('infographic_repeater_title')); ?></h2>
                    <div class="left-column">

                        <?php
                        $counter = 0;
                        while (have_rows('infographic_repeater')):
                        the_row();
                        $title = get_sub_field('title');
                        $text = get_sub_field('text');

                        $counter++;

                        if ($counter == 4): ?>
                    </div>
                    <div class="right-column">
                        <div class="field-item">
                            <?php if ($title): ?>
                                <h5 class="item-title"><?php echo esc_html($title); ?></h5>
                            <?php endif; ?>
                            <div class="text">
                                <p><?php echo $text; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                        <div class="field-item">
                            <?php if ($title): ?>
                                <h5 class="item-title"><?php echo esc_html($title); ?></h5>
                            <?php endif; ?>
                            <p><?php echo $text; ?></p>
                        </div>
                    <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php $principle_repeater = get_field('section_repeater');
if ($principle_repeater):?>
    <section id="principle" class="principle">

        <?php $i = 1;
        foreach ($principle_repeater as $section):
            $list = $section['left_side_list'];
            $title = $section['section_title'];
            $first_text = $section['first_text'];
            $second_text = $section['second_text'];
            ?>
            <div class="repeater-section">
                <div class="grid-container">
                    <div class="content-wrapper content-wrapper-<?php echo $i; ?>">
                        <div class="left col-con">
                            <?php if ($list): ?>
                                <ul>
                                    <?php foreach ($list as $list_item):
                                        $list_item_title = $list_item['title'];
                                        ?>
                                        <li>
                                            <?php echo esc_html($list_item_title); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div class="center col-con">
                            <h2><?php echo esc_html($title); ?></h2>
                            <?php echo $first_text; ?>
                        </div>
                        <div class="right col-con">
                            <?php echo $second_text; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++; endforeach; ?>

    </section>
<?php endif; ?>
    <section class="what-can-you-do">
        <div class="grid-container">
            <div class="what-content-wrapper">
                <h2><?php _e('What you can
do today.') ?></h2>
            </div>
        </div>
    </section>
<?php $cso_title = get_field('cso_title');
$cso_text_first = get_field('cso_text_first');
$cso_text_second = get_field('cso_text_second');
$cso_text_third = get_field('cso_text_third');
$cso_text_fourth = get_field('cso_text_fourth');
if ($cso_title || $cso_text_first || $cso_text_second || $cso_text_third || $cso_text_fourth): ?>
    <section class="cso">
        <div class="grid-container">
            <div class="cso-container">
                <?php if ($cso_title): ?>
                    <h3><?php echo esc_html($cso_title); ?></h3>
                <?php endif; ?>
                <?php if ($cso_text_first): ?>
                    <?php echo $cso_text_first; ?>
                <?php endif; ?>
                <div class="center-container">
                    <div class="left">
                        <?php if ($cso_text_second): ?>
                            <?php echo $cso_text_second; ?>
                        <?php endif; ?>
                    </div>
                    <div class="right">
                        <?php if ($cso_text_third): ?>
                            <?php echo $cso_text_third; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($cso_text_fourth): ?>
                    <?php echo $cso_text_fourth; ?>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php endif; ?>
    <section class="download">
        <div class="content-wrapperr download-content-wrapper">
            <div class="left">
                <?php echo do_shortcode('[gravityform id="7" title="true" description="false" ajax="true"]'); ?>
            </div>
            <div class="right">
                <?php if ($image = get_field('download_image')): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="numbers">
        <div class="numbers-wrapper" style="padding-top: 15vh;">
            <div class="numbers-container">
                <div class="numbers-info">
                    <?php if ($title = get_field('numbers_title')): ?>
                        <h2><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>
                    <?php if ($text = get_field('numbers_text')): ?>
                        <?php echo $text; ?>
                    <?php endif; ?>
                </div>

                <?php if ($repeater = get_field('numbers_repeater')): ?>
                    <div class="numbers-counter">
                        <?php foreach ($repeater as $row):
                            $number = $row['number'];
                            $text = $row['text'];
                            ?>
                            <div class="numbers-item">
                                <h2><span class="counter"
                                          data-count="<?php echo $number; ?>">0</span><span><?php _e('%') ?></span></h2>
                                <p>p<?php echo $text; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php $faq_title = get_field('faq_title');
$faq_repeater = get_field('faq_repeater');
if ($faq_title || $faq_repeater):?>
    <section class="faq">
        <div class="grid-container">
            <div class="faq-wrapper">
                <?php if ($faq_title): ?>
                    <h3><?php echo $faq_title; ?></h3>
                <?php endif; ?>

                <?php if ($faq_repeater): ?>
                    <div class="accordion" data-accordion data-allow-all-closed="true">
                        <?php foreach ($faq_repeater as $row):
                            $title = $row['title'];
                            $text = $row['text']; ?>
                            <div class="accordion-item <?php echo get_row_index() == 0 ? 'is-active' : ''; ?>"
                                 data-accordion-item>
                                <a href="#" class="accordion-title"><?php echo $title; ?></a>
                                <div class="accordion-content" data-tab-content>
                                    <?php echo $text; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php $about_us_title = get_field('about_us_title');
$about_us_subtitle = get_field('about_us_subtitle');
$about_us_text = get_field('about_us_text');
$about_us_logos = get_field('about_us_logos');
if ($about_us_title || $about_us_subtitle || $about_us_text || $about_us_logos):?>
    <section class="about">
        <div class="grid-container">
            <div class="about-wrapper">
                <div class="about-left">
                    <?php if ($about_us_title): ?>
                        <h2><?php echo esc_html($about_us_title); ?></h2>
                    <?php endif; ?>
                    <?php if ($about_us_subtitle): ?>
                        <h5><?php echo esc_html($about_us_subtitle); ?></h5>
                    <?php endif; ?>
                </div>
                <div class="about-right">
                    <?php if ($about_us_text): ?>
                        <?php echo $about_us_text; ?>
                    <?php endif; ?>
                </div>

                <div class="about-gallery">
                    <?php
                    if ($about_us_logos):
                        $size = 'full';
                        ?>
                        <div class="gallery-container">
                            <?php foreach ($about_us_logos as $image_id): ?>
                                <div class="gallery-image">
                                    <?php echo wp_get_attachment_image($image_id, $size); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php $tab_repeater = get_field('tab_repeater');
if ($tab_repeater):
    ?>
    <section class="custom-tabs">
        <div class="grid-container">
            <div class="data-tabs">
                <a href="#" class="data-tabs__overview"><?php _e('Overview') ?></a>
                <div class="data-tabs__row">
                    <?php
                    $classes = [
                        1 => 'green',
                        2 => 'pink',
                        3 => 'purple',
                        4 => 'lime',
                        5 => 'blue'
                    ];
                    $i = 1;
                    foreach ($tab_repeater as $row):
                        $icon = $row['tab_title_icon'];
                        $title = $row['tab_title'];
                        $custom_class = isset($classes[$i]) ? $classes[$i] : '';
                        ?>
                        <button
                           class="data-tabs__item <?php echo $i === 1 ? 'active' : ''; ?> <?php echo $custom_class; ?>"
                           data-index="<?php echo $i; ?>">
                            <img src="<?php echo esc_url($icon['url']); ?>"
                                 alt="<?php echo esc_attr($icon['alt']); ?>"/>
                            <span><?php echo esc_html($title); ?></span>
                        </button>
                        <?php
                        $i++;
                    endforeach;
                    ?>
                </div>
                <div class="data-tabs__main">
                    <div class="mainTabContent__nav__wrap">
                        <?php $i = 1;
                        foreach ($tab_repeater as $row):
                            $main_tab_content_head = $row['main_tab_content_head'];
                            $main_tab_content_gallery = $row['main_tab_content_gallery'];
                            $subtab_repeater = $row['subtab_repeater'];
                            ?>

                            <?php if ($subtab_repeater) : ?>
                            <ul class="mainTabContent__nav <?php echo $i === 1 ? 'active' : ''; ?>"
                                data-index="<?php echo $i; ?>">
                                <?php $a = 1;
                                foreach ($subtab_repeater as $subrow):
                                    $subtab_subrepeater = $subrow['subtab_subrepeater'];
                                    $subtab_title = $subrow['subtab_title'];
                                    ?>
                                    <li class="mainTabContent__subNav" data-index="<?php echo($i . '.' . $a); ?>">
                                        <a  href="#"><?php echo $subtab_title; ?></a>
                                        <?php if ($subtab_subrepeater): ?>
                                            <ul class="mainTabContent__subNav__wrap">
                                                <?php $f = 1;
                                                foreach ($subtab_subrepeater as $subSubRow):
                                                    $title = $subSubRow['title'];
                                                    ?>
                                                    <li class="mainTabContent__subNav__item"
                                                        data-index="<?php echo($i . '.' . $a . '.' . $f); ?>">
                                                        <a href=""><?php echo $title; ?></a></li>
                                                    <?php $f++; endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                    <?php $a++; endforeach; ?>
                            </ul>
                        <?php endif; ?>
                            <?php $i++; endforeach; ?>
                    </div>
                    <div class="mainTabContent__content">
                        <?php $i = 1;
                        foreach ($tab_repeater as $row):
                            $main_tab_content_head = $row['main_tab_content_head'];
                            $main_tab_content_gallery = $row['main_tab_content_gallery'];
                            $subtab_repeater = $row['subtab_repeater'];
                            ?>
                            <div class="mainTabContent__content__item mainTab__item <?php echo $i === 1 ? 'active' : ''; ?>"
                                 data-index="<?php echo $i; ?>">
                                <div class="data-tabs__header">
                                    <div class="data-tabs__intro">
                                        <?php if ($main_tab_content_head) : ?>
                                            <?php echo $main_tab_content_head; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="data-tabs__toolbar">
                                        <div class="data-tabs__toolbar__share">
                                            <span><?php _e('Share:') ?></span><?php get_template_part('parts/socials'); // Social profiles
                                            ?>
                                        </div>
                                        <div class="data-tabs__toolbar__fullscreen">
                                            <?php _e('View fullscreen:') ?> <button class="view-fulscreen" id="view-fulscreen"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="data-tabs__image">
                                    <?php
                                    $size = 'full';
                                    if ($main_tab_content_gallery): ?>
                                        <div class="tabs-images">
                                            <?php foreach ($main_tab_content_gallery as $image_id): ?>
                                                <div class="tabs-image">
                                                    <?php echo wp_get_attachment_image($image_id, $size); ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if ($subtab_repeater): ?>
                            <?php $a = 1;
                            foreach ($subtab_repeater as $subrow) :
                                $subtab_content_head = $subrow['subtab_content_head'];
                                $subtab_gallery = $subrow['subtab_gallery'];
                                $subtab_subrepeater = $subrow['subtab_subrepeater'];
                                ?>
                                <div class="mainTabContent__content__item AccSingleTab__item"
                                     data-index="<?php echo($i . '.' . $a); ?>">
                                    <div class="data-tabs__header">
                                        <div class="data-tabs__intro">
                                            <?php if ($subtab_content_head) : ?>
                                                <?php echo $subtab_content_head; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="data-tabs__toolbar">
                                            <div class="data-tabs__toolbar__share">
                                                <span><?php _e('Share:') ?></span><?php get_template_part('parts/socials'); // Social profiles
                                                ?>
                                            </div>
                                            <div class="data-tabs__toolbar__fullscreen">
                                                <?php _e('View fullscreen:') ?> <button class="view-fulscreen" id="view-fulscreen"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data-tabs__image">
                                        <?php
                                        $size = 'full';
                                        if ($subtab_gallery): ?>
                                            <div class="tabs-images">
                                                <?php foreach ($subtab_gallery as $image_id): ?>
                                                    <div class="tabs-image">
                                                        <?php echo wp_get_attachment_image($image_id, $size); ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php $f = 1;
                                foreach ($subtab_subrepeater as $subSubRow) :
                                    $content_head = $subSubRow['content_head'];
                                    $content_gallery = $subSubRow['content_gallery'];
                                    ?>
                                    <div class="mainTabContent__content__item AccSubTab__item"
                                         data-index="<?php echo($i . '.' . $a . '.' . $f); ?>">
                                        <div class="data-tabs__header">
                                            <div class="data-tabs__intro">
                                                <?php if ($content_head) : ?>
                                                    <?php echo $content_head; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="data-tabs__toolbar">
                                                <div class="data-tabs__toolbar__share">
                                                   <?php _e('Share:') ?><?php get_template_part('parts/socials'); // Social profiles
                                                    ?>
                                                </div>
                                                <div class="data-tabs__toolbar__fullscreen">
                                                    <?php _e('View fullscreen:') ?> <button class="view-fulscreen" id="view-fulscreen"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="data-tabs__image">
                                            <?php
                                            $size = 'full';
                                            if ($content_gallery): ?>
                                                <div class="tabs-images">
                                                    <?php foreach ($content_gallery as $image_id): ?>
                                                        <div class="tabs-image">
                                                            <?php echo wp_get_attachment_image($image_id, $size); ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php $f++; endforeach; ?>
                                <?php $a++; endforeach; ?>
                        <?php endif; ?>
                            <?php $i++;endforeach; ?>
                    </div>
                    <div class="overview-container">
                        <?php
                        $image = get_field('tab_overview_image');
                        if (!empty($image)): ?>
                            <img src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php get_footer(); ?>