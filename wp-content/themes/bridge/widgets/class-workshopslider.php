<?php

/**
 * FGI
 *
 * @package FGI
 * @version 1.0

 * File Name: Workshopslider Widget
 * Description: Workshopslider Widget
 * Author: We Are Star
 * Version: 1.0.0
 * Author URI: https://wearestar.com/
 */

/**
 * Workshopslider Widget
 *
 * @file Caribe Hilton
 * Workshopslider Widget
 */


namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module as QueryModule;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/** Class Workshopslider . */
class Workshopslider extends Widget_Base
{

    /** Function get_name() widget name.*/
    public function get_name()
    {
        return 'Workshopslider';
    }
    /** Function get_title() widget title. */
    public function get_title()
    {
        return esc_html__('Workshops slider', 'fgi');
    }
    /** Function get_icon() widget icon. */
    public function get_icon()
    {
        return 'acute-icon';
    }

    /** Function get_categories section. */
    public function get_categories()
    {
        return array('acute');
    }

    /** Function register_controls() input fields. */
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            array(
                'label' => 'Settings',
            )
        );

        $this->add_control(
            'section_title',
            array(
                'label'       => esc_html__('Section Title', 'fgi'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Section - Title', 'fgi'),
            )
        );

        $this->end_controls_section();
    }

    /** Function render() */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        //$settings['section_title']

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 10
        );

        $workshops = new \WP_Query($args);



        if ($workshops->have_posts()) :
?>

            <div class="workshops-slider">
                <?php if ($workshops->have_posts()) : ?>
                    <?php while ($workshops->have_posts()) : $workshops->the_post(); ?>
                        <div class="workshop-item">

                            <!-- Featured Image -->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="workshops-feature-image">

                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                </div>
                            <?php endif; ?>
                            <!-- Title -->
                            <h3 class="workshops-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                            <!-- Dates -->
                            <?php
                            $dates = get_field('workshop_date', get_the_ID());
                            if ($dates) :
                            ?>
                                <p class="workshops-dates">
                                    <?php echo date('F j, Y', strtotime($dates)); ?>
                                </p>
                            <?php endif; ?>




                            <!-- Excerpt -->
                            <div class="workshop-short-desc">
                                <p><?php echo wp_kses_post(get_the_excerpt()); ?></p>
                            </div>

                            <!-- Read More Button -->
                            <a href="<?php the_permalink(); ?>" class="workshops-btn"><?php echo __('Read More');?></a>

                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else: ?>
                    <p>No workshops found.</p>
                <?php endif; ?>
            </div>


<?php endif;
        wp_reset_postdata();
    }

    /** Function content_template() */
    protected function content_template() {}
}
