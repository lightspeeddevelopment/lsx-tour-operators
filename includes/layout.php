<?php
/**
 * Structure the TO pages
 *
 * @package   	tour-operator
 * @subpackage 	layout
 * @license   	GPL3
 */


/**
 * Archive
 */
add_action('lsx_entry_top','lsx_to_archive_entry_top');

/**
 * Archive Post type Specific
 */
add_action('lsx_entry_bottom','lsx_to_accommodation_archive_entry_bottom');
add_action('lsx_entry_bottom','lsx_to_destination_archive_entry_bottom');
add_action('lsx_entry_bottom','lsx_to_tour_archive_entry_bottom');

/**
 * Single
 */
add_action('lsx_content_top','lsx_to_single_content_top');
add_action('lsx_entry_bottom','lsx_to_single_entry_bottom');

/**
 * Single Post type Specific
 */
add_action('lsx_content_bottom','lsx_to_accommodation_single_content_bottom');
add_action('lsx_content_bottom','lsx_to_destination_single_content_bottom');
add_action('lsx_content_bottom','lsx_to_tour_single_content_bottom');

/**
 * Adds the template tags to the top of the content-accommodation
 *
 * @package 	tour-operator
 * @subpackage	template-tag
 * @category 	general
 */
function lsx_to_archive_entry_top() {
	global $lsx_to_archive;

	if ( in_array( get_post_type(), array_keys( lsx_to_get_post_types() ) ) && ( is_archive() || $lsx_to_archive ) ) { ?>
		<?php
			$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
			$image_arr = wp_get_attachment_image_src( $thumbnail_id, 'lsx-thumbnail-single' );

			if ( is_array( $image_arr ) ) {
				$image_src = $image_arr[0];
			}
		?>

		<div class="lsx-to-archive-thumb">
			<a href="<?php the_permalink(); ?>" style="background-image: url('<?php echo esc_url( $image_src ); ?>')">

				<?php
					if ( 'team' === get_post_type() ) {
						lsx_thumbnail( array( 285, 285 ) );
					} else {
						lsx_thumbnail( 'lsx-thumbnail-single' );
					}
				?>
			</a>
		</div>

		<div class="lsx-to-archive-wrapper">
			<div class="lsx-to-archive-content">
				<?php the_title( '<h3 class="lsx-to-archive-content-title"><a href="'. get_permalink() .'" title="'. esc_html__( 'Read more', 'tour-operator' ) .'">', '</a></h3>' ); ?>
				<?php lsx_to_tagline( '<p class="lsx-to-archive-content-tagline">', '</p>' ); ?>

	<?php }
}

/**
 * Adds the template tags to the top of the lsx_content_top action
 *
 * @package 	tour-operator
 * @subpackage	template-tag
 * @category 	general
 */
function lsx_to_single_content_top() {
	if(is_singular(array_keys(lsx_to_get_post_types())) || is_post_type_archive('destination')) {
		lsx_to_page_navigation();
	}
}

/**
 * Adds the template tags to the top of the content-{post-type}
 *
 * @package 	tour-operator
 * @subpackage	template-tag
 * @category 	general
 */
function lsx_to_single_entry_bottom() {
	global $lsx_to_archive;

	if ( is_singular( array_keys( lsx_to_get_post_types() ) ) && false === $lsx_to_archive && lsx_to_has_enquiry_contact() ) { ?>
		<div class="col-xs-12 col-sm-4 col-md-3">
			<div class="lsx-to-contact-widget">
				<?php
					if ( function_exists( 'lsx_to_has_team_member' ) && lsx_to_has_team_member() ) {
						lsx_to_team_member_panel( '<div class="lsx-to-contact">', '</div>' );
					} else {
						lsx_to_enquiry_contact( '<div class="lsx-to-contact">', '</div>' );
					}

					lsx_to_enquire_modal();
				?>
			</div>
		</div>
<?php }
}


/**
 * Adds the template tags to the bottom of the single accommodation
 *
 * @package 	tour-operator
 * @subpackage	template-tag
 * @category 	accommodation
 */
