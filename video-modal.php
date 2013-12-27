<?php
/**
 * Plugin Name: Video Modal
 * Plugin URI: sunil@sunil.co.nz
 * Description: image links for modals with embedded youtube videos
 * Version: 0.1
 * Author: Sunil Williams
 * Author URI: http://sunil.co.nz
 * License:  GPL2
 */
?>
<?php
//
// First, lets create the custom post type
//
/***************************************************************************************/
/* videos custom post type                                                           */
/***************************************************************************************/

function my_custom_post_videos() {
  $labels = array(
    'name'               => _x( 'Videos', 'post type general name' ),
    'singular_name'      => _x( 'Videos', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Videos' ),
    'edit_item'          => __( 'Edit Video' ),
    'new_item'           => __( 'New Video' ),
    'all_items'          => __( 'All Videos' ),
    'view_item'          => __( 'View Video' ),
    'search_items'       => __( 'Search Videos' ),
    'not_found'          => __( 'No packages found' ),
    'not_found_in_trash' => __( 'No packages found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Videos'
  );

  $video_args = array(
    'labels' => $labels,
    'description'   => 'Holds our products and product specific data',
    'public'        => true,
    'menu_position' => 6,
    'supports'      => array( 'title',  'custom-fields' ),
    'taxonomies'=>array('category','post_tag'),
    'has_archive'   => true,
  ) ;

  register_post_type( 'videos', $video_args );
}
add_action( 'init', 'my_custom_post_videos' );




//
// in order to get this to work, we need to load
// the right libraries: javascript and wp php.
//

// lets start with loading the js library

add_action("wp_enqueue_scripts", "cmb_modal_scripts") ;

function cmb_modal_scripts()
{
  // add the jquery plugin, along with our script that uses it

  wp_register_script('modaldep', plugins_url()  . "/video-modals/js/jquery.simplemodal-1.4.4.js" , array('jquery') ) ;
  wp_enqueue_script('modaldep', plugins_url() . "/video-modals/js/jquery.simplemodal-1.4.4.js" , array('jquery') ) ;

  wp_register_script('cmbmodal', plugins_url() . "/video-modals/js/cmbmodal.js" , array('jquery', 'modaldep') ) ;
  wp_enqueue_script('cmbmodal', plugins_url() . "/video-modals/js/cmbmodal.js" , array('jquery', 'modaldep') ) ;

} ;


// Initialize the metabox class
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );

function be_initialize_cmb_meta_boxes() {
  if ( !class_exists( 'cmb_Meta_Box' ) ) {
    require_once( dirname(__FILE__) . '/lib/cmb/init.php') ;
  }
}

////////////////////////////////////
//    create our metaboxes
////////////////////////////////////

function be_sample_metaboxes( $meta_boxes ) {
  $prefix = '_cmb_'; // Prefix for all fields
  $meta_boxes[] = array(
    'id' => 'test_metabox',
    'title' => 'Video Modal Details',
    'pages' => array('videos'), // post type
    'context' => 'normal',
    'priority' => 'high',
    'show_names' => true, // Show field names on the left
    'fields' => array(
      array(
        'name'   =>   'video title',
        'desc'   =>   'field description (optional)',
        'id'     =>   $prefix . 'video_title',
        'type'   =>   'text'
      ),

      array(
        'name'   =>   'video link',
        'desc'   =>   'youtube embed code',
        'id'     =>   $prefix . 'video_link',
        'type'   =>   'textarea_code'
      ),

      array(
        'name'   =>   'cover',
        'desc'   =>   'the video link image',
        'id'     =>   $prefix . 'video_cover',
        'type'   => 'file'
      ),
    ),
  );

  return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'be_sample_metaboxes' );


//
// ok. Now lets output our videos using a shortcode
//
function publish_modals_func(){
   include( dirname(__FILE__) . '/templates/covers-markup.php') ;
} // ends publish_modals_func
add_shortcode( 'publish_modals', 'publish_modals_func' );

//
// now with that out of the way, we can add our styles
//
function register_video_modal_styles(){
  wp_enqueue_style( 'video_style',  plugins_url() . '/video-modals/css/videos.css' ) ;
  wp_enqueue_script( 'video_style', plugins_url() . '/video-modals/css/videos.css' ) ;
  
}
add_action( 'wp_enqueue_scripts', 'register_video_modal_styles') ;
