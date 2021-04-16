<?php
/**
 * Plugin Name:       Disable FLoC
 * Description:       Disables FLoC tracking for your website's visitors.
 * Version:           1.0
 * Requires at least: 5.0
 * Requires PHP:      5.6
 * Author:            Roy Tanck
 * Author URI:        https://roytanck.com
 * License:           GPLv3
 */

namespace RoyTanck\DisableFLoC;

// If called without WordPress, exit.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Plugin {

	const HEADER_KEY = 'Permissions-Policy';
	const HEADER_VAL = 'interest-cohort=()';

	public static function add_http_header( $headers ){

		// Check for an existing Permissions-Policy header.
		if( isset( $headers[ self::HEADER_KEY ] ) ) {
			
			// Get the existing values of the header.
			$values = explode( ',', $headers[ self::HEADER_KEY ] );
			$values = array_map( 'trim', $values );

			// Loop through the values to see if there already is a cohort setting.
			foreach( $values as $value ) {
				if( stripos( $value, 'interest-cohort' ) !== false ){
					// Existing value, so exit.
					return $headers;
				}
			}
			
			// Not found, so add our value.
			$values[] = self::HEADER_VAL;
			$headers[ self::HEADER_KEY ] = implode( ', ', $values );
			
			return $headers;

		} else {

			// No existing Permission-Policy header, so add it.
			$headers[ self::HEADER_KEY ] = self::HEADER_VAL;		
		}

		return $headers;
	}

}

add_filter( 'wp_headers', [ 'RoyTanck\DisableFLoC\Plugin', 'add_http_header' ] );
