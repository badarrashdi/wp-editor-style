<?php
/*
Plugin Name: Custom Styles
Plugin URI: http://facebook.com/badar.rashdi
Description: Add custom styles in your posts and pages content using TinyMCE WYSIWYG editor. The plugin adds a Styles dropdown menu in the visual post editor.
*/
/**
 * Apply styles to the visual editor
 */ 

add_filter('mce_css', 'tuts_mcekit_editor_style');
function tuts_mcekit_editor_style($url) {
    if ( !empty($url) )
       $url .= ',';
     // Retrieves the plugin directory URL
   // Change the path here if using different directories
    $url .= trailingslashit( plugin_dir_url(__FILE__) ) . '/editor-styles.css';
    return $url;
}
 /**
 * Add "Styles" drop-down
 */
add_filter( 'mce_buttons_2', 'tuts_mce_editor_buttons' );
function tuts_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
 /**
 * Add styles/classes to the "Styles" drop-down
 */
add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );
function tuts_mce_before_init( $settings ) {
    $style_formats = array(
        array(
            'title' => 'Handwriting font',
            'selector' => 'p',
            //'classes' => 'coverdByYourGrace',
			 'classes' => array( 'coverdByYourGrace font15'),
            ),
        array(
            'title' => 'Top 20px',
            'selector' => 'p',
            'styles' => array(
                'marginTop' => '20px',
            )
        ),
		 array(
            'title' => 'Top 30px',
            'selector' => 'p',
            'styles' => array(
                'marginTop' => '30px',
            )
        ),
        array(
            'title' => 'Green Text',
            'inline' => 'span',
            'styles' => array(
                'color' => '#c7c16d',
            )
        )
    );
    $settings['style_formats'] = json_encode( $style_formats );
    return $settings;
}
/* Learn TinyMCE style format options at http://www.tinymce.com/wiki.php/Configuration:formats */
/*
 * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
 */
add_action('wp_enqueue_scripts', 'tuts_mcekit_editor_enqueue');
/*
 * Enqueue stylesheet, if it exists.
 */
function tuts_mcekit_editor_enqueue() {
  $StyleUrl = plugin_dir_url(__FILE__).'editor-styles.css'; // Customstyle.css is relative to the current file
  wp_enqueue_style( 'myCustomStyles', $StyleUrl );
}
?>
