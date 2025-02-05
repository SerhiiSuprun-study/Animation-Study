<?php

// Register Post Type Slider
function post_type_slider() {
	$post_type_slider_labels = array(
		'name'               => _x( 'Slider', 'post type general name', 'default' ),
		'singular_name'      => _x( 'Slide', 'post type singular name', 'default' ),
		'add_new'            => _x( 'Add New', 'slide', 'default' ),
		'add_new_item'       => __( 'Add New Slide', 'default' ),
		'edit_item'          => __( 'Edit Slide', 'default' ),
		'new_item'           => __( 'New Slide', 'default' ),
		'all_items'          => __( 'All Slides', 'default' ),
		'view_item'          => __( 'View Slide', 'default' ),
		'search_items'       => __( 'Search Slides', 'default' ),
		'not_found'          => __( 'No slides found.', 'default' ),
		'not_found_in_trash' => __( 'No slides found in Trash.', 'default' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Slider',
	);
	$post_type_slider_args   = array(
		'labels'        => $post_type_slider_labels,
		'description'   => 'Display Slider',
		'public'        => false,
		'show_ui'       => true,
		'menu_icon'     => 'dashicons-format-gallery',
		'menu_position' => 5,
		'supports'      => array(
			'title',
			'thumbnail',
			'page-attributes',
			'editor',
			'post-formats',
		),
		'has_archive'   => false,
		'hierarchical'  => true,
	);
	register_post_type( 'slider', $post_type_slider_args );
	add_theme_support( 'post-formats', array( 'video' ) );
	remove_post_type_support( 'post', 'post-formats' );
}

add_action( 'init', 'post_type_slider' );

// Add Video background Metabox to slider post type
add_action( 'add_meta_boxes', 'slide_background_metabox' );

function slide_background_metabox() {
	$screens = array( 'slider' );
	add_meta_box( 'slide_background', __( 'Slide background', 'default' ), 'slider_background_callback', $screens );
}

function slider_background_callback( $post, $meta ) {
	wp_nonce_field( 'save_video_bg', 'project_nonce' );
	?>
	<style>
		.fields-list {
			margin-left: -12px;
			margin-right: -12px;
		}

		.fields-list::after {
			content: '';
			display: table;
			clear: both;
		}

		.field-wrap {
			float: left;
			padding-left: 12px;
			padding-right: 12px;
			box-sizing: border-box;
		}
	</style>
	<div class="fields-list">
		<div class="field-wrap" style="width: 70%">
			<p class="label-wrapper"><label for="slide_video"
			                                style="display: block;"><b><?php _e( 'Video background', 'default' ); ?></b></label><em><?php _e( 'Enter here link to the video from Media Library, YouTube or Vimeo', 'default' ); ?></em>
			</p>
			<input type="text" id="slide_video" name="slide_video_bg" value="<?php echo get_post_meta( $post->ID, 'slide_video_bg', true ); ?>"
			       style="width: 100%;"/>
		</div>
		<div class="field-wrap" style="width: 30%">
			<p class="label-wrapper"><label for="video_aspect_ratio" style="display: block;"><b><?php _e( 'Video aspect ratio', 'default' ); ?></b></label></p>
			<?php
			$aspect_ratio = get_post_meta( $post->ID, 'video_aspect_ratio', true ) ?: '16:9';
			$ratio_list   = array( '16:9', '4:3', '2.39:1' );
			?>
			<select name="video_aspect_ratio" id="video_aspect_ratio" style="width: 100%;">
				<?php foreach ( $ratio_list as $item ): ?>
					<option value="<?php echo $item; ?>" <?php selected( $aspect_ratio, $item ); ?>><?php echo $item; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="clearfix" style="clear:both"></div>
	</div>
	<?php
}

/**
 * Update slide background on slide save
 */

add_action( 'save_post', 'save_slide_background' );

function save_slide_background( $post_id ) {

	if ( ! isset( $_POST['slide_video_bg'] ) && ! isset( $_POST['video_aspect_ratio'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['project_nonce'], 'save_video_bg' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	update_post_meta( $post_id, 'video_aspect_ratio', $_POST['video_aspect_ratio'] );
	update_post_meta( $post_id, 'slide_video_bg', $_POST['slide_video_bg'] );

}

/**
 * Print script to hande appearance of metabox
 */
//add_action('admin_enqueue_scripts','display_metaboxes');
add_action( 'admin_footer', 'display_metaboxes' );

function display_metaboxes() {

	if ( get_post_type() == "slider" ) :
		?>
		<script type="text/javascript">
			document.addEventListener('DOMContentLoaded', function() {
				function displayMetaboxe() {
					document.getElementById('slide_background').style.display = 'none';
					let selectedFormat = document.querySelector("input[name='post_format']:checked").value;
					if (selectedFormat === 'video') {
						document.getElementById('slide_background').style.display = 'block';
					}
				}

				displayMetaboxe();

				document.querySelectorAll("input[name='post_format']").forEach(function(input) {
					input.addEventListener('change', displayMetaboxe);
				});
			});
		</script>
	<?php
	endif;
}

// Create HOME Slider
function home_slider_template() { ?>
	
	<script>

		// Send command to iframe YouTube or Vimeo player
		function postMessageToPlayer( player, command ) {
			if ( player == null || command == null ) return;
			let commandObj = null;
			
			if (player.src.indexOf('vimeo') !== -1) {
				// Vimeo
				commandObj = {
					method: command,
				};
			} else {
				// Youtube
				commandObj = {
					event: 'command',
					func: `${command}Video`,
				};
			}

			player.contentWindow.postMessage(JSON.stringify(commandObj), '*');
		}

		jQuery( document ).ready( function() {
			const $homeSlider = jQuery( '#home-slider' );

			$homeSlider
				.on( 'init', function( event, slick ) {
					slick.$slides.not( ':eq(0)' ).find( '.video-holder__media--local' ).each( function() {
						this.pause();
					} );

					if ( slick.$slides.eq( 0 ).find( '.video-holder__media--local' ).length ) {
						slick.$slides.eq( 0 ).find( '.video-holder__media--local' )[0].play();
					}
					if ( slick.$slides.eq( 0 ).find( '.video-holder__media--embed' ).length ) {
						const player = slick.$slides.eq( 0 ).find( 'iframe' ).get(0);
						postMessageToPlayer( player, 'play' );
					}
				} )
				.on( 'beforeChange', function( event, slick, currentSlide, nextSlide ) {
					// Pause youtube video on slide change
					if ( slick.$slides.eq( currentSlide ).find( '.video-holder__media--embed' ).length ) {
						const player = slick.$slides.eq( currentSlide ).find( 'iframe' ).get( 0 );
						postMessageToPlayer( player, 'pause' );
					}
					// Pause local video on slide change
					if ( slick.$slides.eq( currentSlide ).find( '.video-holder__media--local' ).length ) {
						slick.$slides.eq( currentSlide ).find( '.video-holder__media--local' )[0].pause();
					}

				} )
				.on( 'afterChange', function( event, slick, currentSlide ) {
					// Start playing local video on current slide
					if ( slick.$slides.eq( currentSlide ).find( '.video-holder__media--local' ).length ) {
						slick.$slides.eq( currentSlide ).find( '.video-holder__media--local' )[0].play();
					}

					// Start playing youtube video on current slide
					if ( slick.$slides.eq( currentSlide ).find( '.video-holder__media--embed' ).length ) {
						const player = slick.$slides.eq( currentSlide ).find( 'iframe' ).get( 0 );
						postMessageToPlayer( player, 'play' );
					}

				} );

			if ( typeof jQuery.fn.slick !== 'undefined' ) {
				$homeSlider.slick( {
					cssEase: 'ease',
					fade: true,  // Cause trouble if used slidesToShow: more than one
					// arrows: false,
					dots: true,
					infinite: true,
					speed: 500,
					autoplay: true,
					autoplaySpeed: 5000,
					slidesToShow: 1,
					slidesToScroll: 1,
					draggable: false, // Disable mouse dragging
					rows: 0, // Prevent generating extra markup
					slide: '.slick-slide', // Cause trouble with responsive settings
				} );
			}
		} );
	</script>

	<?php $arg = array(
		'post_type'      => 'slider',
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'post_status'    => 'publish',
		'posts_per_page' => 10,
	);
	$slider    = new WP_Query( $arg );
	if ( $slider->have_posts() ) : ?>
		
		<div id="home-slider" class="slick-slider home-slider">
			<?php while ( $slider->have_posts() ) : $slider->the_post(); ?>
				<div class="slick-slide home-slide">
					
					<div class="home-slide__inner rel-wrap">
						<?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'full_hd', false, array( 'class' => 'stretched-img home-slide__bg' ) ); ?>
						<?php $bg_video_url = get_post_meta( get_the_ID(), 'slide_video_bg', true ); ?>
						<?php if ( get_post_format() == 'video' && $bg_video_url ): ?>
							<div class="video-holder show-for-large" data-ratio="<?php echo get_post_meta( get_the_ID(), 'video_aspect_ratio', true ) ?: '16:9'; ?>">
								<?php
								$allowed_video_format = array(
									'webm' => 'video/webm',
									'mp4'  => 'video/mp4',
									'ogv'  => 'video/ogg',
								);
								$file_info            = wp_check_filetype( $bg_video_url, $allowed_video_format );
								if ( $file_info['ext'] ): ?>
									<video src="<?php echo $bg_video_url; ?>" autoplay preload="none" playsinline muted="muted" loop="loop"
									       class="video-holder__media video-holder__media--local"></video>
								<?php elseif ( is_embed_video( $bg_video_url ) ): ?>
									<div class="video-holder__media video-holder__media--embed responsive-embed widescreen">
										<?php echo wp_oembed_get( $bg_video_url, array( 'location' => 'home_slider', 'id' => 'slide-' . get_the_ID() ) ); ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						
						<div class="grid-container ">
							<div class="grid-x grid-padding-x align-middle home-slide__caption">
								<div class="cell">
									<h3 class="home-slide__title"><?php the_title(); ?></h3>
									<?php if ( get_the_content() ): ?>
										<div class="home-slide__content">
											<?php the_content(); ?>
										</div>
									<?php endif; ?>

									<?php $button = return_template( 'button' ); ?>
									<?php if ( $button ): ?>
										<div class="home-slide__button">
											<?php echo $button; ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				
				</div>
			<?php endwhile; ?>
		</div><!-- END of  #home-slider-->
	<?php else: ?>
		<h3 class="no-slider"><?php _e( "You don't have slides to show. Go to Dashboard -> Slider and Add New slide to display it here." ); ?></h3>
	<?php endif;
	wp_reset_query(); ?>
<?php }

// HOME Slider Shortcode

function home_slider_shortcode() {
	ob_start();
	home_slider_template();
	$slider = ob_get_clean();

	return $slider;
}

add_shortcode( 'slider', 'home_slider_shortcode' );