<?php
/**
 * Plugin Name: Vehicle Search Plugin for Elementor
 * Plugin URI:  https://creativeair.co
 * Description: A vehicle search plugin utilizing https://www.data.gov/developers/apis
 * Version:     1.0
 * Author:      Creative Air Co.
 * Author URI:  https://creativeair.co
 * Donate link: https://creativeair.co
 * License:     GPLv2
 * Text Domain: vehicle-search-plugin
 * Domain Path: /languages
 *
 * @link    https://creativeair.co
 *
 * @package Vehicle_Search_Plugin
 * @version 1.0
 *
 * 
 */

/**
 * Copyright (c) 2020 Creative Air Co. (email : shawnw@creativeair.co)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


/**
 * Autoloads files with classes when needed.
 *
 * @since  1.0
 * @param  string $class_name Name of the class being requested.
 */
function vehicle_search_plugin_autoload_classes( $class_name ) {

	// If our class doesn't have our prefix, don't load it.
	if ( 0 !== strpos( $class_name, 'VSP_' ) ) {
		return;
	}

	// Set up our filename.
	$filename = strtolower( str_replace( '_', '-', substr( $class_name, strlen( 'VSP_' ) ) ) );

	// Include our file.
	Vehicle_Search_Plugin::include_file( 'includes/class-' . $filename );
}
spl_autoload_register( 'vehicle_search_plugin_autoload_classes' );

/**
 * Main initiation class.
 *
 * @since  1.0
 */
final class Vehicle_Search_Plugin {

	/**
	 * Current version.
	 *
	 * @var    string
	 * @since  1.0
	 */
	const VERSION = '1.0';

	/**
	 * URL of plugin directory.
	 *
	 * @var    string
	 * @since  1.0
	 */
	protected $url = '';

	/**
	 * Path of plugin directory.
	 *
	 * @var    string
	 * @since  1.0
	 */
	protected $path = '';

	/**
	 * Plugin basename.
	 *
	 * @var    string
	 * @since  1.0
	 */
	protected $basename = '';

	/**
	 * Detailed activation error messages.
	 *
	 * @var    array
	 * @since  1.0
	 */
	protected $activation_errors = array();

