<?php

function block_category_init() {
	register_taxonomy( 'block_category', array( 'vc_block' ), array(
		'hierarchical'      => true,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		),
		'labels'            => array(
			'name'                       => __( 'Block categories', 'vc-custom-addons' ),
			'singular_name'              => _x( 'Block category', 'taxonomy general name', 'vc-custom-addons' ),
			'search_items'               => __( 'Search block categories', 'vc-custom-addons' ),
			'popular_items'              => __( 'Popular block categories', 'vc-custom-addons' ),
			'all_items'                  => __( 'All block categories', 'vc-custom-addons' ),
			'parent_item'                => __( 'Parent block category', 'vc-custom-addons' ),
			'parent_item_colon'          => __( 'Parent block category:', 'vc-custom-addons' ),
			'edit_item'                  => __( 'Edit block category', 'vc-custom-addons' ),
			'update_item'                => __( 'Update block category', 'vc-custom-addons' ),
			'add_new_item'               => __( 'New block category', 'vc-custom-addons' ),
			'new_item_name'              => __( 'New block category', 'vc-custom-addons' ),
			'separate_items_with_commas' => __( 'Block categories separated by comma', 'vc-custom-addons' ),
			'add_or_remove_items'        => __( 'Add or remove block categories', 'vc-custom-addons' ),
			'choose_from_most_used'      => __( 'Choose from the most used block categories', 'vc-custom-addons' ),
			'not_found'                  => __( 'No block categories found.', 'vc-custom-addons' ),
			'menu_name'                  => __( 'Block categories', 'vc-custom-addons' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'block-category',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'block_category_init' );


/**
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'vc_block'; // change to your post type
	$taxonomy  = 'block_category'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}
/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'vc_block'; // change to your post type
	$taxonomy  = 'block_category'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}
