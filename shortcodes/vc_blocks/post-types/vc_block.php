<?php

function vc_block_init() {
	register_post_type( 'vc_block', array(
		'labels'            => array(
			'name'                => __( 'VC Blocks', 'vc-custom-addons' ),
			'singular_name'       => __( 'VC Block', 'vc-custom-addons' ),
			'all_items'           => __( 'All VC Blocks', 'vc-custom-addons' ),
			'new_item'            => __( 'New VC Block', 'vc-custom-addons' ),
			'add_new'             => __( 'Add New', 'vc-custom-addons' ),
			'add_new_item'        => __( 'Add New VC Block', 'vc-custom-addons' ),
			'edit_item'           => __( 'Edit VC Block', 'vc-custom-addons' ),
			'view_item'           => __( 'View VC Block', 'vc-custom-addons' ),
			'search_items'        => __( 'Search VC Blocks', 'vc-custom-addons' ),
			'not_found'           => __( 'No VC Blocks found', 'vc-custom-addons' ),
			'not_found_in_trash'  => __( 'No VC Blocks found in trash', 'vc-custom-addons' ),
			'parent_item_colon'   => __( 'Parent VC Block', 'vc-custom-addons' ),
			'menu_name'           => __( 'VC Blocks', 'vc-custom-addons' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-editor-table',
		'show_in_rest'      => true,
		'rest_base'         => 'vc_block',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'vc_block_init' );

function vc_block_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['vc_block'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('VC Block updated. <a target="_blank" href="%s">View VC Block</a>', 'vc-custom-addons'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'vc-custom-addons'),
		3 => __('Custom field deleted.', 'vc-custom-addons'),
		4 => __('VC Block updated.', 'vc-custom-addons'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('VC Block restored to revision from %s', 'vc-custom-addons'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('VC Block published. <a href="%s">View VC Block</a>', 'vc-custom-addons'), esc_url( $permalink ) ),
		7 => __('VC Block saved.', 'vc-custom-addons'),
		8 => sprintf( __('VC Block submitted. <a target="_blank" href="%s">Preview VC Block</a>', 'vc-custom-addons'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('VC Block scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview VC Block</a>', 'vc-custom-addons'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('VC Block draft updated. <a target="_blank" href="%s">Preview VC Block</a>', 'vc-custom-addons'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'vc_block_updated_messages' );
