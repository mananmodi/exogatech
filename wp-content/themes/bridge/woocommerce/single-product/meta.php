<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( ProductType::VARIABLE ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>
    
    <?php
$dates = get_field('workshop_date', get_the_ID());
if ($dates) :
?>
	<p class="workshops-dates">
		<strong><?php echo __('WorkShop Date'); ?>:</strong> <?php echo date('F j, Y', strtotime($dates)); ?>
	</p>
<?php endif; ?>
<?php
$start_time = get_field('start_time', get_the_ID());
$end_time = get_field('end_time', get_the_ID());?>
<?php if (!empty($start_time) && !empty($end_time)) : ?>
	<p class="workshops-dates">
		<strong><?php echo __('Time', 'textdomain'); ?>:</strong>
		<?php echo esc_html($start_time); ?> - <?php echo esc_html($end_time); ?>
	</p>
<?php endif; ?>

<?php
$trainer_name = get_field('trainer_name', get_the_ID());
if (!empty($trainer_name)) :
?>
	<div class="workshops-dates workshops-trainer">
		<div class="trainer-n">
			<strong><?php echo __('Trainer', 'textdomain'); ?>:</strong>
			<a href="<?php echo esc_url(get_permalink($trainer_name->ID)); ?>" title="<?php echo esc_attr($trainer_name->post_title); ?>">
				<?php echo esc_html($trainer_name->post_title); ?>
			</a>
		</div>
		<div class="w-trainer-img">
			<a href="<?php echo esc_url(get_permalink($trainer_name->ID)); ?>">
				<img src="<?php echo esc_url(get_the_post_thumbnail_url($trainer_name->ID, 'full')); ?>" alt="<?php echo esc_attr($trainer_name->post_title); ?>" />
			</a>
		</div>
	</div>
<?php endif; ?>

<?php 
$booknow_url = get_field('book_now_url', get_the_ID());
if ($booknow_url) : ?>
	<a href="<?php echo esc_url($booknow_url); ?>" class="book-btn"><?php echo esc_html_e('Book Now'); ?> </a>
<?php endif; ?>



</div>
