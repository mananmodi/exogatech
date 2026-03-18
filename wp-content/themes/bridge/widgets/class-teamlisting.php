<?php

/**
 * FGI
 *
 * @package FGI
 * @version 1.0

 * File Name: Teamlisting Widget
 * Description: Teamlisting Widget
 * Author: We Are Star
 * Version: 1.0.0
 * Author URI: https://wearestar.com/
 */

/**
 * Teamlisting Widget
 *
 * @file Caribe Hilton
 * Teamlisting Widget
 */


namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module as QueryModule;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/** Class Teamlisting . */
class Teamlisting extends Widget_Base
{

    /** Function get_name() widget name.*/
    public function get_name()
    {
        return 'Teamlisting';
    }
    /** Function get_title() widget title. */
    public function get_title()
    {
        return esc_html__('Team listing', 'fgi');
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

        $this->end_controls_section();
    }

    /** Function render() */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // 1️⃣ Query all trainers
        $trainer_args = array(
            'post_type'      => 'trainer',
            'posts_per_page' => -1,
        );

        $trainers = new \WP_Query($trainer_args);

        if ($trainers->have_posts()) :
?>             
          

            <div class="trainer-listing">
                <?php while ($trainers->have_posts()) : $trainers->the_post(); ?>

                    <?php
                    $trainer_id = get_the_ID();
                    $trainer_name  = get_the_title();


                    ?>

                    <!-- Trainer Slide -->
                    <div class="trainer-list">
                        <a href="<?php echo esc_url(get_permalink(get_the_ID())); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                            <div class="trainer-list-image">
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php the_title_attribute(); ?>">
                            </div>
                            <p class="trainer-name"><?php echo esc_html($trainer_name); ?></p>
                        </a>
                    </div>

                <?php endwhile; ?>
            </div>
<?php
        else :
            echo '<p>No trainers found.</p>';
        endif;

          wp_enqueue_script('teamlist', get_template_directory_uri() . '/js/workshoplisting.js', array('jquery', 'elementor-frontend'), '1.0', true);

       
    }

    /** Function content_template() */
    protected function content_template() {}
}
