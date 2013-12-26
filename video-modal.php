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

$plugin_dir_path = dirname(__FILE__);
echo $plugin_dir_path . "</br>" ;
echo $plugin_dir_path . "/video-modals.php" ;


//
// in order to get this to work, we need to load
// the right libraries: javascript and wp php.
//

// lets start with loading the js library

add_action("wp_enqueue_scripts", "cmb_modal_scripts") ;

function cmb_modal_scripts()
{
  // add the jquery plugin, along with our script that uses it

  wp_register_script('modaldep', get_template_directory_uri()  . "/js/jquery.simplemodal-1.4.4.js" , array('jquery') ) ;
  wp_enqueue_script('modaldep', get_template_directory_uri() . "/js/jquery.simplemodal-1.4.4.js" , array('jquery') ) ;

  wp_register_script('cmbmodal', get_template_directory_uri()  . "/js/cmbmodal.js" , array('jquery', 'modaldep') ) ;
  wp_enqueue_script('cmbmodal', get_template_directory_uri() . "/js/cmbmodal.js" , array('jquery', 'modaldep') ) ;
  
} ;


// Initialize the metabox class
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );

function be_initialize_cmb_meta_boxes() {
  if ( !class_exists( 'cmb_Meta_Box' ) ) {   
    require_once( dirname(__FILE__) . '/lib/cmb/init.php') ;
  }
}



?>
