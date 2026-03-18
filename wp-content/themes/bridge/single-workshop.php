<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <!-- Display Elementor Content First -->
    <?php
        // This ensures that the Elementor content (banner, etc.) is rendered first
        the_content(); 
    ?>
	<div class="post-container">
		<!-- Display Post Title Below the Elementor Content -->
		<h1><?php the_title(); ?></h1>

		<!-- Fetch Custom ACF Fields -->
		<?php 
			// Assuming ACF fields
			$image_url = get_field('picture_of_trainer'); // Replace 'image_field' with your actual ACF field name
			$quote = get_field('quote'); // Replace 'quote_field' with your actual ACF field name
			$course = get_field('course'); // Replace 'course_field' with your actual ACF field name
			$description = get_field('course_description'); // Replace 'description_field' with your actual ACF field name
			$dates = get_field('workshop_dates_and_time'); // Replace 'dates_field' with your actual ACF field name
			$pricing = get_field('pricing'); // Replace 'pricing_field' with your actual ACF field name
		?>


		<!-- Display Image -->
		<?php if ($image_url): ?>
			<h4> Trainer</h4><img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">
		<?php endif; ?>

		<?php  $trainer_id = get_field('trainer_name'); 
			
		if ( $trainer_id ) {
			$trainer_name = get_field('trainer_name', $trainer_id);?>
			<h4> Trainer Name</h4> <?php echo  esc_html($trainer_name);
		}?>

        <!-- Display Quote -->
		<?php if ($quote): ?>
			<h4>Quote</h4><?php echo esc_html($quote); ?>
		<?php endif; ?> 
		<!-- Display Course Title -->
		<?php if ($course): ?>
			<h4>Course</h4><?php echo esc_html($course); ?>
		<?php endif; ?>

		

		<!-- Display Description -->
		<?php if ($description): ?>
			<h4>Course description</h4><?php echo wp_kses_post($description); ?>
		<?php endif; ?>

		<!-- Display Dates (if multiple, format as comma-separated) -->
		<?php if ($dates): ?>
			<h4>Dates & Time</h4> <?php echo is_array($dates) ? implode(', ', array_map('esc_html', $dates)) : esc_html($dates); ?>>
		<?php endif; ?>

		<!-- Display Pricing -->
		<?php if ($pricing): ?>
			<h4>Price</h4> <?php echo esc_html($pricing); ?>
		<?php endif; ?>
	</div


<?php endwhile; endif; ?>

<?php get_footer(); ?>