	/**
	 * Singleton instance of plugin.
	 *
	 * @var    Vehicle_Search_Plugin
	 * @since  1.0
	 */
	protected static $single_instance = null;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since   1.0
	 * @return  Vehicle_Search_Plugin A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	/**
	 * Sets up our plugin.
	 *
	 * @since  1.0
	 */
	protected function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->url      = plugin_dir_url( __FILE__ );
		$this->path     = plugin_dir_path( __FILE__ );
	}

	/**
	 * Attach other plugin classes to the base plugin class.
	 *
	 * @since  1.0
	 */
	public function plugin_classes() {
		$this->api_widget = new VSP_Api_Widget(  );
		$this->custom_control = new VSP_Custom_Control(  );

	} // END OF PLUGIN CLASSES FUNCTION

	/**
	 * Add hooks and filters.
	 * Priority needs to be
	 * < 10 for CPT_Core,
	 * < 5 for Taxonomy_Core,
	 * and 0 for Widgets because widgets_init runs at init priority 1.
	 *
	 * @since  1.0
	 */
	public function hooks() {

		add_action( 'init', array( $this, 'init' ), 0 );

		// Add js to Elementor page
		add_action( 'elementor/editor/before_enqueue_scripts', function() {
		   wp_enqueue_script(
		   	'custom-api',
		   	$this->url . 'assets/js/custom_api.js',
		   	[
		   		'elementor-editor', // dependency
		   	],
		   	'1.0',
		   	true // in_footer
		   );
		} );
		// Add css to Elementor page
		add_action( 'elementor/editor/before_enqueue_styles', function() {
		   wp_register_style(
			'vehicle-css',
		   	$this->url . 'assets/css/style.css',
			[],
			'1.0'
		);
		   		wp_enqueue_style( 'vehicle-css' );

		} );

		add_action( 'elementor/controls/controls_registered', function ( $manager){
        $manager->register_control( 'vehicleidcontrol', new VSP_Custom_Control());
			
	} );

	}

	/**
	 * Activate the plugin.
	 *
	 * @since  1.0
	 */
	public function _activate() {
		// Bail early if requirements aren't met.
		if ( ! $this->check_requirements() ) {
			return;
		}

		// Make sure any rewrite functionality has been loaded.
		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin.
	 * Uninstall routines should be in uninstall.php.
	 *
	 * @since  1.0
	 */
	public function _deactivate() {
		// Add deactivation cleanup functionality here.
	}

	/**
	 * Init hooks
	 *
	 * @since  1.0
	 */
	public function init() {

		// Bail early if requirements aren't met.
		if ( ! $this->check_requirements() ) {
			return;
		}

		// Load translated strings for plugin.
		load_plugin_textdomain( 'vehicle-search-plugin', false, dirname( $this->basename ) . '/languages/' );

		// Initialize plugin classes.
		$this->plugin_classes();

		// Register the widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \VSP_Api_Widget() );


	}

	/**
	 * Check if the plugin meets requirements and
	 * disable it if they are not present.
	 *
	 * @since  1.0
	 *
	 * @return boolean True if requirements met, false if not.
	 */
	public function check_requirements() {

		// Bail early if plugin meets requirements.
		if ( $this->meets_requirements() ) {
			return true;
		}

		// Add a dashboard notice.
		add_action( 'all_admin_notices', array( $this, 'requirements_not_met_notice' ) );

		// Deactivate our plugin.
		add_action( 'admin_init', array( $this, 'deactivate_me' ) );

		// Didn't meet the requirements.
		return false;
	}

	/**
	 * Deactivates this plugin, hook this function on admin_init.
	 *
	 * @since  1.0
	 */
	public function deactivate_me() {

		// We do a check for deactivate_plugins before calling it, to protect
		// any developers from accidentally calling it too early and breaking things.
		if ( function_exists( 'deactivate_plugins' ) ) {
			deactivate_plugins( $this->basename );
		}
	}

	/**
	 * Check that all plugin requirements are met.
	 *
	 * @since  1.0
	 *
	 * @return boolean True if requirements are met.
	 */
	public function meets_requirements() {

		// Do checks for required classes / functions or similar.
		// Add detailed messages to $this->activation_errors array.
		return true;
	}

	/**
	 * Adds a notice to the dashboard if the plugin requirements are not met.
	 *
	 * @since  1.0
	 */
	public function requirements_not_met_notice() {

		// Compile default message.
		$default_message = sprintf( __( 'Vehicle Search Plugin is missing requirements and has been <a href="%s">deactivated</a>. Please make sure all requirements are available.', 'vehicle-search-plugin' ), admin_url( 'plugins.php' ) );

		// Default details to null.
		$details = null;

		// Add details if any exist.
		if ( $this->activation_errors && is_array( $this->activation_errors ) ) {
			$details = '<small>' . implode( '</small><br /><small>', $this->activation_errors ) . '</small>';
		}

		// Output errors.
		?>
		<div id="message" class="error">
			<p><?php echo wp_kses_post( $default_message ); ?></p>
			<?php echo wp_kses_post( $details ); ?>
		</div>
		<?php
	}

	/**
	 * Magic getter for our object.
	 *
	 * @since  1.0
	 *
	 * @param  string $field Field to get.
	 * @throws Exception     Throws an exception if the field is invalid.
	 * @return mixed         Value of the field.
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'version':
				return self::VERSION;
			case 'basename':
			case 'url':
			case 'path':
			case 'api_widget':
			case 'custom_control':
				return $this->$field;
			default:
				throw new Exception( 'Invalid ' . __CLASS__ . ' property: ' . $field );
		}
	}

	/**
	 * Include a file from the includes directory.
	 *
	 * @since  1.0
	 *
	 * @param  string $filename Name of the file to be included.
	 * @return boolean          Result of include call.
	 */
	public static function include_file( $filename ) {
		$file = self::dir( $filename . '.php' );
		if ( file_exists( $file ) ) {
			return include_once( $file );
		}
		return false;
	}

	/**
	 * This plugin's directory.
	 *
	 * @since  1.0
	 *
	 * @param  string $path (optional) appended path.
	 * @return string       Directory and path.
	 */
	public static function dir( $path = '' ) {
		static $dir;
		$dir = $dir ? $dir : trailingslashit( dirname( __FILE__ ) );
		return $dir . $path;
	}

	/**
	 * This plugin's url.
	 *
	 * @since  1.0
	 *
	 * @param  string $path (optional) appended path.
	 * @return string       URL and path.
	 */
	public static function url( $path = '' ) {
		static $url;
		$url = $url ? $url : trailingslashit( plugin_dir_url( __FILE__ ) );
		return $url . $path;
	}
}

/**
 * Grab the Vehicle_Search_Plugin object and return it.
 * Wrapper for Vehicle_Search_Plugin::get_instance().
 *
 * @since  1.0
 * @return Vehicle_Search_Plugin  Singleton instance of plugin class.
 */
function vehicle_search_plugin() {
	return Vehicle_Search_Plugin::get_instance();
}

// Kick it off.
add_action( 'plugins_loaded', array( vehicle_search_plugin(), 'hooks' ) );

// Activation and deactivation.
register_activation_hook( __FILE__, array( vehicle_search_plugin(), '_activate' ) );
register_deactivation_hook( __FILE__, array( vehicle_search_plugin(), '_deactivate' ) );