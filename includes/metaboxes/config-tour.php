<?php
/**
 * Tour Operator - Accommodation Metabox config
 *
 * @package   tour_operator
 * @author    LightSpeed
 * @license   GPL-2.0+
 * @link
 * @copyright 2017 LightSpeedDevelopment
 */

$metabox = array(
	'title'  => esc_html__( 'Tour Operator Plugin', 'tour-operator' ),
	'pages'  => 'tour',
	'fields' => array(),
);

$metabox['fields'][] = array(
	'id'   => 'featured',
	'name' => esc_html__( 'Featured', 'tour-operator' ),
	'type' => 'checkbox',
);

$metabox['fields'][] = array(
	'id'   => 'disable_single',
	'name' => esc_html__( 'Disable Single', 'tour-operator' ),
	'type' => 'checkbox',
);

if ( ! class_exists( 'LSX_Banners' ) ) {
	$metabox['fields'][] = array(
		'id'   => 'tagline',
		'name' => esc_html__( 'Tagline', 'tour-operator' ),
		'type' => 'text',
	);
}

$metabox['fields'][] = array(
	'id'   => 'duration',
	'name' => esc_html__( 'Duration', 'tour-operator' ),
	'type' => 'text',
);

$metabox['fields'][] = array(
	'id'         => 'departs_from',
	'name'       => esc_html__( 'Departs From', 'tour-operator' ),
	'type'       => 'post_select',
	'use_ajax'   => false,
	'allow_none' => true,
	'sortable'   => true,
	'repeatable' => true,
	'query'      => array(
		'post_type'      => 'destination',
		'nopagin'        => true,
		'posts_per_page' => '-1',
		'orderby'        => 'title',
		'order'          => 'ASC',
	),
);

$metabox['fields'][] = array(
	'id'         => 'ends_in',
	'name'       => esc_html__( 'Ends In', 'tour-operator' ),
	'type'       => 'post_select',
	'use_ajax'   => false,
	'allow_none' => true,
	'sortable'   => true,
	'repeatable' => true,
	'query'      => array(
		'post_type'      => 'destination',
		'nopagin'        => true,
		'posts_per_page' => 1000,
		'orderby'        => 'title',
		'order'          => 'ASC',
	),
);

$metabox['fields'][] = array(
	'id'       => 'best_time_to_visit',
	'name'     => esc_html__( 'Best months to visit', 'tour-operator' ),
	'type'     => 'select',
	'multiple' => true,
	'options'  => array(
		'january'   => 'January',
		'february'  => 'February',
		'march'     => 'March',
		'april'     => 'April',
		'may'       => 'May',
		'june'      => 'June',
		'july'      => 'July',
		'august'    => 'August',
		'september' => 'September',
		'october'   => 'October',
		'november'  => 'November',
		'december'  => 'December',
	),
);

if ( post_type_exists( 'team' ) ) {
	$metabox['fields'][] = array(
		'id'         => 'team_to_tour',
		'name'       => esc_html__( 'Tour Expert', 'tour-operator' ),
		'type'       => 'post_select',
		'use_ajax'   => false,
		'allow_none' => true,
		'query'      => array(
			'post_type'      => 'team',
			'nopagin'        => true,
			'posts_per_page' => '-1',
			'orderby'        => 'title',
			'order'          => 'ASC',
		),
	);
}

$metabox['fields'][] = array(
	'id'      => 'hightlights',
	'name'    => esc_html__( 'Hightlights', 'tour-operator' ),
	'type'    => 'wysiwyg',
	'options' => array(
		'editor_height' => '100',
	),
);

$metabox['fields'][] = array(
	'id'   => 'price_title',
	'name' => esc_html__( 'Price', 'tour-operator' ),
	'type' => 'title',
);

$metabox['fields'][] = array(
	'id'   => 'price',
	'name' => esc_html__( 'Price', 'tour-operator' ),
	'type' => 'text',
);

$metabox['fields'][] = array(
	'id'   => 'single_supplement',
	'name' => esc_html__( 'Single Supplement', 'tour-operator' ),
	'type' => 'text',
);

$metabox['fields'][] = array(
	'id'      => 'included',
	'name'    => esc_html__( 'Included', 'tour-operator' ),
	'type'    => 'wysiwyg',
	'options' => array(
		'editor_height' => '100',
	),
);

$metabox['fields'][] = array(
	'id'      => 'not_included',
	'name'    => esc_html__( 'Not Included', 'tour-operator' ),
	'type'    => 'wysiwyg',
	'options' => array(
		'editor_height' => '100',
	),
);

