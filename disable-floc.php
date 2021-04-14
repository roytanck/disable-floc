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

// If called without WordPress, exit.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function disablefloc_add_http_header( $headers ){

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
		
		// Not found, so add our value.
		$values[] = $header_val;
		$headers[ $header_key ] = implode( ', ', $values );
		
		return $headers;

	} else {

		// No existing Permission-Policy header, so add it.
		$headers[ $header_key] = $header_val;		
	}

	return $headers;
}

add_filter( 'wp_headers', 'disablefloc_add_http_header' );
