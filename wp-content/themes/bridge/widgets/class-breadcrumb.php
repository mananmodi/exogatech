<?php
/**
 * FGI
 *
 * @package FGI
 * @version 1.0

 * File Name: Breadcrumb Widget
 * Description: Breadcrumb Widget
 * Author: We Are Star
 * Version: 1.0.0
 * Author URI: https://wearestar.com/
 */

/**
 * Breadcrumb Widget
 *
 * @file Caribe Hilton
 * Breadcrumb Widget
 */

namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module as QueryModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** Class Breadcrumb . */
class Breadcrumb extends Widget_Base {




	/** Function get_name() widget name.*/
	public function get_name() {
		return 'Breadcrumb';
	}
	/** Function get_title() widget title. */
	public function get_title() {
		return esc_html__( 'Breadcrumb', 'fgi' );
	}
	/** Function get_icon() widget icon. */
	public function get_icon() {
		return 'was-icon';
	}
	/** Function get_categories section. */
	public function get_categories() {
		return array( 'was' );
	}
	/** Function register_controls() input fields. */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => 'Settings',
			)
		);

		$this->end_controls_section();
	}

	/** Function render() */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$separator        = '/';
		$breadcrums_id    = 'breadcrumbs';
		$breadcrums_class = 'breadcrumb breadcrumb-navigation';
		$home_title       = __( 'Home', 'caribehilton' );

		$breadcrumb_html = '';

		$custom_taxonomy = 'product_cat';

		global $post;

		if ( ! is_front_page() ) {

			// Build the breadcrums.
			$breadcrumb_html .= '<div class="breadcrumb-wrap"><div class="container"><ul id="' . esc_html( $breadcrums_id ) . '" class="' . esc_html( $breadcrums_class ) . '">';

			// Home page.
			$breadcrumb_html .= '<li class="item-home"><a class="bread-link bread-home" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_html( $home_title ) . '">' . esc_html( $home_title ) . '</a></li>';
			$breadcrumb_html .= '<li class="separator separator-home"> ' . esc_html( $separator ) . ' </li>';

			if ( is_archive() && ! is_tax() && ! is_category() && ! is_tag() ) {

				$breadcrumb_html .= '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . esc_html( post_type_archive_title( $prefix, false ) ) . '</strong></li>';
			} elseif ( is_archive() && is_tax() && ! is_category() && ! is_tag() ) {

				$custom_tax_arr = get_queried_object();
				// If post is a custom post type.
				$post_type = get_post_type();

				if ( 'post' !== $post_type ) {

					$post_type_object  = get_post_type_object( $post_type );
					$post_type_archive = get_post_type_archive_link( $post_type );

					$breadcrumb_html .= '<li class="item-cat item-custom-post-type-' . esc_html( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_html( $post_type ) . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_html( $post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a></li>';
					$breadcrumb_html .= '<li class="separator"> ' . esc_html( $separator ) . ' </li>';
				}

				$custom_tax_name  = get_queried_object()->name;
				$breadcrumb_html .= '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . esc_html( $custom_tax_name ) . '</strong></li>';
			} elseif ( is_single() ) {

				// If post is a custom post type.
				$post_type = get_post_type();

				// If it is a custom post type display name and link.

				if ( 'post' !== $post_type ) {

					$post_type_object  = get_post_type_object( $post_type );
					$post_type_archive = get_post_type_archive_link( $post_type );

					if ( 'destination' === $post_type ) {
						$breadcrumb_html .= '<li class="item-cat item-custom-post-type-' . esc_attr( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr( $post_type ) . '" href="' . esc_url( home_url( 'charter/' ) ) . '" title="' . esc_attr( __( 'Charter' ) ) . '">' . esc_html( __( 'Charter' ) ) . '</a></li>';
						$breadcrumb_html .= '<li class="separator"> ' . esc_html( $separator ) . ' </li>';

						$breadcrumb_html .= '<li class="item-cat item-custom-post-type-' . esc_attr( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr( $post_type ) . '" href="' . esc_url( home_url( 'charter/destinations/' ) ) . '" title="' . esc_attr( __( 'Destinations' ) ) . '">' . esc_html( __( 'Destinations' ) ) . '</a></li>';
						$breadcrumb_html .= '<li class="separator"> ' . esc_html( $separator ) . ' </li>';

						if ( $post->post_parent ) {

							// If child page, get parents.
							$anc = get_post_ancestors( $post->ID );

							// Get parents in the right order.
							$anc = array_reverse( $anc );

							// Parent page loop.
							if ( ! isset( $parents ) ) {
								$parents = null;
							}
							foreach ( $anc as $ancestor ) {
								if ( is_page_template( 'checkout-thankyou.php' ) ) {
									$parents .= '<li class="item-parent item-parent-' . esc_html( $ancestor ) . '"><a class="bread-parent bread-parent-' . esc_html( $ancestor ) . '" href="' . esc_url( get_permalink( wc_get_page_id( 'cart' ) ) ) . '" title="' . esc_html( get_the_title( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a></li>';
								} else {
									$parents .= '<li class="item-parent item-parent-' . esc_html( $ancestor ) . '"><a class="bread-parent bread-parent-' . esc_html( $ancestor ) . '" href="' . esc_url( get_permalink( $ancestor ) ) . '" title="' . esc_html( get_the_title( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a></li>';
								}

								$parents .= '<li class="separator separator-' . esc_html( $ancestor ) . '"> ' . esc_html( $separator ) . ' </li>';
							}

							// Display parent pages.
							$breadcrumb_html .= wp_kses_post( $parents );

							// Current page.
							$breadcrumb_html .= '<li class="item-current item-' . esc_html( $post->ID ) . '"><strong class="bread-current bread-' . esc_html( $post->ID ) . '" title="' . esc_html( $currenttitle ) . '"> ' . esc_html( $currenttitle ) . '</strong></li>';
						}
					} elseif ( 'yacht-brokers' === $post_type ) {
						$breadcrumb_html .= '<li class="item-cat item-custom-post-type-' . esc_html( $post_type ) . '"><a class="bread-cat" href="' . esc_url( home_url( 'about/' ) ) . '" title="' . esc_attr( __( 'About' ) ) . '">' . esc_html( __( 'About' ) ) . '</a></li>';
						$breadcrumb_html .= '<li class="separator"> ' . esc_html( $separator ) . ' </li>';

						$breadcrumb_html .= '<li class="item-cat item-custom-post-type-' . esc_html( $post_type ) . '"><a class="bread-cat" href="' . esc_url( home_url( 'about/yacht-brokers/' ) ) . '" title="' . esc_attr( __( 'Yacht Brokers' ) ) . '">' . esc_html( __( 'Yacht Brokers' ) ) . '</a></li>';
						$breadcrumb_html .= '<li class="separator"> ' . esc_html( $separator ) . ' </li>';
					} else {
						$breadcrumb_html .= '<li class="item-cat item-custom-post-type-' . esc_html( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_html( $post_type ) . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_html( $post_type_object->labels->name ) . '">' . esc_html( $post_type_object->labels->name ) . '</a></li>';
						$breadcrumb_html .= '<li class="separator"> ' . esc_html( $separator ) . ' </li>';
					}
				} else {
					$breadcrumb_html .= '<li class="item-cat item-custom-post-type-' . esc_html( $post_type ) . '"><a class="bread-cat" href="' . esc_url( home_url( 'about/' ) ) . '" title="' . esc_attr( __( 'About' ) ) . '">' . esc_html( __( 'About' ) ) . '</a></li>';
					$breadcrumb_html .= '<li class="separator"> ' . esc_html( $separator ) . ' </li>';

					$breadcrumb_html .= '<li class="item-cat item-custom-post-type-' . esc_html( $post_type ) . '"><a class="bread-cat" href="' . esc_url( home_url( 'news-events/' ) ) . '" title="' . esc_attr( __( 'News & Events' ) ) . '">' . esc_html( __( 'News & Events' ) ) . '</a></li>';
					$breadcrumb_html .= '<li class="separator"> ' . esc_html( $separator ) . ' </li>';
				}

				// Get post category info.
				$category = get_the_category();

				if ( ! empty( $category ) ) {
					if ( 'post' !== $post_type ) {
						// Get last category post is in.
						$last_category = end( array_values( $category ) );

						// Get parent any categories and create array.
						$get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
						$cat_parents     = explode( ',', $get_cat_parents );

						// Loop through parent categories and store in variable $cat_display.
						$cat_display = '';
						foreach ( $cat_parents as $parents ) {
							$cat_display .= '<li class="item-cat">' . wp_kses_post( $parents ) . '</li>';
							$cat_display .= '<li class="separator"> ' . wp_kses_post( $separator ) . ' </li>';
						}
					}
				}

				// If it's a custom post type within a custom taxonomy.
				$taxonomy_exists = taxonomy_exists( $custom_taxonomy );
				if ( empty( $last_category ) && ! empty( $custom_taxonomy ) && $taxonomy_exists ) {

					$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
					$cat_id         = $taxonomy_terms[0]->term_id;
					$cat_nicename   = $taxonomy_terms[0]->slug;
					$cat_link       = get_term_link( $taxonomy_terms[0]->term_id, $custom_taxonomy );
					$cat_name       = $taxonomy_terms[0]->name;
				}

				// Check if the post is in a category.
				if ( ! empty( $last_category ) ) {

					$breadcrumb_html .= wp_kses_post( $cat_display );
					$breadcrumb_html .= '<li class="item-current item-' . esc_html( $post->ID ) . '"><strong class="bread-current bread-' . esc_html( $post->ID ) . '" title="' . esc_html( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</strong></li>';

					// Else if post is in a custom taxonomy.
				} elseif ( ! empty( $cat_id ) ) {

					$breadcrumb_html .= '<li class="item-cat item-cat-' . esc_html( $cat_id ) . ' item-cat-' . esc_html( $cat_nicename ) . '"><a class="bread-cat bread-cat-' . esc_html( $cat_id ) . ' bread-cat-' . esc_html( $cat_nicename ) . '" href="' . esc_url( $cat_link ) . '" title="' . esc_html( $cat_name ) . '">' . esc_html( $cat_name ) . '</a></li>';
					$breadcrumb_html .= '<li class="separator"> ' . esc_html( $separator ) . ' </li>';

					$breadcrumb_html .= '<li class="item-current item-' . esc_html( $post->ID ) . '"><strong class="bread-current bread-' . esc_html( $post->ID ) . '" title="' . esc_html( get_the_title() ) . '">' . esc_html( wp_strip_all_tags( get_the_title() ) ) . '</strong></li>';
				} else {

					$breadcrumb_html .= '<li class="item-current item-' . esc_html( $post->ID ) . '"><strong class="bread-current bread-' . esc_html( $post->ID ) . '" title="' . esc_html( get_the_title() ) . '">' . esc_html( wp_strip_all_tags( get_the_title() ) ) . '</strong></li>';
				}
			} elseif ( is_category() ) {

				// Category page.
				$breadcrumb_html .= '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . esc_html( single_cat_title( '', false ) ) . '</strong></li>';
			} elseif ( is_page() ) {

				if ( ! empty( $atts['currenttitle'] ) ) {
					$currenttitle = $atts['currenttitle'];
				} else {
					$currenttitle = get_the_title();
				}

				// Standard page.
				if ( $post->post_parent ) {

					// If child page, get parents.
					$anc = get_post_ancestors( $post->ID );

					// Get parents in the right order.
					$anc = array_reverse( $anc );

					// Parent page loop.
					if ( ! isset( $parents ) ) {
						$parents = null;
					}
					foreach ( $anc as $ancestor ) {
						if ( is_page_template( 'checkout-thankyou.php' ) ) {
							$parents .= '<li class="item-parent item-parent-' . esc_html( $ancestor ) . '"><a class="bread-parent bread-parent-' . esc_html( $ancestor ) . '" href="' . esc_url( get_permalink( wc_get_page_id( 'cart' ) ) ) . '" title="' . esc_html( get_the_title( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a></li>';
						} else {
							$parents .= '<li class="item-parent item-parent-' . esc_html( $ancestor ) . '"><a class="bread-parent bread-parent-' . esc_html( $ancestor ) . '" href="' . esc_url( get_permalink( $ancestor ) ) . '" title="' . esc_html( get_the_title( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a></li>';
						}

						$parents .= '<li class="separator separator-' . esc_html( $ancestor ) . '"> ' . esc_html( $separator ) . ' </li>';
					}

					// Display parent pages.
					$breadcrumb_html .= wp_kses_post( $parents );

					// Current page.
					$breadcrumb_html .= '<li class="item-current item-' . esc_html( $post->ID ) . '"><strong class="bread-current bread-' . esc_html( $post->ID ) . '" title="' . esc_html( $currenttitle ) . '"> ' . esc_html( $currenttitle ) . '</strong></li>';
				} else {

					// Just display current page if not parents.
					$breadcrumb_html .= '<li class="item-current item-' . esc_html( $post->ID ) . '"><strong class="bread-current bread-' . esc_html( $post->ID ) . '"> ' . esc_html( $currenttitle ) . '</strong></li>';
				}
			} elseif ( is_tag() ) {

				// Tag page.

				// Get tag information.
				$term_id       = get_query_var( 'tag_id' );
				$taxonomy      = 'post_tag';
				$args          = 'include=' . $term_id;
				$terms         = get_terms( $taxonomy );
				$get_term_id   = $terms[0]->term_id;
				$get_term_slug = $terms[0]->slug;
				$get_term_name = $terms[0]->name;

				// Display the tag name.
				$breadcrumb_html .= '<li class="item-current item-tag-' . esc_html( $get_term_id ) . ' item-tag-' . esc_html( $get_term_slug ) . '"><strong class="bread-current bread-tag-' . esc_html( $get_term_id ) . ' bread-tag-' . esc_html( $get_term_slug ) . '">' . esc_html( $get_term_name ) . '</strong></li>';
			} elseif ( is_day() ) {

				// Day archive.

				// Year link.
				$breadcrumb_html .= '<li class="item-year item-year-' . esc_html( get_the_time( 'Y' ) ) . '"><a class="bread-year bread-year-' . esc_html( get_the_time( 'Y' ) ) . '" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_html( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' Archives</a></li>';
				$breadcrumb_html .= '<li class="separator separator-' . esc_html( get_the_time( 'Y' ) ) . '"> ' . esc_html( $separator ) . ' </li>';

				// Month link.
				$breadcrumb_html .= '<li class="item-month item-month-' . esc_html( get_the_time( 'm' ) ) . '"><a class="bread-month bread-month-' . esc_html( get_the_time( 'm' ) ) . '" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '" title="' . esc_html( get_the_time( 'M' ) ) . '">' . esc_html( get_the_time( 'M' ) ) . ' Archives</a></li>';
				$breadcrumb_html .= '<li class="separator separator-' . esc_html( get_the_time( 'm' ) ) . '"> ' . esc_html( $separator ) . ' </li>';

				// Day display.
				$breadcrumb_html .= '<li class="item-current item-' . esc_html( get_the_time( 'j' ) ) . '"><strong class="bread-current bread-' . esc_html( get_the_time( 'j' ) ) . '"> ' . esc_html( get_the_time( 'jS' ) ) . ' ' . esc_html( get_the_time( 'M' ) ) . ' Archives</strong></li>';
			} elseif ( is_month() ) {

				// Month Archive.

				// Year link.
				$breadcrumb_html .= '<li class="item-year item-year-' . esc_html( get_the_time( 'Y' ) ) . '"><a class="bread-year bread-year-' . esc_html( get_the_time( 'Y' ) ) . '" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '" title="' . esc_html( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' Archives</a></li>';
				$breadcrumb_html .= '<li class="separator separator-' . esc_html( get_the_time( 'Y' ) ) . '"> ' . esc_html( $separator ) . ' </li>';

				// Month display.
				$breadcrumb_html .= '<li class="item-month item-month-' . esc_html( get_the_time( 'm' ) ) . '"><strong class="bread-month bread-month-' . esc_html( get_the_time( 'm' ) ) . '" title="' . esc_html( get_the_time( 'M' ) ) . '">' . esc_html( get_the_time( 'M' ) ) . ' Archives</strong></li>';
			} elseif ( is_year() ) {

				// Display year archive.
				$breadcrumb_html .= '<li class="item-current item-current-' . esc_html( get_the_time( 'Y' ) ) . '"><strong class="bread-current bread-current-' . esc_html( get_the_time( 'Y' ) ) . '" title="' . esc_html( get_the_time( 'Y' ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . ' Archives</strong></li>';
			} elseif ( is_author() ) {

				// Auhor archive.

				// Get the author information.
				global $author;
				$userdata = get_userdata( $author );

				$breadcrumb_html .= '<li class="item-current item-current-' . esc_html( $userdata->user_nicename ) . '"><strong class="bread-current bread-current-' . esc_html( $userdata->user_nicename ) . '"  title="' . ( $userdata->display_name ) . '">' . esc_html( 'Author: ' . $userdata->display_name ) . '</strong></li>';
			} elseif ( get_query_var( 'paged' ) ) {

				// Paginated archives.
				$breadcrumb_html .= '<li class="item-current item-current-' . esc_html( get_query_var( 'paged' ) ) . '"><strong class="bread-current bread-current-' . esc_html( get_query_var( 'paged' ) ) . '" title="Page ' . esc_html( get_query_var( 'paged' ) ) . '">' . __( 'Page' ) . ' ' . esc_html( get_query_var( 'paged' ) ) . '</strong></li>';
			} elseif ( is_search() ) {

				// Search results page.
				$breadcrumb_html .= '<li class="item-current item-current-' . esc_html( get_search_query() ) . '"><strong class="bread-current bread-current-' . esc_html( get_search_query() ) . '" title="Search results for: ' . esc_html( get_search_query() ) . '">Search results for: ' . esc_html( get_search_query() ) . '</strong></li>';
			} elseif ( is_404() ) {

				// 404 page.
				$breadcrumb_html .= '<li>404</li>';
			}

			$breadcrumb_html .= '</ul></div></div>';
		}
		echo wp_kses_post( $breadcrumb_html );
	}

	/** Function content_template() */
	protected function content_template() {}
}
