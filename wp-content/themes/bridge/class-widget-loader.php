<?php
/**
 * FGI
 *
 * @package FGI
 * @version 1.0

 * File Name: Widget_Loader
 * Description: Widget_Loader
 * Author: We Are Star
 * Version: 1.0.0
 * Author URI: https://wearestar.com/
 */

/**
 * Widget_Loader
 *
 * @file Caribe Hilton
 * Widget_Loader
 */

namespace WPC;

/** Class Widget_Loader . */
class Widget_Loader {




	/**
	 * Instance.
	 *
	 * @var static
	 */
	private static $instance = null;
	/** Function instance() widget name. */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/** Function include_widgets_files() widget name. */
	private function include_widgets_files() {
		require_once __DIR__ . '/widgets/class-workshopslider.php';
		require_once __DIR__ . '/widgets/class-teamslider.php';
		require_once __DIR__ . '/widgets/class-workshoplisting.php';
		require_once __DIR__ . '/widgets/class-breadcrumb.php';
		require_once __DIR__ . '/widgets/class-teamlisting.php';
		
		
	
		
	}


	/** Function register_widgets() widget name. */
	public function register_widgets() {
		$this->include_widgets_files();
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Workshopslider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Teamslider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Workshoplisting() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Teamlisting() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Breadcrumb() );
	
		
	}

	/** Function widget_scripts() widget name. */
	public function widget_scripts() {}

	/** Function __construct() widget name. */
	public function __construct() {
		add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_categories' ), 1 );
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'widget_scripts' ) );
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ), 1 );
	}

	/** Function add_elementor_widget_categories($elements_manager)
	 *
	 * @param string $elements_manager elements_manager.
	 */
	public function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'acute',
			array(
				'title' => esc_html__( 'ACUTE', 'acute' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}
}

Widget_Loader::instance();
