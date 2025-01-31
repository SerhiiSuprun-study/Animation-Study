<?php
/**
 * Page
 */
get_header(); ?>

	<main class="main-content">
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<!-- BEGIN of page content -->
				<div class="large-12 medium-12 small-12 cell">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<article <?php post_class( 'entry' ); ?>>
								<h1 class="page-title entry__title"><?php the_title(); ?></h1>
								<?php if ( has_post_thumbnail() ) : ?>
									<div title="<?php the_title_attribute(); ?>" class="entry__thumb">
										<?php the_post_thumbnail( 'large' ); ?>
									</div>
								<?php endif; ?>
								<div class="entry__content gb-content">
									<?php the_content( '', true ); ?>
								</div>
							</article>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
				<!-- END of page content -->
			</div>
		</div>
	</main>

<?php get_footer(); ?>