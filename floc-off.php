<?php
/**
 * Plugin Name:       FloC off!
 * Description:       Disables FLoC tracking for your website's visitors.
 * Version:           1.0
 * Requires at least: 5.0
 * Requires PHP:      5.6
 * Author:            Roy Tanck
 * Author URI:        https://roytanck.com
 * License:           GPLv3
 */

// If called without WordPress, exit.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if( ! function_exists( 'fo_add_header' ) ) {

	function fo_add_header( $headers ){

		// Details of the header we're looking to add.
		$header_key = 'Permissions-Policy';
		$header_val = 'interest-cohort=()';

		// Check for an existing Permissions-Policy header.
		if( isset( $headers[ $header_key ] ) ) {
			
			// Get the exisiting values of the header.
			$values = explode( ',', $headers[ $header_key ] );
			array_map( 'trim', $values );

			// Loop through the values to see if there already is a cohort setting.
			foreach( $values as $value ) {
				if( stripos( $value, 'interest-cohort' ) !== false ){
					// Existing value, so exit.
					return $headers;
				}
			}
			
			// Not found, so add our value
			$values[] = $header_val;
			$headers[ $header_key ] = implode( ', ', $values );
			
			return $headers;

		} else {

			// No existing Permission-Policy header, so add it.
			$headers['Permissions-Policy'] = 'interest-cohort=()';		
		}

		return $headers;
	}

	add_filter( 'wp_headers', 'fo_add_header' );

}
