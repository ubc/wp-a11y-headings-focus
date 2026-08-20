<?php
/**
 * Plugin Name:       WP A11y Headings Focus (Testing)
 * Description:       Adds a tabindex="-1" to heading blocks to receive focus programatically.
 * Requires at least: 6.5
 * Requires PHP:      8.2
 * Version:           0.0.1
 * Author:            LTIC WordPress
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-a11y-headings-focus
 *
 * @package           wp-a11y-headings-focus
 */

namespace UBC\LTIC\A11y\HeadingsFocus;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add tabindex="-1" to heading blocks.
 *
 * @param string $block_content The block content.
 * @param array  $block         The block data.
 *
 * @return string The modified block content.
 */
function add_tabindex_to_heading_block( $block_content, $block ) {
	if ( 'core/heading' !== $block['blockName'] ) {
		return $block_content;
	}

	$processor = new \WP_HTML_Tag_Processor( $block_content );

	if ( $processor->next_tag( array( 'class_name' => 'wp-block-heading' ) ) ) {
		$processor->set_attribute( 'tabindex', '-1' );
		$block_content = $processor->get_updated_html();
	}

	return $block_content;
}

add_filter( 'render_block', __NAMESPACE__ . '\\add_tabindex_to_heading_block', 10, 2 );