$metabox['fields'][] = array(
	'id'   => 'gallery_title',
	'name' => esc_html__( 'Gallery', 'tour-operator' ),
	'type' => 'title',
);

$metabox['fields'][] = array(
	'id'         => 'gallery',
	'name'       => esc_html__( 'Gallery', 'tour-operator' ),
	'type'       => 'image',
	'repeatable' => true,
	'show_size'  => false,
);

if ( class_exists( 'Envira_Gallery' ) ) {
	$metabox['fields'][] = array(
		'id'   => 'envira_title',
		'name' => esc_html__( 'Envira Gallery', 'tour-operator' ),
		'type' => 'title',
	);

	$metabox['fields'][] = array(
		'id'         => 'envira_gallery',
		'name'       => esc_html__( 'Envira Gallery', 'to-galleries' ),
		'type'       => 'post_select',
		'use_ajax'   => false,
		'allow_none' => true,
		'query'      => array(
			'post_type'      => 'envira',
			'nopagin'        => true,
			'posts_per_page' => '-1',
			'orderby'        => 'title',
			'order'          => 'ASC',
		),
	);

	if ( class_exists( 'Envira_Videos' ) ) {
		$metabox['fields'][] = array(
			'id'         => 'envira_video',
			'name'       => esc_html__( 'Envira Video Gallery', 'to-galleries' ),
			'type'       => 'post_select',
			'use_ajax'   => false,
			'allow_none' => true,
			'query'      => array(
				'post_type'      => 'envira',
				'nopagin'        => true,
				'posts_per_page' => '-1',
				'orderby'        => 'title',
				'order'          => 'ASC',
			),
		);
	}
}

if ( post_type_exists( 'special' ) ) {
	$metabox['fields'][] = array(
		'id'         => 'special_to_tour',
		'name'       => esc_html__( 'Specials related with this tour', 'tour-operator' ),
		'type'       => 'post_select',
		'use_ajax'   => false,
		'allow_none' => true,
		'repeatable' => true,
		'sortable'   => true,
		'query'      => array(
			'post_type'      => 'special',
			'nopagin'        => true,
			'posts_per_page' => '-1',
			'orderby'        => 'title',
			'order'          => 'ASC',
		),
	);
}

$metabox['fields'][] = array(
	'id'   => 'itinerary_title',
	'name' => esc_html__( 'Itinerary', 'tour-operator' ),
	'type' => 'title',
);

$metabox['fields'][] = array(
	'id'        => 'itinerary_kml',
	'name'      => esc_html__( 'Itinerary KML File', 'tour-operator' ),
	'type'      => 'file',
	'show_size' => true,
);

$metabox['fields'][] = array(
	'id'          => 'itinerary',
	'name'        => '',
	'single_name' => 'Day(s)',
	'type'        => 'group',
	'repeatable'  => true,
	'sortable'    => true,
	'fields'      => lsx\legacy\Tour::get_instance()->itinerary_fields(),
	'desc'        => '',
);

$metabox['fields'][] = array(
	'id'   => 'accommodation_title',
	'name' => esc_html__( 'Accommodation', 'tour-operator' ),
	'type' => 'title',
);

$metabox['fields'][] = array(
	'id'         => 'accommodation_to_tour',
	'name'       => esc_html__( 'Accommodation related with this tour', 'tour-operator' ),
	'type'       => 'post_select',
	'use_ajax'   => false,
	'repeatable' => true,
	'allow_none' => true,
	'query'      => array(
		'post_type'      => 'accommodation',
		'nopagin'        => true,
		'posts_per_page' => '-1',
		'orderby'        => 'title',
		'order'          => 'ASC',
	),
);

$metabox['fields'][] = array(
	'id'   => 'destinations_title',
	'name' => esc_html__( 'Destinations', 'tour-operator' ),
	'type' => 'title',
);

$metabox['fields'][] = array(
	'id'         => 'destination_to_tour',
	'name'       => esc_html__( 'Destinations related with this tour', 'tour-operator' ),
	'type'       => 'post_select',
	'use_ajax'   => false,
	'repeatable' => true,
	'allow_none' => true,
	'query'      => array(
		'post_type'      => 'destination',
		'nopagin'        => true,
		'posts_per_page' => '-1',
		'orderby'        => 'title',
		'order'          => 'ASC',
	),
);

$metabox['fields'] = apply_filters( 'lsx_to_tour_custom_fields', $metabox['fields'] );

return $metabox;