function lsx_to_accommodation_single_content_bottom() {
	if(is_singular('accommodation')){
		lsx_to_accommodation_units('<section id="{units}"><h2 class="section-title">'.esc_html__('{units}','tour-operator').'</h2><div class="info row">','</div></section>');

		lsx_to_accommodation_facilities('<section id="facilities"><h2 class="section-title">'.esc_html__('Facilities','tour-operator').'</h2><div class="info row">','</div></section>');

		lsx_to_included_block();

		if(function_exists('lsx_to_has_map') && lsx_to_has_map()){ ?>
			<section id="accommodation-map">
				<h2 class="section-title"><?php esc_html_e('Map','tour-operator'); ?></h2>
				<?php lsx_to_map(); ?>
			</section>
		<?php }

		lsx_to_gallery('<section id="gallery"><h2 class="section-title">'.esc_html__('Gallery','tour-operator').'</h2>','</section>');

		if(function_exists('lsx_to_videos')) {
			lsx_to_videos('<div id="videos"><h2 class="section-title">'.esc_html__('Videos','tour-operator').'</h2>','</div>');
		}elseif(class_exists('Envira_Videos')) {
			lsx_to_envira_videos('<div id="videos"><h2 class="section-title">'.esc_html__('Videos','tour-operator').'</h2>','</div>');
		}

		if(function_exists('lsx_to_accommodation_reviews')){
			lsx_to_accommodation_reviews();
		}

		lsx_to_related_items('travel-style','<section id="related-items"><h2 class="section-title">'.esc_html__(lsx_to_get_post_type_section_title('accommodation', 'similar', 'Related Accommodation'),'tour-operator').'</h2>','</section>');

		$connected_tours = get_post_meta( get_the_ID(), 'tour_to_accommodation', false );
		if ( lsx_to_accommodation_display_connected_tours() && post_type_exists( 'tour' ) && is_array( $connected_tours ) && ! empty( $connected_tours ) ) {
			lsx_to_related_items( $connected_tours, '<section class="related-items"><h2 class="section-title">' . esc_html__( 'Related Tours' , 'tour-operator' ) . '</h2>', '</section>', true, 'tour' );
		}
	}
}

/**
 * Adds the template tags to the bottom of the content-accommodation
 *
 * @package 	tour-operator
 * @subpackage	template-tag
 * @category 	accommodation
 */
function lsx_to_accommodation_archive_entry_bottom() {
	global $lsx_to_archive;

	if ( 'accommodation' === get_post_type() && (is_archive() || $lsx_to_archive ) ) { ?>
			</div>

			<div class="lsx-to-archive-meta-data">
				<?php lsx_to_accommodation_meta(); ?>
			</div>
		</div>

		<?php if ( 'grid' === tour_operator()->archive_layout ) : ?>
			<a href="<?php the_permalink(); ?>" class="moretag"><?php esc_html_e( 'View accommodation', 'tour-operator' ); ?></a>
		<?php endif; ?>

	<?php }
}


/**
 * Adds the template tags to the bottom of the single destination
 *
 * @package 	tour-operator
 * @subpackage	template-tag
 * @category 	destination
 */
function lsx_to_destination_single_content_bottom() {
	if(is_singular('destination')){ ?>
		<section id="highlights">
			<div class="row">
				<div class="col-sm-12">
					<?php lsx_to_best_time_to_visit('<div class="best-time-to-visit"><h2 class="section-title">'.esc_html__('Best time to visit','tour-operator').'</h2><div class="best-time-to-visit-content">','</div></div>'); ?>
				</div>
			</div>
		</section>
		<?php

		lsx_to_destination_travel_info();

		lsx_to_country_regions();

		lsx_to_destination_tours();

		lsx_to_region_accommodation();

		lsx_to_destination_activities();

		if(function_exists('lsx_to_has_map') && lsx_to_has_map()){ ?>
			<section id="destination-map">
				<h2 class="section-title"><?php esc_html_e('Map','tour-operator'); ?></h2>
				<?php lsx_to_map(); ?>
			</section>
		<?php }

        lsx_to_gallery('<section id="gallery"><h2 class="section-title">'.esc_html__('Gallery','tour-operator').'</h2>','</section>');

		if(function_exists('lsx_to_videos')) {
			lsx_to_videos('<div id="videos"><h2 class="section-title">'.esc_html__('Videos','tour-operator').'</h2>','</div>');
		}elseif(class_exists('Envira_Videos')) {
			lsx_to_envira_videos('<div id="videos"><h2 class="section-title">'.esc_html__('Videos','tour-operator').'</h2>','</div>');
		}

		if(function_exists('lsx_to_destination_reviews')){
			lsx_to_destination_reviews();
		}
	}
}

