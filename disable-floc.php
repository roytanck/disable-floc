<?php
/**
 * Plugin Name:       Disable FLoC
 * Plugin URI:        https://roytanck.com/?p=453
 * Description:       Disables FLoC tracking for your website's visitors.
 * Version:           1.1
 * Requires at least: 4.9
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
		$key = self::find_array_key( self::HEADER_KEY, $headers );
		
		if( $key ){
			
			// Get the existing values of the header.
			$values = explode( ',', $headers[ $key ] );
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
			$headers[ $key ] = implode( ', ', $values );
			
			return $headers;

		} else {

			// No existing Permission-Policy header, so add it.
			$headers[ self::HEADER_KEY ] = self::HEADER_VAL;		
		}

		return $headers;
	}


	// Case-insensitive array key lookup helper method.
	private static function find_array_key( $key, $array ){
		$keys = array_keys( $array );
		foreach( $keys as $k ) {
			if( strcasecmp( $key, $k ) === 0 ){
				return $k;
			}
		}
		return false;
	}


	// Add the Permissions-Policy header to WPSC's known headers.
	public static function add_wpsc_known_header( $headers ) {
		if( !in_array( self::HEADER_KEY, $headers ) ) {
			$headers[] = self::HEADER_KEY;
		}
		return $headers;
	}

}

// Use WP's 'wp_headers' hook to add or modify the Permissions-Policy header.
add_filter( 'wp_headers', [ 'RoyTanck\DisableFLoC\Plugin', 'add_http_header' ] );

// Use a WP Super Cache hook to add support for the Permissions-Policy header.
add_filter( 'wpsc_known_headers', [ 'RoyTanck\DisableFLoC\Plugin', 'add_wpsc_known_header' ] );
