<?php
/*
Plugin Name: Tribe Simpler CSS
Plugin URI: http://tri.be/
Description: Simplifies custom CSS on WordPress µ blogs.
Version: 0.6
Author: Brian Jessee
Author URI: http://tri.be/
Forked from Frederick Ding' Simpler CSS, which was forked from Jeremiah Orem's Custom User CSS plugin.
*/

/*  Copyright 2009  Modern Tribe, Jeremiah Orem, Frederick Ding

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$simpler_css_default = '/* Welcome to Simpler CSS!

If you are familiar with CSS, you may delete these comments and get started. CSS (Cascading Style Sheets) is a kind of code that tells the browser how to render a web page. Here\'s an example:

img { border: 1px dotted red; }

That line basically means "give images a dotted red border one pixel thick."

CSS is not very hard to learn. There are many free references to help you get started, like http://www.w3schools.com/css/default.asp

We hope you enjoy developing your custom CSS. Here are a few things to keep in mind:
 - You cannot edit the stylesheets of your theme. Your stylesheet will be loaded after the theme stylesheets, which means that your rules can take precedence and override the theme CSS rules.
 - CSS comments will be stripped from your stylesheet when outputted. */

/* This is a comment.*/

/*
Things we strip out include:
 * HTML code
 * @import rules
 * comments (upon output)

Things we encourage include:
 * testing in several browsers!
 * trying things out!

(adapted from WordPress.com)
*/';

function simpler_css_addcss() {
	$simpler_css_css = get_option( 'simpler_css_css' );
	echo '<style type="text/css">' . "\n";
	echo simpler_css_filter( $simpler_css_css ) . "\n";
	echo '</style>' . "\n";
}

function simpler_css_filter( $_content ) {
	$_return = preg_replace( '/@import.+;( |)|((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/))/i', '', $_content );
	$_return = htmlspecialchars( strip_tags( $_return ), ENT_NOQUOTES, 'UTF-8' );

	return $_return;
}

function simpler_css_menu() {
	add_theme_page( 'Simpler CSS Options', 'Custom CSS', 'edit_theme_options', __FILE__, 'simpler_css_options' );
}

function simpler_css_options() {
	global $simpler_css_default;
	$updated  = false;
	$opt_name = 'simpler_css_css';

	$css_val = get_option( $opt_name );
	if ( empty ( $css_val ) ) {
		$css_val = $simpler_css_default;
	}

	if ( isset( $_POST ['action'] ) && 'update' == $_POST ['action'] ) {

		if ( isset( $_POST['simpler-css-field'] ) || wp_verify_nonce( $_POST['simpler-css-field'], 'update-simpler-css' ) ) {

			$css_val = stripslashes( $_POST [ $opt_name ] );
			update_option( $opt_name, $css_val );
			$updated = true;

		} else {
			?>
			<div class="error">
				<p><strong><?php _e( 'Sorry, your nonce did not verify.', 'mt_trans_domain' ); ?></strong></p>
			</div>
			<?php
		}
	}

	if ( $updated ) {
		?>
		<div class="updated">
			<p><strong><?php _e( 'Options saved.', 'mt_trans_domain' ); ?></strong></p>
		</div>
		<?php
	}
	?>
	<div class="wrap">
		<h2>Simpler CSS Options &mdash; Custom Styles</h2>

		<form method="post" action="<?php echo $_SERVER ['REQUEST_URI'] ?>">

			<?php wp_nonce_field( 'update-simpler-css', 'simpler-css-field' ); ?>

			<table class="form-table">
				<tr valign="top">
					<th scope="row">Custom CSS</th>
					<td>
						<textarea cols="80" rows="25" name="<?php echo $opt_name ?>"><?php echo $css_val ?></textarea>
					</td>
				</tr>
			</table>

			<input type="hidden" name="action" value="update"/> <input
				type="hidden" name="page_options" value="<?php
			echo $opt_name ?>"/>

			<p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>"/></p>
		</form>

	</div>
	<?php
}

add_action( 'admin_menu', 'simpler_css_menu' );
add_action( 'wp_head', 'simpler_css_addcss', 20 );