/**
 * Adds the template tags to the bottom of the content-destination.php
 *
 * @package 	tour-operator
 * @subpackage	template-tag
 * @category 	destination
 */
function lsx_to_destination_archive_entry_bottom() {
	global $lsx_to_archive;

	if ( 'destination' === get_post_type() && ( is_archive() || $lsx_to_archive ) ) { ?>
			</div>

			<!-- <div class="lsx-to-archive-meta-data">
				<php
					$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

					the_terms( get_the_ID(), 'travel-style', '<span class="'. $meta_class .'style">'. esc_html__( 'Travel Style', 'tour-operator' ) .': ', ', ', '</span>' );
					if ( function_exists( 'lsx_to_connected_activities' ) ) {
						lsx_to_connected_activities( '<span class="'. $meta_class .'activities">'. esc_html__( 'Activities', 'tour-operator' ) .': ', '</span>' );
					}
				?>
			</div> -->
		</div>

		<?php if ( 'grid' === tour_operator()->archive_layout ) : ?>
			<a href="<?php the_permalink(); ?>" class="moretag"><?php esc_html_e( 'Continue reading', 'tour-operator' ); ?></a>
		<?php endif; ?>

	<?php }
}

/**
 * Adds the template tags to the bottom of the single tour
 *
 * @package 	tour-operator
 * @subpackage	template-tag
 * @category 	tour
 */
