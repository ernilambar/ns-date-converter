<?php
/**
 * Init
 *
 * @package NS_Date_Converter
 */

namespace NSDateConverter;

/**
 * Init class.
 *
 * @since 1.0.0
 */
final class Init {

	/**
	 * Store all the classes inside an array.
	 *
	 * @since 1.0.0
	 *
	 * @return array Full list of classes.
	 */
	public static function get_services() {
		return array(
			Core\Core::class,
			Core\Shortcode::class,
		);
	}

	/**
	 * Register services.
	 *
	 * Loop through the classes, initialize them, and call the register() method if it exists.
	 *
	 * @since 1.0.0
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class_name ) {
			$service = self::instantiate( $class_name );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 *
	 * @param  class $class_name Class from the services array.
	 * @return class instance   New instance of the class.
	 */
	private static function instantiate( $class_name ) {
		return new $class_name();
	}
}
