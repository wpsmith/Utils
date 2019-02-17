<?php
/**
 * WP Widget Class File
 *
 * Assist in creating WordPress Widgets.
 *
 * You may copy, distribute and modify the software as long as you track changes/dates in source files.
 * Any modifications to or software including (via compiler) GPL-licensed code must also be made
 * available under the GPL along with build & install instructions.
 *
 * @category   WPS\Core\Utils
 * @package    WPS\Core\Utils
 * @author     Travis Smith <t@wpsmith.net>
 * @copyright  2015-2018 Travis Smith
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License v2
 * @link       https://github.com/wpsmith/WPS
 * @since      0.1.0
 */

namespace WPS\Core;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( __NAMESPACE__ . '\Utils' ) ) {
	/**
	 * Class WP_Widget.
	 *
	 * @package WPS\Core
	 */
	class Utils extends Singleton {

		/**
		 * Conditionally defines a constant.
		 *
		 * @param string $constant Constant name.
		 * @param mixed $value Value of the constant.
		 */
		public static function define( $constant, $value ) {

			if ( ! defined( $constant ) ) {
				define( $constant, $value );
			}

		}

		/**
		 * Parses a string into an array of items by a deliminator.
		 *
		 * @param string $items_str Items string. For example: name,game,date,amount;name,game,date,amount
		 *
		 * @return array
		 */
		public static function parse_string( $items_str, $deliminator = ';' ) {

			return explode( $deliminator, $items_str );

		}

		/**
		 * Monefy - PHP Ultimate Money / Currency / Float Formatter and Fixer
		 *
		 * This function formats almost any input to currency and can also
		 * parse the formatted value as a float for database/backend operations
		 *
		 * @link https://gist.github.com/vanderson139/bdf7f93e51bda6ee9337cad1351afa2e
		 *
		 * @param mixed $input
		 * @param int $decimals Number of decimals
		 * @param string $dec_point Decimal point.
		 * @param string $thousands_sep Thousands separator.
		 * @param string $prefix Prefix for numeric output.
		 * @param string $suffix Prefix for numeric output.
		 *
		 * @return string
		 */
		public static function monefy( $input, $decimals = 2, $dec_point = '.', $thousands_sep = ',', $prefix = '$', $suffix = '' ) {

			// remove HTML encoded characters: http://stackoverflow.com/a/657670
			// special characters that arrive like &0234;
			$input = preg_replace( "/&#?[a-z0-9]{2,8};/i", '', $input );

			// trim
			$number = preg_replace( '/^([^0-9\-]+)|([^0-9\-]+)$/', '', $input );
			if ( empty( $number ) ) {
				return $prefix . $input . $suffix;
			}
			preg_match_all( '/[^0-9\-]/', $number, $last_dec_point, PREG_OFFSET_CAPTURE );
			while ( is_array( $last_dec_point ) ) {
				$last_dec_point = end( $last_dec_point );
			}
			if ( empty( $last_dec_point ) ) {
				return $prefix . number_format( $number, $decimals, $dec_point, $thousands_sep ) . $suffix;
			}
			$dec    = strlen( $number ) - ( $last_dec_point + 1 );
			$factor = '1' . str_pad( '', $dec, '0', STR_PAD_RIGHT );

			return $prefix . number_format( preg_replace( '/[^0-9\-]/', '', $number ) / $factor, $decimals, $dec_point, $thousands_sep ) . $suffix;

		}

	}
}