function lsx_to_tour_single_content_bottom() {
	if ( is_singular( 'tour' ) ) { ?>
		<div class="lsx-to-section-wrapper">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<?php lsx_to_highlights( '<section id="highlights" class="lsx-to-section"><h2 class="lsx-to-section-title lsx-title">' . esc_html__( 'Highlights', 'tour-operator' ) . '</h2>', '</section>' ); ?>
				</div>
				<div class="col-xs-12 col-sm-6">
					<?php lsx_to_best_time_to_visit('<section id="best-time-to-visit" class="lsx-to-section"><h2 class="lsx-to-section-title lsx-title">' . esc_html__( 'Best time to visit', 'tour-operator' ) . '</h2><div class="best-time-to-visit-wrapper">', '</div></section>'); ?>
				</div>
			</div>
		</div>

		<?php if ( lsx_to_has_itinerary() ) { ?>
			<section id="itinerary" class="lsx-to-section">
				<h2 class="lsx-to-section-title lsx-title"><?php esc_html_e( 'Full Day by Day Itinerary', 'tour-operator' ); ?></h2>
				<div class="row lsx-to-archive-items lsx-to-archive-template-list itinerary-list">
				<?php while ( lsx_to_itinerary_loop() ) { ?>
					<?php
						lsx_to_itinerary_loop_item();
						$thumb = lsx_to_itinerary_thumbnail();
					?>

					<div <?php lsx_to_itinerary_class( 'lsx-to-archive-item itinerary-item col-xs-12' ); ?>>
						<div class="lsx-to-archive-container">
							<div class="lsx-to-archive-thumb">
								<div class="lsx-to-thumb-slot" style="background-image: url('<?php echo $thumb; ?>');">
									<?php echo wp_kses_post( apply_filters( 'lsx_to_lazyload_filter_images', '<img alt="thumbnail" class="attachment-responsive wp-post-image lsx-responsive" src="' . $thumb . '">' ) ); ?>
								</div>
							</div>

							<div class="lsx-to-archive-wrapper">
								<div class="lsx-to-archive-content">
									<h3 class="lsx-to-archive-content-title"><?php lsx_to_itinerary_title(); ?></h3>
									<p class="lsx-to-archive-content-tagline"><?php lsx_to_itinerary_tagline() ?></p>

									<div class="entry-content">
										<?php lsx_to_itinerary_description(); ?>
									</div>
								</div>

								<div class="lsx-to-archive-meta-data">
									<?php
										$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

										lsx_to_itinerary_destinations( '<span class="' . $meta_class . 'destinations">' . esc_html__( 'Destination', 'tour-operator' ) . ': ', '</span>' );
										lsx_to_itinerary_accommodation( '<span class="' . $meta_class . 'accommodations">' . esc_html__( 'Accommodation', 'tour-operator' ) . ': ', '</span>' );
										lsx_to_itinerary_activities( '<span class="' . $meta_class . 'activities">' . esc_html__( 'Activites', 'tour-operator' ) . ': ', '</span>' );
										lsx_to_itinerary_includes( '<span class="meta end-point day-includes">' . esc_html__( 'Included', 'tour-operator' ) . ': ', '</span>' );
										lsx_to_itinerary_excludes( '<span class="meta end-point day-excludes">' . esc_html__( 'Excluded', 'tour-operator' ) . ': ', '</span>' );
									?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
				<?php lsx_to_itinerary_read_more(); ?>
			</section>
		<?php }

		lsx_to_included_block();

		if ( function_exists( 'lsx_to_has_map' ) && lsx_to_has_map() ) { ?>
			<section id="tour-map" class="lsx-to-section">
				<h2 class="lsx-to-section-title lsx-title"><?php esc_html_e( 'Map', 'tour-operator' ); ?></h2>
				<?php lsx_to_map(); ?>
			</section>
		<?php }

		lsx_to_gallery( '<section id="gallery" class="lsx-to-section"><h2 class="lsx-to-section-title lsx-title">' . esc_html__( 'Gallery', 'tour-operator' ) . '</h2>', '</section>' );

		if ( function_exists( 'lsx_to_videos' ) ) {
			lsx_to_videos( '<section id="videos" class="lsx-to-section"><h2 class="lsx-to-section-title lsx-title">' . esc_html__( 'Videos', 'tour-operator' ) . '</h2>', '</section>' );
		} elseif ( class_exists( 'Envira_Videos' ) ) {
			lsx_to_envira_videos( '<section id="videos" class="lsx-to-section"><h2 class="lsx-to-section-title lsx-title">' . esc_html__( 'Videos', 'tour-operator' ) . '</h2>', '</section>' );
		}

		if ( function_exists( 'lsx_to_tour_reviews' ) ) {
			lsx_to_tour_reviews();
        }

		lsx_to_related_items( 'travel-style', '<section id="related-items" class="lsx-to-section"><h2 class="lsx-to-section-title lsx-title">' . esc_html__( lsx_to_get_post_type_section_title( 'tour', 'related', 'Related Tours' ), 'tour-operator') . '</h2>', '</section>' );
	}
}

/**
 * Adds the template tags to the bottom of the content-tour.php
 *
 * @package 	tour-operator
 * @subpackage	template-tag
 * @category 	tour
 */
function lsx_to_tour_archive_entry_bottom() {
	global $lsx_to_archive;

	if ( 'tour' === get_post_type() && ( is_archive() || $lsx_to_archive ) ) { ?>
			</div>

			<div class="lsx-to-archive-meta-data">
				<?php
					$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';

					lsx_to_price( '<span class="'. $meta_class .'price">'. esc_html__( 'From price', 'tour-operator' ) .': ', '</span>' );
					lsx_to_duration( '<span class="'. $meta_class .'duration">'. esc_html__( 'Duration', 'tour-operator' ) .': ', '</span>' );
					the_terms( get_the_ID(), 'travel-style', '<span class="'. $meta_class .'style">'. esc_html__( 'Travel Style', 'tour-operator' ) .': ', ', ', '</span>' );
					lsx_to_connected_countries( '<span class="'. $meta_class .'destinations">'. esc_html__( 'Destinations', 'tour-operator' ) .': ', '</span>' );
					if ( function_exists( 'lsx_to_connected_activities' ) ) {
						lsx_to_connected_activities( '<span class="'. $meta_class .'activities">'. esc_html__( 'Activities', 'tour-operator' ) .': ', '</span>' );
					}
				?>
			</div>
		</div>

		<?php if ( 'grid' === tour_operator()->archive_layout ) : ?>
			<a href="<?php the_permalink(); ?>" class="moretag"><?php esc_html_e( 'View tour', 'tour-operator' ); ?></a>
		<?php endif; ?>

	<?php }
}
