<?php
/**
 * Plugin Name:     Destinations
 * Plugin URI:      https://github.com/markhowellsmead/mhm_destinations
 * Description:		WordPress Plugin to provide a custom post type and custom taxonomies.
 * Author:          Mark Howells-Mead
 * Author URI:      https://permanenttourist.ch/
 * Text Domain:     mhm_destinations
 * Domain Path:     /languages
 * Version:         1.0.1
 * Requires PHP: 	7.2
 */

namespace MHM\Destinations;

register_activation_hook(__FILE__, 'flush_rewrite_rules');
register_deactivation_hook(__FILE__, 'flush_rewrite_rules');

add_action('plugins_loaded', function () {
	load_plugin_textdomain('mhm_destinations', false, dirname(plugin_basename(__FILE__)).'/languages');
});

add_action('init', function () {
	register_post_type(
		'mhm_destination',
		[
			'description' => _x('Destinations', 'Post type description', 'mhm_destination'),
			'menu_icon' => 'dashicons-admin-site-alt',
			'menu_position' => 10,
			'has_archive' => true,
			'public' => true,
			'show_in_rest' => true,
			'rest_base' => 'destinations',
			'rewrite' => [
				'slug' => 'destinations'
			],
			'supports' => [
				'title',
				'editor',
				'thumbnail',
			],
			'labels' => [
				'name' => _x('Destinations', 'CPT name', 'mhm_destination'),
				'singular_name' => _x('Destination', 'CPT singular name', 'mhm_destination'),
				'add_new' => _x('Add new', 'CPT add_new', 'mhm_destination'),
				'add_new_item' => _x('Add new destination', 'cpt name', 'mhm_destination'),
				'edit_item' => _x('Edit destination', 'cpt name', 'mhm_destination'),
				'new_item' => _x('New destination', 'cpt name', 'mhm_destination'),
				'view_item' => _x('View destination', 'cpt name', 'mhm_destination'),
				'view_items' => _x('View destinations', 'cpt name', 'mhm_destination'),
				'search_items' => _x('Search destinations', 'cpt name', 'mhm_destination'),
				'not_found' => _x('No destinations', 'cpt name', 'mhm_destination'),
				'not_found_in_trash' => _x('No destinations in the trash', 'cpt name', 'mhm_destination'),
				'all_items' => _x('All destinations', 'cpt name', 'mhm_destination'),
				'archives' => _x('Destination destinations', 'cpt name', 'mhm_destination'),
				'attributes' => _x('Attributes', 'cpt name', 'mhm_destination'),
				'name_admin_bar' => _x('Destination', 'Label for name admin bar', 'mhm_destination'),
				'insert_into_item' => _x('Insert into destination', 'Label for name admin bar', 'mhm_destination'),
				'uploaded_to_this_item' => _x('Uploaded to this destination', 'Label for name admin bar', 'mhm_destination'),
				'filter_items_list' => _x('Filter destinations', 'Label for name admin bar', 'mhm_destination'),
				'items_list_navigation' => _x('Destination list navigation', 'Label for name admin bar', 'mhm_destination'),
				'items_list' => _x('List of destinations', 'Label for name admin bar', 'mhm_destination'),
				'item_published' => _x('Destination published.', 'Label for name admin bar', 'mhm_destination'),
				'item_published_privately' => _x('Destination published privately.', 'Label for name admin bar', 'mhm_destination'),
				'item_reverted_to_draft' => _x('Destination reverted to draft status.', 'Label for name admin bar', 'mhm_destination'),
				'item_scheduled' => _x('Destination scheduled.', 'Label for name admin bar', 'mhm_destination'),
				'item_updated' => _x('Destination updated.', 'Label for name admin bar', 'mhm_destination'),
				// 'featured_image' => _x('Featured image', 'Custom post type label', 'mhm_destination'),
				// 'set_featured_image' => _x('Set featuried image', 'Custom post type label', 'mhm_destination'),
				// 'remove_featured_image' => _x('Remove destination image', 'Custom post type label', 'mhm_destination'),
				// 'use_featured_image' => _x('Use as destination image', 'Custom post type label', 'mhm_destination'),
			]
		]
	);

	add_post_type_support('mhm_destination', 'excerpt');

	register_taxonomy('mhm_destination_tag', ['mhm_destination'], [
		'labels' => [
			'name' => _x('Tags', 'Custom taxonomy label - name', 'mhm_destinations'),
			'singular_name' => _x('Tags', 'Custom taxonomy label - singular name', 'mhm_destinations'),
			'menu_name' => _x('Tags', 'Custom taxonomy label - menu name', 'mhm_destinations'),
			'all_items' => _x('All Tags', 'Custom taxonomy label - all items', 'mhm_destinations'),
			'edit_item' => _x('Edit Tag', 'Custom taxonomy label - edit item', 'mhm_destinations'),
			'view_item' => _x('View destinations with this tag', 'Custom taxonomy label - view item', 'mhm_destinations'),
			'update_item' => _x('Update Tag', 'Custom taxonomy label - update item', 'mhm_destinations'),
			'add_new_item' => _x('Add Tag', 'Custom taxonomy label - add new item', 'mhm_destinations'),
			'new_item_name' => _x('New Tag', 'Custom taxonomy label - new item name', 'mhm_destinations'),
			'parent_item' => _x('Parent Tag', 'Custom taxonomy label - parent item', 'mhm_destinations'),
			'parent_item_colon' => _x('Parent Tag:', 'Custom taxonomy label - parent item colon', 'mhm_destinations'),
			'search_items' => _x('Search Tags', 'Custom taxonomy label - search items', 'mhm_destinations'),
			'popular_items'  => _x('Popular Tags', 'Custom taxonomy label - popular items', 'mhm_destinations'),
			'separate_items_with_commas' => _x('Comma-separated Tags', 'Custom taxonomy label - separate items with comma', 'mhm_destinations'),
			'add_or_remove_items'  => _x('Add or remove Tags', 'Custom taxonomy label - add or remove items', 'mhm_destinations'),
			'choose_from_most_used'  => _x('Choose from most used Tags', 'Custom taxonomy label - choose from most used', 'mhm_destinations'),
			'not_found'  => _x('No Tags found', 'Custom taxonomy label - not found', 'mhm_destinations'),
			'back_to_items' => _x('← Back to the Tags', 'Custom taxonomy label - back to items', 'mhm_destinations')
		],
		'hierarchical' => false,
		'show_ui' => true,
		'publicly_queryable' => true,
		'show_in_rest' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => ['slug' => 'destination-subjects'],
	]);

	register_taxonomy('mhm_destination_region', ['mhm_destination'], [
		'labels' => [
			'name' => _x('Regions', 'Custom taxonomy label - name', 'mhm_destinations'),
			'singular_name' => _x('Regions', 'Custom taxonomy label - singular name', 'mhm_destinations'),
			'menu_name' => _x('Regions', 'Custom taxonomy label - menu name', 'mhm_destinations'),
			'all_items' => _x('All Regions', 'Custom taxonomy label - all items', 'mhm_destinations'),
			'edit_item' => _x('Edit Region', 'Custom taxonomy label - edit item', 'mhm_destinations'),
			'view_item' => _x('View destinations in this Region', 'Custom taxonomy label - view item', 'mhm_destinations'),
			'update_item' => _x('Update Region', 'Custom taxonomy label - update item', 'mhm_destinations'),
			'add_new_item' => _x('Add Region', 'Custom taxonomy label - add new item', 'mhm_destinations'),
			'new_item_name' => _x('New Region', 'Custom taxonomy label - new item name', 'mhm_destinations'),
			'parent_item' => _x('Parent Region', 'Custom taxonomy label - parent item', 'mhm_destinations'),
			'parent_item_colon' => _x('Parent Region:', 'Custom taxonomy label - parent item colon', 'mhm_destinations'),
			'search_items' => _x('Search Regions', 'Custom taxonomy label - search items', 'mhm_destinations'),
			'popular_items'  => _x('Popular Regions', 'Custom taxonomy label - popular items', 'mhm_destinations'),
			'separate_items_with_commas' => _x('Comma-separated Regions', 'Custom taxonomy label - separate items with comma', 'mhm_destinations'),
			'add_or_remove_items'  => _x('Add or remove Regions', 'Custom taxonomy label - add or remove items', 'mhm_destinations'),
			'choose_from_most_used'  => _x('Choose from most used Regions', 'Custom taxonomy label - choose from most used', 'mhm_destinations'),
			'not_found'  => _x('No Regions found', 'Custom taxonomy label - not found', 'mhm_destinations'),
			'back_to_items' => _x('← Back to the Regions', 'Custom taxonomy label - back to items', 'mhm_destinations')
		],
		'hierarchical' => true,
		'show_ui' => true,
		'publicly_queryable' => true,
		'show_in_rest' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => ['slug' => 'regions'],
	]);
});


