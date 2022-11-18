<?php
/**
 * Debugger function which shall be removed in production.
 */
if ( ! function_exists( 'debug' ) ) {
    /**
     * Debug function definition.
     *
     * @since    1.0.0
     * @param string $params it holds the parameters of debug code.
     */
    function debug( $params ) {
        echo '<pre>';
        print_r( $params ); // phpcs:ignore
        echo '</pre>';
    }
}
/**
 * Check functions exists or not.
 */
if ( ! function_exists( 'cscp_custom_song_post_type' ) ) {
    /**
     * Register custom post type: Song
     *
     * @since 1.0.0
     */
    function cscp_custom_song_post_type() {
        $labels = array(
            'name'                  => _x( 'Songs', 'Post Type General Name', 'cs-custom-permalinks' ),
            'singular_name'         => _x( 'Song', 'Post Type Singular Name', 'cs-custom-permalinks' ),
            'menu_name'             => __( 'Songs', 'cs-custom-permalinks' ),
            'name_admin_bar'        => __( 'Songs', 'cs-custom-permalinks' ),
            'archives'              => __( 'Song Archives', 'cs-custom-permalinks' ),
            'attributes'            => __( 'Song Attributes', 'cs-custom-permalinks' ),
            'parent_item_colon'     => __( 'Parent Song:', 'cs-custom-permalinks' ),
            'all_items'             => __( 'All Songs', 'cs-custom-permalinks' ),
            'add_new_item'          => __( 'Add New Song', 'cs-custom-permalinks' ),
            'add_new'               => __( 'Add New', 'cs-custom-permalinks' ),
            'new_item'              => __( 'New Song', 'cs-custom-permalinks' ),
            'edit_item'             => __( 'Edit Song', 'cs-custom-permalinks' ),
            'update_item'           => __( 'Update Song', 'cs-custom-permalinks' ),
            'view_item'             => __( 'View Song', 'cs-custom-permalinks' ),
            'view_items'            => __( 'View Songs', 'cs-custom-permalinks' ),
            'search_items'          => __( 'Search Song', 'cs-custom-permalinks' ),
            'not_found'             => __( 'Not found', 'cs-custom-permalinks' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'cs-custom-permalinks' ),
            'featured_image'        => __( 'Featured Image', 'cs-custom-permalinks' ),
            'set_featured_image'    => __( 'Set featured image', 'cs-custom-permalinks' ),
            'remove_featured_image' => __( 'Remove featured image', 'cs-custom-permalinks' ),
            'use_featured_image'    => __( 'Use as featured image', 'cs-custom-permalinks' ),
            'insert_into_item'      => __( 'Insert into song', 'cs-custom-permalinks' ),
            'uploaded_to_this_item' => __( 'Uploaded to this song', 'cs-custom-permalinks' ),
            'items_list'            => __( 'Songs list', 'cs-custom-permalinks' ),
            'items_list_navigation' => __( 'Songs list navigation', 'cs-custom-permalinks' ),
            'filter_items_list'     => __( 'Filter songs list', 'cs-custom-permalinks' ),
        );
        $args = array(
            'label'                 => __( 'Song', 'cs-custom-permalinks' ),
            'description'           => __( 'This is the songs custom post type', 'cs-custom-permalinks' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' ),
            'taxonomies'            => array( 'song-type' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
            
        );
        register_post_type( 'song', $args );
    }
}
/**
 * Check function exists or not.
 */
if ( ! empty( 'cscp_rewrite_rules_arguments' ) ) {
    /**
     * Function to add rewrite rules.
     *
     * @param String $post_type This vvariable holds the value of post type.
     * @since 1.0.0
     */
    function cscp_rewrite_rules_arguments( $post_type ) {
        $rewrite_rules_args = add_rewrite_rule(
			'^(.*)/(.*)/?$',
			'index.php?post_type='. $post_type .'&name=$matches[2]',
			'top'
		);
        $rewrite_rules = apply_filters('cscp_channge_rewrite_rules', $rewrite_rules_args );
        return $rewrite_rules;
    }
    
}