<?php
/*
Plugin Name: Premiumpress live validation
Plugin URI: http://coderspress.com/
Description: Premiumpress live form validation as you type
Version: 2015.0606
Updated: 6th June 2015
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
	register_setting( 'livevalidation-group', 'user_login_text_length' );
	register_setting( 'livevalidation-group', 'user_login_error_message' );
	register_setting( 'livevalidation-group', 'user_login_active' );
	register_setting( 'livevalidation-group', 'user_login_space' );
	register_setting( 'livevalidation-group', 'user_email_text_length' );
	register_setting( 'livevalidation-group', 'user_email_error_message' );
	register_setting( 'livevalidation-group', 'user_email_active' );
	register_setting( 'livevalidation-group', 'pass1_text_length' );
	register_setting( 'livevalidation-group', 'pass1_error_message' );
	register_setting( 'livevalidation-group', 'pass1_active' );
	register_setting( 'livevalidation-group', 'pass2_error_message' );
	register_setting( 'livevalidation-group', 'pass2_active' );
	register_setting( 'livevalidation-group', 'reg_val_error_message' );
	register_setting( 'livevalidation-group', 'reg_val_active' );
}
function livevalidation_defaults()
{
    $option = array(
        'user_login_text_length' => '2',
        'user_login_error_message' => "Please enter 2 or more characters! No Spaces Allowed",
        'user_login_active' => 'no',
        'user_login_space' => 'no',
        'user_email_text_length' => '6',
        'user_email_error_message' => "Please enter a valid email address!",
        'user_email_active' => 'no',
        'pass1_text_length' => '5',
        'pass1_error_message' => "Please enter 5 or more characters!",
        'pass1_active' => 'no',
        'pass2_error_message' => "Passwords do not match!",
        'pass2_active' => 'no',
        'reg_val_error_message' => "Incorrect, numbers only!",
        'reg_val_active' => 'no',
    );
    foreach ( $option as $key => $value )
    {
       if (get_option($key) == NULL) {
        update_option($key, $value);
       }
    }
    return;
}
register_activation_hook(__FILE__, 'livevalidation_defaults');
function livevalidation_settings_page() {
if ($_REQUEST['settings-updated']=='true') {
echo '<div id="message" class="updated fade"><p><strong>Plugin settings saved.</strong></p></div>';
}
?>
<style>
/* The CSS */
select {
    padding:3px;
    margin: 0;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    -webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
    background: #f8f8f8;
    color:#888;
    border:none;
    outline:none;
    display: inline-block;
    -webkit-appearance:none;
    -moz-appearance:none;
    appearance:none;
    cursor:pointer;
}
</style>
<div class="wrap">
    <h1>Premiumpress Live Validation</h1>
    <hr />
<form method="post" action="options.php">
    <?php settings_fields("livevalidation-group");?>
    <?php do_settings_sections("livevalidation-group");?>
    <table class="widefat" style="width:890px;">

    <h3>Section Registration and Login:</h3>

        <thead style="background:#2EA2CC;color:#fff;">
            <tr>
                <th style="color:#fff;">Username length</th>
                <th style="color:#fff;">Error message</th>
                <th style="color:#fff;">Spaces Allowed</th>
                <th style="color:#fff;">Validate</th>
            </tr>
        </thead>
<tr>
<td><input type="text" size="1" id="user_login_text_length" name="user_login_text_length" value="<?php echo get_option("user_login_text_length");?>"/></td>
<td><input type="text" size="70" id="user_login_error_message" name="user_login_error_message" value="<?php echo get_option("user_login_error_message");?>"/></td>
<td>
        <select name="user_login_space" />
        <option value="yes" <?php if ( get_option('user_login_space') == 'yes' ) echo 'selected="selected"'; ?>>Yes</option>
        <option value="no" <?php if ( get_option('user_login_space') == 'no' ) echo 'selected="selected"'; ?>>No</option>
         </select>
</td>
<td>
        <select name="user_login_active" />
        <option value="yes" <?php if ( get_option('user_login_active') == 'yes' ) echo 'selected="selected"'; ?>>Yes</option>
        <option value="no" <?php if ( get_option('user_login_active') == 'no' ) echo 'selected="selected"'; ?>>No</option>
         </select>
</td>
<tr>
        <thead style="background:#2EA2CC;color:#fff;">
            <tr>
                <th style="color:#fff;">Email length</th>
                <th style="color:#fff;">Error message</th>
                <th style="color:#fff;"></th>
                <th style="color:#fff;">Validate</th>
            </tr>
        </thead>
<tr>
<td><input type="text" size="1" id="user_email_text_length" name="user_email_text_length" value="<?php echo get_option("user_email_text_length");?>"/></td>
<td><input type="text" size="70" id="user_email_error_message" name="user_email_error_message" value="<?php echo get_option("user_email_error_message");?>"/></td>
<td></td>
<td>
        <select name="user_email_active" />
        <option value="yes" <?php if ( get_option('user_email_active') == 'yes' ) echo 'selected="selected"'; ?>>Yes</option>
        <option value="no" <?php if ( get_option('user_email_active') == 'no' ) echo 'selected="selected"'; ?>>No</option>
         </select>
</td>
        </tr>
