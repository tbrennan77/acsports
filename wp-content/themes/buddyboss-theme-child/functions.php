<?php
/**
 * @package BuddyBoss Child
 * The parent theme functions are located at /buddyboss-theme/inc/theme/functions.php
 * Add your own functions at the bottom of this file.
 */


/****************************** THEME SETUP ******************************/

/**
 * Sets up theme for translation
 *
 * @since BuddyBoss Child 1.0.0
 */
function buddyboss_theme_child_languages()
{
  /**
   * Makes child theme available for translation.
   * Translations can be added into the /languages/ directory.
   */

  // Translate text from the PARENT theme.
  load_theme_textdomain( 'buddyboss-theme', get_stylesheet_directory() . '/languages' );

  // Translate text from the CHILD theme only.
  // Change 'buddyboss-theme' instances in all child theme files to 'buddyboss-theme-child'.
  // load_theme_textdomain( 'buddyboss-theme-child', get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'buddyboss_theme_child_languages' );

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since Boss Child Theme  1.0.0
 */
function buddyboss_theme_child_scripts_styles()
{
  /**
   * Scripts and Styles loaded by the parent theme can be unloaded if needed
   * using wp_deregister_script or wp_deregister_style.
   *
   * See the WordPress Codex for more information about those functions:
   * http://codex.wordpress.org/Function_Reference/wp_deregister_script
   * http://codex.wordpress.org/Function_Reference/wp_deregister_style
   **/

  // Styles
  wp_enqueue_style( 'buddyboss-child-css', get_stylesheet_directory_uri().'/assets/css/custom.css', '', '1.0.0' );

  // Javascript
  wp_enqueue_script( 'buddyboss-child-js', get_stylesheet_directory_uri().'/assets/js/custom.js', '', '1.0.0' );

  /* 
   * Enqueue Bootstrap 4 for Card custom post type
   */
  if (is_singular( 'cards' )) {
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js', '', '1.0.0');

    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css', '', '1.0.0' );
  }
}
add_action( 'wp_enqueue_scripts', 'buddyboss_theme_child_scripts_styles', 9999 );


/****************************** CUSTOM FUNCTIONS ******************************/


/*
* Custom Post Type for Trading Cards
*/
 
function custom_post_type() {
 
// Set UI labels for Custom Post Type

    $labels = array(
        'name'                => _x( 'Cards', 'Post Type General Name', 'buddyboss-theme' ),
        'singular_name'       => _x( 'Card', 'Post Type Singular Name', 'buddyboss-theme' ),
        'menu_name'           => __( 'Cards', 'buddyboss-theme' ),
        'parent_item_colon'   => __( 'Parent Card', 'buddyboss-theme' ),
        'all_items'           => __( 'All Cards', 'buddyboss-theme' ),
        'view_item'           => __( 'View Card', 'buddyboss-theme' ),
        'add_new_item'        => __( 'Add New Card', 'buddyboss-theme' ),
        'add_new'             => __( 'Add New', 'buddyboss-theme' ),
        'edit_item'           => __( 'Edit Card', 'buddyboss-theme' ),
        'update_item'         => __( 'Update Card', 'buddyboss-theme' ),
        'search_items'        => __( 'Search Card', 'buddyboss-theme' ),
        'not_found'           => __( 'Not Found', 'buddyboss-theme' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'buddyboss-theme' ),
    );
     
// Set other options for Custom Post Type (CPT)
     
    $args = array(
        'label'               => __( 'cards', 'buddyboss-theme' ),
        'description'         => __( 'Card news and reviews', 'buddyboss-theme' ),
        'labels'              => $labels,
        // What feature(s) are supported in the Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // What taxomonie(s) is this associated with 
        'taxonomies'          => array( 'sports' ),
        /* Reminder: a hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
 
    );
     
    // Register the Trading Card CPT
    register_post_type( 'cards', $args );
 
}
 
/* Hook into the 'init' action so that the function
 * is not unnecessarily executed. 
 */
 
add_action( 'init', 'custom_post_type', 0 );

?>