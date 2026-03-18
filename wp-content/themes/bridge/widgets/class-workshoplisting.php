<?php

/**
 * FGI
 *
 * @package FGI
 * @version 1.0

 * File Name: workshoplisting Widget
 * Description: workshoplisting Widget
 * Author: We Are Star
 * Version: 1.0.0
 * Author URI: https://wearestar.com/
 */

/**
 * workshoplisting Widget
 *
 * @file Caribe Hilton
 * workshoplisting Widget
 */


namespace WPC\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use ElementorPro\Modules\QueryControl\Module as QueryModule;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/** Class workshoplisting . */
class Workshoplisting extends Widget_Base
{

    /** Function get_name() widget name.*/
    public function get_name()
    {
        return 'Workshoplist';
    }
    /** Function get_title() widget title. */
    public function get_title()
    {
        return esc_html__('Workshops list', 'fgi');
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



        $catterms = get_terms(array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
        ));

        if (!empty($catterms)):
?>
            <div class="category-section">
                <span><?php echo esc_html_e('Categories:'); ?></span>
                <div class="dropdown">
                    <select id="workshop-category" class="workshop_category">
                        <option value="" disabled selected><?php echo esc_html_e('Choose a category'); ?></option>
                        <?php
                        foreach ($catterms as $catterm):
                        ?>
                            <option value="<?php echo esc_attr($catterm->term_id); ?>"><?php echo esc_html($catterm->name); ?></option>
                        <?php

                        endforeach;
                        ?>
                    </select>
                </div>
            </div>

        <?php
        endif;

        ?>

        <div class="workshops-listing cvf_universal_container"> <!-- Neutral wrapper class -->
        </div>
        <div class="loader"></div>
        <input type="hidden" name="current_site_url" id="current_site_url" value="<?php the_permalink(); ?>" />


<?php
        wp_enqueue_script('workshoplist', get_template_directory_uri() . '/js/workshoplisting.js', array('jquery', 'elementor-frontend'), '1.0', true);
    }

    /** Function content_template() */
    protected function content_template() {}
}
