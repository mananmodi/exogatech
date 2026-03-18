<?php extract(bridge_qode_get_blog_single_params()); ?>
<?php get_header(); ?>
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

		<?php get_template_part('title'); ?>
		<?php get_template_part('slider'); ?>
		<?php if ($single_type == 'image-title-post') : //this post type is full width 
		?>
			<div class="full_width" <?php if ($background_color != "") {
										echo " style='background-color:" . $background_color . "'";
									} ?>>
				<?php if (isset($bridge_qode_options['overlapping_content']) && $bridge_qode_options['overlapping_content'] == 'yes') { ?>
					<div class="overlapping_content">
						<div class="overlapping_content_inner">
						<?php } ?>
						<div class="full_width_inner" <?php bridge_qode_inline_style($content_style_spacing); ?>>
						<?php else : // post type 
						?>
							<div class="container" <?php if ($background_color != "") {
														echo " style='background-color:" . $background_color . "'";
													} ?>>
								<?php if (isset($bridge_qode_options['overlapping_content']) && $bridge_qode_options['overlapping_content'] == 'yes') { ?>
									<div class="overlapping_content">
										<div class="overlapping_content_inner">
										<?php } ?>
										<div class="container_inner default_template_holder" <?php bridge_qode_inline_style($content_style_spacing); ?>>
										<?php endif; // post type end 
										?>
										<?php if (($sidebar == "default") || ($sidebar == "")) : ?>
											<div <?php bridge_qode_class_attribute(implode(' ', $single_class)) ?>>
												<?php
												get_template_part('templates/' . $single_loop, 'loop');
												?>
												<?php if ($single_grid == 'no'): ?>
													<div class="grid_section">
														<div class="section_inner">
														<?php endif; ?>
														<?php
														if ($blog_hide_comments != "yes") {
															comments_template('', true);
														} else {
															echo "<br/><br/>";
														}
														?>
														<?php if ($single_grid == 'no'): ?>
														</div>
													</div>
												<?php endif; ?>
											</div>

										<?php elseif ($sidebar == "1" || $sidebar == "2"): ?>
											<?php if ($sidebar == "1") : ?>
												<div class="two_columns_66_33 background_color_sidebar grid2 clearfix">
													<div class="column1">
													<?php elseif ($sidebar == "2") : ?>
														<div class="two_columns_75_25 background_color_sidebar grid2 clearfix">
															<div class="">
															<?php endif; ?>

															<div class="column_inner">
																<div <?php bridge_qode_class_attribute(implode(' ', $single_class)) ?>>
																	<?php
																	get_template_part('templates/' . $single_loop, 'loop');
																	?>
																</div>
																<h2 class="ass-title"><?php echo esc_html_e("Associated Workshops"); ?></h2>
																<?php

																$args = array(
																	'post_type' => 'product',
																	'posts_per_page' => -1
																);

																$trainermeta = array(
																	'key'     => 'trainer_name',
																	'value'   => $post->ID,
																	'compare' => '=',
																	'type'    => 'string',
																);

																$args['meta_query']   = array(
																	'relation' => 'AND',
																);
																$args['meta_query'][] = $trainermeta;

																$workshops = new \WP_Query($args);
																if ($workshops->have_posts()) :
																?>

																	<div class="workshops-listing"> <!-- Neutral wrapper class -->
																		<?php while ($workshops->have_posts()) : $workshops->the_post(); ?>
																			<div class="workshop-item"> <!-- Neutral item class -->

																				<!-- Featured Image -->
																				<?php if (has_post_thumbnail()) : ?>
																					<div class="workshops-feature-image">
																						<a href="<?php the_permalink(); ?>">
																							<img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php the_title_attribute(); ?>">
																						</a>
																						<?php
																						$dates = get_field('workshop_date', get_the_ID());
																						if ($dates) :
																						?>
																							<p class="workshops-dates">
																								<?php echo date('F j, Y', strtotime($dates)); ?>
																							</p>
																						<?php endif; ?>
																					</div>
																				<?php endif; ?>

																				<!-- Title -->
																				<h3 class="workshops-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

																				<!-- Excerpt -->
																				<div class="workshop-short-desc">
																					<p><?php echo wp_kses_post(get_the_excerpt()); ?></p>
																				</div>

																				<!-- Read More Button -->
																				<a href="<?php the_permalink(); ?>" class="workshops-btn"><?php echo __('Read More'); ?></a>

																			</div>
																		<?php endwhile;
																		wp_reset_postdata(); ?>
																	</div>


																<?php endif; ?>

															</div>
															</div>
															<div class="column2">
																<?php get_sidebar(); ?>
															</div>
														</div>
													<?php elseif ($sidebar == "3" || $sidebar == "4"): ?>
														<?php if ($sidebar == "3") : ?>
															<div class="two_columns_33_66 background_color_sidebar grid2 clearfix">
																<div class="column1">
																	<?php get_sidebar(); ?>
																</div>
																<div class="column2">
																<?php elseif ($sidebar == "4") : ?>
																	<div class="two_columns_25_75 background_color_sidebar grid2 clearfix">
																		<div class="column1">
																			<?php get_sidebar(); ?>
																		</div>
																		<div class="column2">
																		<?php endif; ?>

																		<div class="column_inner">
																			<div <?php bridge_qode_class_attribute(implode(' ', $single_class)) ?>>
																				<?php
																				get_template_part('templates/' . $single_loop, 'loop');
																				?>
																			</div>
																			<?php
																			if ($blog_hide_comments != "yes") {
																				comments_template('', true);
																			} else {
																				echo "<br/><br/>";
																			}
																			?>
																		</div>
																		</div>

																	</div>
																<?php endif; ?>
																</div>
																<?php if (isset($bridge_qode_options['overlapping_content']) && $bridge_qode_options['overlapping_content'] == 'yes') { ?>
															</div>
													</div>
												<?php } ?>
												</div>
											<?php endwhile; ?>
										<?php endif; ?>


										<?php get_footer(); ?>