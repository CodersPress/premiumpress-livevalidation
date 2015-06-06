<?php
/*
Plugin Name: livevalidation
Plugin URI: http://coderspress.com/
Description: livevalidation
Version: 2015.0605
Updated: 5th June 2015
Author: sMarty 
Author URI: http://coderspress.com
WP_Requires: 3.8.1
WP_Compatible: 4.2.2
License: http://creativecommons.org/licenses/GPL/2.0
*/

add_action( 'init', 'lv_plugin_updater' );
function lv_plugin_updater() {
	if ( is_admin() ) { 
	include_once( dirname( __FILE__ ) . '/updater.php' );
		$config = array(
			'slug' => plugin_basename( __FILE__ ),
			'proper_folder_name' => 'premiumpress-livevalidation',
			'api_url' => 'https://api.github.com/repos/CodersPress/premiumpress-livevalidation',
			'raw_url' => 'https://raw.github.com/CodersPress/premiumpress-livevalidation/master',
			'github_url' => 'https://github.com/CodersPress/premiumpress-livevalidation',
			'zip_url' => 'https://github.com/CodersPress/premiumpress-livevalidation/zipball/master',
			'sslverify' => true,
			'access_token' => '892b781c2b6d6af20794f8c2f2308ac23b03f33f',
		);
		new WP_LV_UPDATER( $config );
	}
}

function livevalidation_menu() {
	add_menu_page('PP Live Validation', 'PP Live Validation', 'administrator', __FILE__, 'livevalidation_settings_page',plugins_url('/images/j.png', __FILE__));
	add_action( 'admin_init', 'livevalidation_settings' );
}
add_action('admin_menu', 'livevalidation_menu');

function livevalidation_settings() {
	register_setting( 'livevalidation-group', '' );
}
function livevalidation_defaults()
{
    $option = array(
        '' => '',
    );
    foreach ( $option as $key => $value )
    {
       if (get_option($key) == NULL) {
        update_option($key, $value);
       }
    }
    return;
}
//register_activation_hook(__FILE__, 'livevalidation_defaults');
function livevalidation_settings_page() {
if ($_REQUEST['settings-updated']=='true') {
echo '<div id="message" class="updated fade"><p><strong>Plugin setting saved.</strong></p></div>';
}
?>
<div class="wrap">
    <h1>Premiumpress Live Validation</h1>
    <hr />
<form method="post" action="options.php">
    <?php settings_fields("livevalidation-group");?>
    <?php do_settings_sections("livevalidation-group");?>
    <table class="widefat" style="width:800px;">

    <h3>Section Registration:</h3>

        <thead style="background:#2EA2CC;color:#fff;">
            <tr>
                <th style="color:#fff;">Username text length</th>
                <th style="color:#fff;">Valid</th>
                <th style="color:#fff;">Error</th>
                <th style="color:#fff;">Active</th>
            </tr>
        </thead>
<tr>
<td><input type="text" size="10" id="" name="" value="<?php echo get_option("");?>"/></td>
<td><input type="text" size="10" id="" name="" value="<?php echo get_option("");?>"/></td>
<td><input type="text" size="10" id="" name="" value="<?php echo get_option("");?>"/></td>
<td><input type="text" size="10" id="" name="" value="<?php echo get_option("");?>"/></td>
        </tr>
  </table>
    <?php submit_button(); ?>
</form>
</div>
<?php
} 

function jquery_livevalidation_js()
{
    wp_register_script( 'livevalidation-script', plugins_url( '/js/livevalidation_standalone.compressed.js', __FILE__ ) );
    wp_enqueue_script( 'livevalidation-script' );
}
add_action( 'wp_enqueue_scripts', 'jquery_livevalidation_js' );

function livevalidation_styles()
{
    wp_register_style( 'livevalidation-style', plugins_url( '/css/style.css', __FILE__ ) );
    wp_enqueue_style( 'livevalidation-style' );
}
add_action( 'wp_enqueue_scripts', 'livevalidation_styles' );

function pp_livevalidation() {	?>
<script>
var user_login = new LiveValidation('user_login', { validMessage: " ", onlyOnBlur: true } );
user_login.add( Validate.Length, { wrongLengthMessage: "Do", is: 4 } );
</script>
<?php }

add_action('wp_footer', 'pp_livevalidation');

?>