add_action('init', function () {
	if (function_exists('acf_add_local_field_group')) :
		// acf_add_local_field_group(array(
		// 'key' => 'group_5e3da9e9a4b23',
		// 'title' => 'Location',
		// 'fields' => array(
		// array(
		// 	'key' => 'field_5e3da9f0caaf0',
		// 	'label' => 'Position on map',
		// 	'name' => 'location',
		// 	'type' => 'google_map',
		// 	'instructions' => '',
		// 	'required' => 0,
		// 	'conditional_logic' => 0,
		// 	'wrapper' => array(
		// 		'width' => '',
		// 		'class' => '',
		// 		'id' => '',
		// 	),
		// 	'center_lat' => '8.22421',
		// 	'center_lng' => '46.8131873',
		// 	'zoom' => 12,
		// 	'height' => '',
		// ),
		// ),
		// 'location' => array(
		// array(
		// 	array(
		// 		'param' => 'post_type',
		// 		'operator' => '==',
		// 		'value' => 'mhm_destination',
		// 	),
		// ),
		// ),
		// 'menu_order' => 0,
		// 'position' => 'side',
		// 'style' => 'default',
		// 'label_placement' => 'top',
		// 'instruction_placement' => 'label',
		// 'hide_on_screen' => '',
		// 'active' => true,
		// 'description' => '',
		// 'modified' => 1581099561,
		// ));

		acf_add_local_field_group(array(
		'key' => 'group_related',
		'title' => 'Attributes',
		'fields' => array(
		array(
			'key' => 'related_destinations',
			'label' => 'Related destinations',
			'name' => 'related_destinations',
			'type' => 'relationship',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array(
				0 => 'mhm_destination',
			),
			'taxonomy' => '',
			'filters' => array(
				0 => 'search',
			),
			'elements' => array(
				0 => 'featured_image',
			),
			'min' => '',
			'max' => '',
			'return_format' => 'object',
		),
		),
		'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'mhm_destination',
			),
		),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		));
	endif;
});
