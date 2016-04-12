<?php
/**
 * WooCommerce Nested Category Layout
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Nested Category Layout to newer
 * versions in the future. If you wish to customize WooCommerce Nested Category Layout for your
 * needs please refer to http://docs.woothemes.com/document/woocommerce-nested-category-layout/ for more information.
 *
 * @package   WC-Nested-Category-Layout/Compatibility
 * @author    SkyVerge
 * @copyright Copyright (c) 2012-2014, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

/**
 * Genesis Theme Compatibility
 *
 * Adds genesis theme compatibility.  The Genesis Connect WooCommerce plugin
 * defines its own template loader, which will bypass our custom template
 * loader, thus loading the default archive-product.php template rather than the
 * one defined in this plugin.  This presents itself as additional products
 * being displayed at the bottom of the shop/product category pages.
 * The solution is to unhook the relevant genesis functions and call our own
 * modified versions of their template function, invoking our custom nested
 * category layout code
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// swoop in before the genesis actions even have a chance
add_action( 'genesis_loop',        'woo_nestedcatlayout_genesis_loop',        5 );
add_action( 'genesis_before_loop', 'woo_nestedcatlayout_genesis_before_loop', 5 );

/**
 * Unhook the genesis-woocommerce product taxonomy loop, and call
 * our own compatible version, for the product category pages
 *
 * Code based on Genesis Connect for WooCommerce 0.9.5 genesiswooc_product_taxonomy_loop()
 * @see genesis-connect-woocommerce/templates/taxonomy.php
 */
function woo_nestedcatlayout_genesis_loop() {

	if ( is_product_category() ) {

		// remove the genesis-woocommerce product taxonomy loop
		remove_action( 'genesis_loop', 'genesiswooc_product_taxonomy_loop' );

		// and call our own modified version so we can get our overridden archive-product template
		wc_nested_category_layout_genesiswooc_content_product();

	}
}


/**
 * Unhook the gensis-woocommerce archive product loop, and call our own
 * compatible version, for the shop page
 *
 * Code based on Genesis Connect for WooCommerce 0.9.5 genesiswooc_archive_product_loop()
 * @see genesis-connect-woocommerce/templates/archive-product.php
 */
function woo_nestedcatlayout_genesis_before_loop() {

	if ( is_shop() ) {

		// remove the genesis-woocommerce shop page loop
		remove_action( 'genesis_before_loop', 'genesiswooc_archive_product_loop' );

		// and call our own compatible version so we can get our overriden archive-product template
		wc_nested_category_layout_genesiswooc_content_product();
	}
}


if ( ! function_exists( 'wc_nested_category_layout_genesiswooc_content_product' ) ) {
	/**
	 * Displays shop items for archives (taxonomy and main shop page)
	 *
	 * Uses WooCommerce structure and contains all existing WooCommerce hooks
	 *
	 * Code based on Genesis Connect for WooCommerce 0.9.5 genesiswooc_content_product()
	 * @see genesis-connect-woocommerce/lib/template-loader.php
	 */
	function wc_nested_category_layout_genesiswooc_content_product() {

		do_action('woocommerce_before_main_content');
		?>

		<h1 class="page-title">
			<?php if ( is_search() ) : ?>
				<?php
					printf( __( 'Search Results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );
					if ( get_query_var( 'paged' ) )
						printf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) );
				?>
			<?php elseif ( is_tax() ) : ?>
				<?php echo single_term_title( "", false ); ?>
			<?php else : ?>
				<?php
					$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );

					echo apply_filters( 'the_title', ( $shop_page_title = get_option( 'woocommerce_shop_page_title' ) ) ? $shop_page_title : $shop_page->post_title );
				?>
			<?php endif; ?>
		</h1>

		<?php if ( is_tax() && get_query_var( 'paged' ) == 0 ) : ?>
			<?php echo '<div class="term-description">' . wpautop( wptexturize( term_description() ) ) . '</div>'; ?>
		<?php elseif ( ! is_search() && get_query_var( 'paged' ) == 0 && ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
			<?php echo '<div class="page-description">' . apply_filters( 'the_content', $shop_page->post_content ) . '</div>'; ?>
		<?php endif; ?>

		<?php /* Justin Stern: Modification for nested category layout plugin */ ?>
		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php do_action('woocommerce_before_shop_loop'); ?>

			<ul class="products">

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			</ul>

			<?php do_action('woocommerce_after_shop_loop'); ?>

		<?php else : ?>

			<?php if ( ! woocommerce_product_subcategories( array( 'before' => '<ul class="products">', 'after' => '</ul>' ) ) ) : ?>

				<p><?php _e( 'No products found which match your selection.', 'woocommerce' ); ?></p>

			<?php endif; ?>

		<?php endif; ?>

		<div class="clear"></div>

		<?php do_action( 'woocommerce_pagination' ); ?>

		<?php do_action('woocommerce_after_main_content');
	}
}