<tr>
        <thead style="background:#2EA2CC;color:#fff;">
            <tr>
                <th style="color:#fff;">Password length</th>
                <th style="color:#fff;">Error message</th>
                <th style="color:#fff;"></th>
                <th style="color:#fff;">Validate</th>
            </tr>
        </thead>
<tr>
<td><input type="text" size="1" id="pass1_text_length" name="pass1_text_length" value="<?php echo get_option("pass1_text_length");?>"/></td>
<td><input type="text" size="70" id="pass1_error_message" name="pass1_error_message" value="<?php echo get_option("pass1_error_message");?>"/></td>
<td></td>
<td>
        <select name="pass1_active" />
        <option value="yes" <?php if ( get_option('pass1_active') == 'yes' ) echo 'selected="selected"'; ?>>Yes</option>
        <option value="no" <?php if ( get_option('pass1_active') == 'no' ) echo 'selected="selected"'; ?>>No</option>
         </select>
</td>
        </tr>
<tr>
        <thead style="background:#2EA2CC;color:#fff;">
            <tr>
                <th style="color:#fff;">Password confirm</th>
                <th style="color:#fff;">Error message</th>
                <th style="color:#fff;"></th>
                <th style="color:#fff;">Validate</th>
            </tr>
        </thead>
<tr>
<td><b>Password Compare</b>:</td>
<td><input type="text" size="70" id="pass2_error_message" name="pass2_error_message" value="<?php echo get_option("pass2_error_message");?>"/></td>
<td></td>
<td>
        <select name="pass2_active" />
        <option value="yes" <?php if ( get_option('pass2_active') == 'yes' ) echo 'selected="selected"'; ?>>Yes</option>
        <option value="no" <?php if ( get_option('pass2_active') == 'no' ) echo 'selected="selected"'; ?>>No</option>
         </select>
</td>
        </tr>
<tr>
        <thead style="background:#2EA2CC;color:#fff;">
            <tr>
                <th style="color:#fff;">Security</th>
                <th style="color:#fff;">Error message</th>
                <th style="color:#fff;"></th>
                <th style="color:#fff;">Validate</th>
            </tr>
        </thead>
<tr>
<td><b>Security Question</b>:</td>
<td><input type="text" size="70" id="reg_val_error_message" name="reg_val_error_message" value="<?php echo get_option("reg_val_error_message");?>"/></td>
<td></td>
<td>
        <select name="reg_val_active" />
        <option value="yes" <?php if ( get_option('reg_val_active') == 'yes' ) echo 'selected="selected"'; ?>>Yes</option>
        <option value="no" <?php if ( get_option('reg_val_active') == 'no' ) echo 'selected="selected"'; ?>>No</option>
         </select>
</td>
        </tr>
  </table>
    <?php submit_button(); ?>
</form>
</div>
<?php
} 

function jquery_livevalidation_js()
{
    wp_register_script( 'livevalidation-script', plugins_url( '/js/livevalidation_standalone.js', __FILE__ ) );
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
var user_login_active = "<?php echo get_option("user_login_active");?>";
if( user_login_active == 'yes' && jQuery('#user_login').length) {
var lv_user_login = new LiveValidation('user_login', { onlyOnBlur: true } );
lv_user_login.add( Validate.Length, { tooShortMessage: "<?php echo get_option("user_login_error_message");?>", minimum: <?php echo get_option("user_login_text_length");?> } );
var user_login_space = "<?php echo get_option("user_login_space");?>";
if( user_login_space == 'yes' ) {
lv_user_login.add( Validate.Exclusion, { failureMessage: "<?php echo get_option("user_login_error_message");?>", within: [' '], partialMatch: true } );
	}
}

var user_email_active = "<?php echo get_option("user_email_active");?>";
if( user_email_active == 'yes' && jQuery('#user_email').length) {
var lv_user_email = new LiveValidation('user_email', { onlyOnBlur: true } );
lv_user_email.add( Validate.Email, { failureMessage: "<?php echo get_option("user_email_error_message");?>", minimum: <?php echo get_option("user_email_text_length");?> } );
}

var pass1_active = "<?php echo get_option("pass1_active");?>";
if( pass1_active == 'yes' && jQuery('#pass1').length) {
var lv_pass1 = new LiveValidation('pass1', { onlyOnBlur: true } );
lv_pass1.add( Validate.Length, { tooShortMessage: "<?php echo get_option("pass1_error_message");?>", minimum: <?php echo get_option("pass1_text_length");?> } );
}

var pass2_active = "<?php echo get_option("pass2_active");?>";
if( pass2_active == 'yes' && jQuery('#pass2').length) {
var lv_pass2 = new LiveValidation('pass2', { onlyOnBlur: true } );
lv_pass2.add( Validate.Confirmation, { failureMessage: "<?php echo get_option("pass2_error_message");?>", match: 'pass1' } );
}

var reg_val_active = "<?php echo get_option("reg_val_active");?>";
jQuery("input[name=reg_val]").attr('id','reg_val');
if( reg_val_active == 'yes' && jQuery('input[name=reg_val]').length) {
var lv_reg_val = new LiveValidation('reg_val', { onlyOnBlur: true } );
lv_reg_val.add( Validate.Numericality, { notANumberMessage: "<?php echo get_option("reg_val_error_message");?>"} );
}
</script>
<?php }

add_action('wp_footer', 'pp_livevalidation');

?>