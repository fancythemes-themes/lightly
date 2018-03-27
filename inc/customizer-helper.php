<?php

if ( ! defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

/* Sanitize Helper */

/**
 * @param $value
 *
 * @return int
 */
function lightly_sanitize_checkbox( $value ) {
	$value = (int) $value;

	return ( 1 === $value || true === $value ) ? 1 : 0;
}


/**
 * @param $value
 *
 * @return bool
 */
function lightly_sanitize_checkbox_js( $value ) {
	$value = (int) $value;

	return ( 1 === $value || true === $value ) ? true : false;
}


/**
 * @param $value
 * @param $field
 *
 * @return mixed|null
 */
function lightly_sanitize_choice( $value, $field ) {
	$default = null;
	$choices = array();

	if ( is_object( $field ) ) {
		$ID      = $field->id;
		$default = $field->manager->get_setting( $ID )->default;
		$choices = $field->manager->get_control( $ID )->choices;
	} elseif ( is_array( $field ) && isset( $field['control']['choices'] ) ) {
		$default = isset( $field['default'] ) ? $field['default'] : null;
		$choices = $field['control']['choices'];
	}

	return array_key_exists( $value, $choices ) ? $value : $default;
}


/* Following is the helper for customizer's select's choices array */

/**
 * Return array of terms
 *
 * @param string $taxonomy
 *
 * @return array
 */
function lightly_choice_taxonomy( $taxonomy = 'category' ) {

	$choices = array();
	$terms   = get_terms( array( 'taxonomy' => $taxonomy ) );

	$choices[] = __( '--Select--', 'lightly' );
	if ( is_array( $terms ) ) {
		foreach ( $terms as $term ) {
			$choices[ $term->term_id ] = $term->name;
		}
	}

	return $choices;
}