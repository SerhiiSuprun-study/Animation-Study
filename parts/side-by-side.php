<?php
$strip_bg              = get_field( 'strip_background' );
$main_color            = get_field( 'main_color' );
$sub_color             = get_field( 'sub_color' );
$img_position_on_right = get_field( 'img_position' );
$reverse               = $img_position_on_right ? get_row_index() % 2 : ! get_row_index() % 2;
?>
<?php if ( have_rows( 'sbs_blocks' ) ): ?>
	<section class="sbs-blocks">
		<?php while ( have_rows( 'sbs_blocks' ) ): the_row(); ?>
			<?php $row_color = $reverse ? $main_color : $sub_color; ?>
			<div class="sbs-block <?php echo $reverse ? '' : 'sbs-block--reverse'; ?>"
				<?php echo $strip_bg ? "style='background-color:{$row_color}'" : ''; ?>>
				
				<div class="grid-container">
					<div class="grid-x grid-padding-x align-middle <?php echo $reverse ? '' : 'flex-dir-row-reverse'; ?>">
						<div class="cell medium-6 sbs-block__img-wrap">
							<?php $block_image = get_sub_field( 'block_image' ); ?>
							<?php echo wp_get_attachment_image( $block_image['ID'] ?? 0, 'medium_large', false, array( 'class' => 'sbs-block__img of-cover' ) ); ?>
						</div>
						<div class="cell medium-6 sbs-block__content-wrap">
							<div class="sbs-block__content">
								<div class="sbs-block__content-inner">
									<?php the_sub_field( 'block_content' ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			
			</div>
		<?php endwhile; ?>
	</section>
<?php endif; ?>
