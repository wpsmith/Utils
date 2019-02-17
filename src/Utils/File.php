<?php
/**
 * File Utils class.
 *
 * You may copy, distribute and modify the software as long as you track
 * changes/dates in source files. Any modifications to or software including
 * (via compiler) GPL-licensed code must also be made available under the GPL
 * along with build & install instructions.
 *
 * PHP Version 7.2
 *
 * @category   WPS\Core\Utils
 * @package    WPS\Core\Utils
 * @author     Travis Smith <t@wpsmith.net>
 * @copyright  2019 Travis Smith
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License v2
 * @link       https://wpsmith.net/
 * @since      0.0.1
 */

namespace WPS\Core\Utils;

use WPS\Core\Singleton;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( __NAMESPACE__ . '\File' ) ) {
	/**
	 * Class File
	 *
	 * @package WPS\Core\Utils
	 */
	class File extends Singleton {

		/**
		 * Gets a json file.
		 *
		 * @param string $file Absolute path to JSON file.
		 *
		 * @return array|mixed|object
		 */
		public static function get_json_file( $file ) {

			return json_decode( file_get_contents( $file ), true );

		}

		/**
		 * Creates a file if it does not exist.
		 *
		 * @param string $file File absolute path.
		 * @param bool $contents Contents of the file.
		 *
		 * @return bool|resource
		 */
		public static function create_file( $file, $contents = false ) {

			if ( ! file_exists( $file ) ) {
				$handle = fopen( $file, 'w' ) or die( 'Cannot open file:  ' . $file ); //implicitly creates file
				if ( $contents ) {
					fwrite( $handle, $contents );
				}

				return $handle;
			}

			return false;

		}

	}
}

