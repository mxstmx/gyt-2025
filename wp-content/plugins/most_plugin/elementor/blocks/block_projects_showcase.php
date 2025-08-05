<?php

/**
 * @author: Mad Sparrow
 * @version: 1.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_MS_Projects extends Widget_Base {

	use \MS_Elementor\Traits\Helper;

	public function get_name() {
		return 'ms_projects';
	}

	public function get_title() {
		return esc_html__( 'Portfolio', 'madsparrow' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid ms-badge';
	}

	public function get_categories() {
		return [ 'ms-elements' ];
	}

	public function get_keywords() {
		return [ 'projects', 'works', 'grid', 'showcase', 'portfolio' ];
	}

	protected function register_controls() {

		$first_level = 0;

		// TAB CONTENT
		$this->start_controls_section(
			'section_' . $first_level++, [
				'label' => esc_html__( 'Portfolio', 'madsparrow' ),
			]
		);

        if ( get_template() !== 'most' ) {

            $this->add_control(
                'notification_' . $first_level++, [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<strong>' . esc_html__( 'Most Theme not activated!', 'madsparrow' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Themes</a> to activate.', 'madsparrow' ), admin_url( 'themes.php' ) ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
                    'separator' => 'after',
                ]
            );

        }

		$this->add_control(
			'layout_options', [
				'label' => __( 'Layout', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'protfolio_style', [
				'label' => esc_html__( 'Grid', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Grid', 'madsparrow' ),
					'grid_2' => esc_html__( 'Grid 2', 'madsparrow' ),
					'masonry' => esc_html__( 'Masonry', 'madsparrow' ),
					'list' => esc_html__( 'List', 'madsparrow' ),
					// 'carousel' => esc_html__( 'Carousel', 'madsparrow' ),
				],
			]
		);

		$this->add_control(
			'columns', [
				'label' => __( 'Columns', 'madsparrow' ),
				'description' => __( 'Min 1, Max 6', 'madsparrow' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'protfolio_style!' => ['grid_2', 'list'],
				],
			]
		);

		$this->add_control(
			'gutter', [
				'label' => __( 'Gutters', 'madsparrow' ),
				'description' => __( 'Gutters are the padding between your columns, used to responsively space and align content in the Bootstrap grid system.', 'madsparrow' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem', '%', 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 90,
						'step' => 1,
					],
					'rem' => [
						'min' => 0,
						'max' => 8,
						'step' => 0.1,
					],
					'%' => [
						'min' => 0,
						'max' => 15,
					],
					'vh' => [
						'min' => 0,
						'max' => 30,
					],
				],
				'default' => [
					'unit' => 'rem',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} .row' => 'margin-top: calc( {{SIZE}}{{UNIT}} * -1 );margin-right: calc( {{SIZE}}{{UNIT}}/ -2 );margin-left: calc( {{SIZE}}{{UNIT}}/ -2 );',
					'{{WRAPPER}} .grid-item-p' => 'padding-right: calc({{SIZE}}{{UNIT}}/ 2);padding-left: calc({{SIZE}}{{UNIT}}/ 2);margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'protfolio_style!' => ['masonry_2', 'list'],
				],
			]
		);

		$this->add_control(
			'order_opt', [
				'label' => __( 'Order', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_by', [
				'label' => esc_html__( 'Show By', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'show_all',
				'options' => [
					'show_all' => esc_html__( 'Show All', 'madsparrow' ),
					'show_by_id' => esc_html__( 'Show By ID', 'madsparrow' ),
					'show_by_cat' => esc_html__( 'Show By Category', 'madsparrow' ),
				],
			]
		);

		$this->add_control(
			'post_id', [
				'label' => esc_html__( 'Select Post', 'madsparrow' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->ms_get_post_name( 'portfolios' ),
				'condition' => [
					'show_by' => 'show_by_id',
				],
			]
		);

		$this->add_control(
			'post_cat', [
				'label' => esc_html__( 'Select Category', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'multiple' => true,
				'options' => $this->ms_get_p_taxonomies( 'portfolios_categories' ),
				'condition' => [
					'show_by' => 'show_by_cat',
				],
			]
		);

		$this->add_control(
			'posts_opt', [
				'label' => __( 'Posts per page', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'max_posts', [
				'label' => esc_html__( 'Show at most', 'madsparrow' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 9,
			]
		);

		$this->add_control(
			'pagination_opt', [
				'label' => __( 'Pagination', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

		$this->add_control(
			'show_pagination', [
				'label' => esc_html__( 'Show', 'madsparrow' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

		$this->add_control(
			'text_pagination', [
				'label' => esc_html__( 'Title', 'madsparrow' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Load More', 'madsparrow' ),
				'placeholder' => esc_html__( 'Type your title here', 'madsparrow' ),
				'condition' => [
					'show_pagination' => 'yes',
				],
			]
		);

		$this->add_control(
			'pag_align', [
				'label' => __( 'Alignment', 'madsparrow' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'madsparrow' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'madsparrow' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'madsparrow' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'condition' => [
					'show_pagination' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio_wrap .ajax-area' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .portfolio_wrap .ajax-area--list' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'filter_opt', [
				'label' => __( 'Filtering', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

		$this->add_control(
			'show_filter', [
				'label' => esc_html__( 'Show', 'madsparrow' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

		$this->add_control(
			'filter_text', [
				'label' => esc_html__( 'Title', 'madsparrow' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your title', 'madsparrow' ),
				'default' => 'All Categories',
				'condition' => [
					'show_filter' => 'yes',
				],
			]
		);

		$this->add_control(
			'filter_align', [
				'label' => __( 'Alignment', 'madsparrow' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start;' => [
						'title' => __( 'Left', 'madsparrow' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'madsparrow' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'madsparrow' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'flex-start',
				'toggle' => true,
				'condition' => [
					'show_filter' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio_wrap .subnav' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// TAB CONTENT
		$this->start_controls_section(
			'section_' . $first_level++, [
				'label' => esc_html__( 'Style', 'madsparrow' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'protfolio_style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'carousel_border_radius', [
				'label' => __( 'Border Radius', 'madsparrow' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'pt' ],
				'selectors' => [
					'{{WRAPPER}} .ms-carousel-showcase .ms-p-img img' => 'border-top-left-radius: {{TOP}}{{UNIT}} {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}} {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}} {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}} {{LEFT}}{{UNIT}};', 
				],
				'condition' => [
					'protfolio_style' => 'carousel',
				],
			]
		);

		
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'carousel_title_typography',
				'label' => __( 'Typography', 'madsparrow' ),
				'selector' => '{{WRAPPER}} .ms-carousel-showcase .ms-p-content h1',
				'condition' => [
					'protfolio_style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'carousel_title_color', [
				'label' => __( 'Title', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .ms-carousel-showcase .ms-p-content h1' => 'color: {{VALUE}}'
				],
				'condition' => [
					'protfolio_style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'carousel_bullet_color', [
				'label' => __( 'Bullet', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'var(--color-primary)',
				'selectors' => [
					'{{WRAPPER}} .ms-carousel-showcase .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}'
				],
				'condition' => [
					'protfolio_style' => 'carousel',
				],
			]
		);

		$this->add_control(
			'carousel_bg_color', [
				'label' => __( 'Background', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1E2125',
				'selectors' => [
					'{{WRAPPER}} .ms-carousel-showcase' => 'background-color: {{VALUE}}'
				],
				'condition' => [
					'protfolio_style' => 'carousel',
				],
			]
		);

		$this->end_controls_section();

		// TAB CONTENT
 		$this->start_controls_section(
			'section_' . $first_level++, [
				'label' => esc_html__( 'Thumbnail', 'madsparrow' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'protfolio_style!' => ['list', 'carousel'],
				],
			]
		);

		$this->add_control(
			'thumb_options', [
				'label' => __( 'Thumbnail', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'protfolio_style!' => [ 'grid_2', 'masonry', 'carousel' ],
				],
			]
		);

		$this->add_control(
			'thumb_ratio', [
				'label' => __( 'Ratio', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'default' => '16:9',
				'options' => [
					'1:1' => esc_html__( '1:1', 'madsparrow' ),
					'4:3' => esc_html__( '4:3', 'madsparrow' ),
					'3:4' => esc_html__( '3:4', 'madsparrow' ),
					'16:9' => esc_html__( '16:9', 'madsparrow' ),
					'21:9' => esc_html__( '21:9', 'madsparrow' ),
				],
				'condition' => [
					'protfolio_style!' => [ 'grid_2', 'masonry', 'carousel' ],
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name' => 'border',
				'label' => __( 'Border', 'madsparrow' ),
				'selector' => '{{WRAPPER}} .item--inner figure',
			]
		);

		$this->add_control(
			'border_radius', [
				'label' => __( 'Radius', 'madsparrow' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'pt' ],
				'selectors' => [
					'{{WRAPPER}} .item--inner figure' => 'border-top-left-radius: {{TOP}}{{UNIT}} {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}} {{RIGHT}}{{UNIT}}; border-bottom-right-radius: {{BOTTOM}}{{UNIT}} {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}} {{LEFT}}{{UNIT}};', 
				],
			]
		);

		$this->add_control(
			'h_effect', [
				'label' => __( 'Image Hover Effect', 'madsparrow' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'hover_effect', [
				'label' => __( 'Style', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => esc_html__( 'None', 'madsparrow' ),
					'zoom' => esc_html__( 'Zoom In', 'madsparrow' ),
					'zoomout' => esc_html__( 'Zoom Out', 'madsparrow' ),
					'flash' => esc_html__( 'Flash', 'madsparrow' ),
				],
			]
		);

		$this->end_controls_section();

		// TAB CONTENT
 		$this->start_controls_section(
			'section_' . $first_level++, [
				'label' => esc_html__( 'Text', 'madsparrow' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'protfolio_style!' => ['carousel'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'title_typography',
				'label' => __( 'Typography Title', 'madsparrow' ),
				'selector' => '{{WRAPPER}} .portfolio_wrap .portfolio-feed .ms-p-content h3',
				'size_units' => [ 'px', '%', 'em', 'vh', 'vw' ],
				'condition' => [
					'protfolio_style!' => ['list', 'carousel'],
				],
			]
		);

		$this->add_control(
			'title_color', [
				'label' => __( 'Title Text Color', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ms-p-content h3' => 'color: {{VALUE}}',
					'{{WRAPPER}} .portfolio-feed.ms-p--l .ms-p-list__item a .p-list-item__title h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'show_cat', [
				'label' => esc_html__( 'Category', 'madsparrow' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before',
				'condition' => [
					'protfolio_style!' => ['list', 'carousel'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'cat_typography',
				'label' => __( 'Typography Category', 'madsparrow' ),
				'selector' => '{{WRAPPER}} .ms-p-content .ms-p-cat',
				'condition' => [
					'show_cat' => 'yes',
					'protfolio_style!' => ['list', 'carousel'],
				],
			]
		);

		$this->add_control(
			'category_color', [
				'label' => __( 'Category Text Color', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio_wrap .portfolio-feed .item--inner .ms-p-content .ms-p-cat' => 'color: {{VALUE}}',
					'{{WRAPPER}} .portfolio-feed.ms-p--l .ms-p-list__item a .p-list-item__info h4' => 'color: {{VALUE}}'
				],
			]
		);

		$this->add_control(
			'text_style', [
				'label' => __( 'Style', 'madsparrow' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'below',
				'options' => [
					'above' => esc_html__( 'Above', 'madsparrow' ),
					'below' => esc_html__( 'Below', 'madsparrow' ),
					'overlay' => esc_html__( 'Overlay', 'madsparrow' ),
					'boxed' => esc_html__( 'Boxed', 'madsparrow' ),
					'fadein' => esc_html__( 'FadeIn', 'madsparrow' ),
				],
				'separator' => 'before',
				'condition' => [
					'protfolio_style!' => ['list', 'carousel'],
				],
			]
		);

		$this->add_control(
			'overlay_color', [
				'label' => __( 'Color Overlay', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,.4)',
				'selectors' => [
					'{{WRAPPER}} .overlay .item--inner figure::after' => 'background-color: {{VALUE}}', '{{WRAPPER}} .fadein .item--inner figure::after' => 'background-color: {{VALUE}}'
				],
				'condition' => [
					'text_style' => ['overlay', 'fadein'],
				],
			]
		);

		$this->add_control(
			'boxed_bg', [
				'label' => __( 'Box Color', 'madsparrow' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .boxed .ms-p-content' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'text_style' => 'boxed',
				],
			]
		);

		$this->add_control(
			'cont_align', [
				'label' => __( 'Content Alignment', 'madsparrow' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'h-align-top' => [
						'title' => __( 'Top', 'madsparrow' ),
						'icon' => 'eicon-v-align-top',
					],
					'h-align-middle' => [
						'title' => __( 'Middle', 'madsparrow' ),
						'icon' => 'eicon-v-align-middle',
					],
					'h-align-bottom' => [
						'title' => __( 'Bottom', 'madsparrow' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'h-align-top',
				'toggle' => true,
				'condition' => [
					'text_style' => ['overlay', 'fadein'],
				],
			]
		);

		$this->add_control(
			'text_align', [
				'label' => __( 'Text Alignment', 'madsparrow' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'madsparrow' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'madsparrow' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'madsparrow' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ms-p-content' => 'text-align: {{VALUE}}',
				],
				'default' => 'left',
				'toggle' => true,
				'condition' => [
					'protfolio_style!' => ['list', 'carousel'],
				],
			]
		);

		$this->add_responsive_control(
			'padding_content', [
				'label' => esc_html__( 'Padding', 'madsparrow' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ms-p-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'protfolio_style!' => ['list', 'carousel'],
				],
			]
		);

		$this->end_controls_section();

	}


	protected function render() {

		$settings = $this->get_settings_for_display();
		
		$paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
		$items = $settings[ 'max_posts' ];
		$thumb_ratio = ' media-wrapper media-wrapper--' . $settings[ 'thumb_ratio' ];
		$item_inner = 'item--inner';
		$p_item_class = $settings[ 'text_style' ];
		$p_item_class .= ' ' . $settings[ 'hover_effect' ];
		$p_item_class .= ' ' . ($settings['text_align'] ?? 'default-align');
		$p_item_class .= ' ' . $settings[ 'cont_align' ];
		$p_item_class .= ' grid-item-p';
		$btntext = $settings['text_pagination'];

		if ( $settings[ 'columns' ] ) {
			$col_numb = '12' / $settings[ 'columns' ];
		}
		
		// Portfolio Style
		switch ( $settings[ 'protfolio_style' ] ) {
			case 'default':
				$layout = ' ms-p--d row';
				$col = ' col-md-' . $col_numb;
			break;

			case 'grid_2':
				$layout = ' ms-p--g2 row';
				$col = null;
				$i = 0;
				$thumb_ratio = ' media-wrapper media-wrapper--4:3';
			break;

			case 'masonry':
				$layout = ' ms-p--m grid-content';
				$col = ' col-md-' . $col_numb;
				$thumb_ratio = null;
			break;

			case 'list':
				$layout = ' ms-p--l';
				$thumb_ratio = null;
			break;

		}

		// Order
		switch ( $settings[ 'show_by' ] ) {
			case 'show_all':
				$post_id = null;
				$terms = get_terms('portfolios_categories');
				$cat = most_filter_category();
				$p_query = most_portfolio_loop($cat, $items, $post_id);
				$terms = get_terms('portfolios_categories');
				most_infinity_load( $p_query );
				// if (sizeof($terms) >= 2) {
                if ( count((array) $terms) >= 2 ) {
					$show_filter = 'on';
				} else {
					$show_filter = null;
				}
			break;

			case 'show_by_id':
				$cat_id = $settings[ 'post_id' ];
				$fargs = array(
					'post_type' => 'portfolios',
					'posts_per_page' => '-1',
					'post__in' => $settings[ 'post_id' ],
					'post_status' => 'publish',
				);

				$f_query = new \WP_Query( $fargs );

				if ( $f_query->have_posts() ) :
					$show_cat = array();
					while ( $f_query->have_posts() ) : $f_query->the_post();
						$album_cat = most_work_category(get_the_ID());
						$string = str_replace('-', ' ', $album_cat); 
						$album_cat = esc_html($string); 
						$show_cat[] = $album_cat;
					endwhile;
				endif;

				if (!empty($show_cat)) {
					$terms = array_unique( $show_cat );
					if (count((array)($terms)) > 0) {
						$show_filter = 'on';
					}
				} else {
					$terms = '';
				}

				$post_id = $cat_id;
				$cat = most_filter_category();
				$p_query = most_portfolio_loop($cat, $items, $post_id);
				most_infinity_load( $p_query );
				// PHP 8.0
				// if (sizeof($terms) > 1) { 
                if ( count((array) $terms) > 1 ) {
					$show_filter = 'on';
				}

			break;

			case 'show_by_cat':
				$get_posts_categories = $settings[ 'post_cat' ];
				$terms = $get_posts_categories;
				$cat = $get_posts_categories;
				$post_id = null;
				$p_query = most_portfolio_loop($cat, $items, $post_id);
				most_infinity_load( $p_query );
				echo the_category();
				$show_filter = 'off';
			break;
		} ?>

		<div class="portfolio_wrap" id="<?php echo $this->get_id(); ?>">

			<?php if ($settings['protfolio_style'] !== 'list' && $settings['protfolio_style'] !== 'carousel') :?>
				<?php $load_btn = '';?>
				<?php if ( $settings['show_filter'] == 'yes') :
					if ( $show_filter == 'on') :
						if ( $terms && !is_wp_error( $terms ) ): ?>
							<div class="subnav">
								<div class="subnav__container">
									<div class="filter-nav filter-nav--expanded js-filter-nav">
									<button class="reset btn--subtle is-hidden js-filter-nav__control" aria-label="<?php esc_attr_e('Select a filter option', 'most'); ?>" aria-controls="filter-nav">
										<span class="js-filter-nav__placeholder" aria-hidden="true"><?php esc_html_e('All', 'most'); ?></span>
										<svg class="icon icon--xxs margin-left-xxs" aria-hidden="true" viewBox="0 0 12 12"><polyline points="0.5 3.5 6 9.5 11.5 3.5" fill="none" stroke-width="1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></polyline></svg>
									</button>
									<div class="filter-nav__wrapper js-filter-nav__wrapper" id="filter-nav">
									<nav class="filter-nav__nav js-filter-nav__nav">
										<ul class="filtr-btn filter-nav__list js-filter-nav__list">
											<li class="filter-nav__item subnav__link active" data-filter="">
												<button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" aria-current="true" ><?php echo $settings[ 'filter_text' ] ?></button>
											</li>
											<?php foreach ( $terms as $term ) { ?>
												<?php if ( $settings[ 'show_by' ] == 'show_by_id' || $settings[ 'show_by' ] == 'show_by_cat') : ?>
													<li class="filter-nav__item subnav__link" data-filter="<?php echo esc_attr($term); ?>">
														<button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" ><?php echo esc_html($term); ?></button>
													</li>
												<?php else: ?>
													<li class="filter-nav__item subnav__link" data-filter="<?php echo esc_attr($term->slug); ?>">
														<button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" ><?php echo esc_html($term->name); ?></button>
													</li>
												<?php endif; ?>
											<?php } ?>
											<li class="filter-nav__marker js-filter-nav__marker" aria-hidden="true"></li>
										</ul>
									<button class="reset filter-nav__close-btn is-hidden js-filter-nav__close-btn js-tab-focus" aria-label="Close navigation">
										<svg class="icon" viewBox="0 0 14 14" aria-hidden="true"><g stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"><line x1="13.5" y1="2.5" x2="2.5" y2="13.5"></line><line x1="2.5" y1="2.5" x2="13.5" y2="13.5"></line></g></svg>
									</button>
									</nav>
								</div>
									</div>
								</div>
							</div>
						<?php endif;?>
					<?php endif;?>
				<?php endif;?>

				<div class="portfolio-feed<?php echo $layout; ?>">
					<span class="load_filter">
						<svg class="load-filter-icon" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
							<circle cx="50" cy="50" r="30" stroke-width="6" stroke-linecap="round" fill="none">
								<animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1"></animateTransform>
								<animate attributeName="stroke-dasharray" repeatCount="indefinite" dur="1s" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1"></animate>
							</circle>
						</svg>
					</span>

					<?php if ( $settings[ 'protfolio_style' ] === 'masonry' ) : ?>
						<div class="row ms-masonry-gallery">
					<?php endif; ?>

					<div class="grid-sizer<?php echo $col?>"></div>
					<?php if ( $p_query->have_posts() ) : while ( $p_query->have_posts() ) : $p_query->the_post();
						$string = str_replace('-', ' ', most_work_category(get_the_ID())); 
						$album_cat = esc_html($string); 
						$show_cat[] = $album_cat;

						if ( $settings[ 'protfolio_style' ] == 'grid_2' ) {
							if( $i%3 == 0 ) {
								$col = ' col-md-8';
							} else {
								$col = ' col-md-4';
							}
							if( $i == 3 ) {	$i = 0; } else { ++$i; }
						} ?>
						
						<div <?php post_class( $p_item_class . $col ); ?>>

							<div class="<?php echo most_sanitize_class( $item_inner ); ?>">

								<a href="<?php echo esc_url(the_permalink()); ?>" aria-label="<?php the_title_attribute(); ?>">
									<?php if( has_post_thumbnail() ):?>
										<figure class="ms-p-img<?php echo $thumb_ratio; ?>">
											<img src="<?php the_post_thumbnail_url($size = 'most-portfolio-thumb'); ?>" alt="<?php the_title_attribute(); ?>">
										</figure>
									<?php endif; ?>

									<div class="ms-p-content">
										<h3><?php the_title(); ?></h3>
										<?php if ( $settings['show_cat'] === 'yes' ) : ?>
											<h4 class="ms-p-cat"><?php echo esc_html($album_cat); ?></h4>
										<?php endif; ?>
									</div>
								</a>

							</div>

						</div>
					<?php endwhile; endif; wp_reset_postdata(); wp_reset_query(); ?>

					<?php if ( $settings[ 'protfolio_style' ] === 'masonry' ) : ?>
						</div>
					<?php endif; ?>

				</div>

				<?php if ( $settings[ 'show_pagination' ] == 'yes' ) : ?>
					<?php if ( $p_query->max_num_pages > 1 ) : ?>
						<?php echo most_portfolio_pagination($p_query->max_num_pages, $btntext, $load_btn); ?>
					<?php endif; ?>
				<?php endif; ?>

			<?php endif; ?>
			
			<?php if ($settings['protfolio_style'] == 'list') :?>

				<?php $load_btn = '--list';?>

				<?php if ( $settings['show_filter'] == 'yes') :
					if ( $show_filter == 'on') :
						if ( $terms && !is_wp_error( $terms ) ): ?>
							<div class="subnav">
								<div class="subnav__container">
									<div class="filter-nav filter-nav--expanded js-filter-nav">
										<button class="reset btn--subtle is-hidden js-filter-nav__control" aria-label="<?php esc_attr_e('Select a filter option', 'most'); ?>" aria-controls="filter-nav">
											<span class="js-filter-nav__placeholder" aria-hidden="true"><?php esc_html_e('All', 'most'); ?></span>
											<svg class="icon icon--xxs margin-left-xxs" aria-hidden="true" viewBox="0 0 12 12"><polyline points="0.5 3.5 6 9.5 11.5 3.5" fill="none" stroke-width="1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></polyline></svg>
										</button>
										<div class="filter-nav__wrapper js-filter-nav__wrapper" id="filter-nav">
											<nav class="filter-nav__nav js-filter-nav__nav">
												<ul class="filtr-btn filter-nav__list js-filter-nav__list">
													<li class="filter-nav__item subnav__link active" data-filter="">
														<button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" aria-current="true" ><?php echo $settings[ 'filter_text' ] ?></button>
													</li>
													<?php foreach ( $terms as $term ) { ?>
														<?php if ( $settings[ 'show_by' ] == 'show_by_id' || $settings[ 'show_by' ] == 'show_by_cat') : ?>
															<li class="filter-nav__item subnav__link" data-filter="<?php echo esc_attr($term); ?>">
																<button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" ><?php echo esc_html($term); ?></button>
															</li>
														<?php else: ?>
															<li class="filter-nav__item subnav__link" data-filter="<?php echo esc_attr($term->slug); ?>">
																<button class="reset filter-nav__btn js-filter-nav__btn js-tab-focus" ><?php echo esc_html($term->name); ?></button>
															</li>
														<?php endif; ?>
													<?php } ?>
													<li class="filter-nav__marker js-filter-nav__marker" aria-hidden="true"></li>
												</ul>
												<button class="reset filter-nav__close-btn is-hidden js-filter-nav__close-btn js-tab-focus" aria-label="Close navigation">
													<svg class="icon" viewBox="0 0 14 14" aria-hidden="true"><g stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"><line x1="13.5" y1="2.5" x2="2.5" y2="13.5"></line><line x1="2.5" y1="2.5" x2="13.5" y2="13.5"></line></g></svg>
												</button>
											</nav>
										</div>
									</div>
								</div>
							</div>
						<?php endif;?>
					<?php endif;?>
				<?php endif;?>

				<div class="portfolio-feed<?php echo $layout; ?>">
					<span class="load_filter">
						<svg class="load-filter-icon" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
							<circle cx="50" cy="50" r="30" stroke-width="6" stroke-linecap="round" fill="none">
								<animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1"></animateTransform>
								<animate attributeName="stroke-dasharray" repeatCount="indefinite" dur="1s" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1"></animate>
							</circle>
						</svg>
					</span>
					<div class="grid-item-p__list row">
						<ul class="ms-p-list">
							
							<?php if ( $p_query->have_posts() ) : while ( $p_query->have_posts() ) : $p_query->the_post();
								$string = str_replace('-', ' ', most_work_category(get_the_ID())); 
								$album_cat = esc_html($string); 
								$show_cat[] = $album_cat;
							?>
							
							<?php $string = str_replace('-', ' ', most_work_category(get_the_ID()));?>
								<li class="ms-p-list__item" id="<?php the_id(); ?>">

									<a href="<?php echo esc_url(the_permalink()); ?>" aria-label="<?php the_title_attribute(); ?>">

										<?php if( has_post_thumbnail() ):?>
											<div class="ms-p-list-item__img-container">
												<figure class="project-list-item__image">
													<img class="project-list-item__image" src="<?php the_post_thumbnail_url($size = 'most-list-post-thumb'); ?>" alt="<?php the_title_attribute(); ?>">
												</figure>
											</div>
										<?php endif; ?>
										
										<div class="p-list-item__title col-md-6">
											<h3><?php the_title(); ?></h3>
										</div>

										<div class="p-list-item__info col-md-3">

											<div class="p-list-item__cat">
												<h4><?php echo esc_html($album_cat); ?></h4>
											</div>
											<span><h4>/<?php echo get_the_date('Y'); ?></h4></span>

										</div>

										<div class="p-list-item__icon">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384.67 384.67">
												<g>
													<path fill-rule="evenodd" d="M0 45.26l276.05 276.05H22.63v63.36h362.04V22.63h-63.36v253.42L45.26 0 0 45.26z"></path>
												</g>
											</svg>
										</div>
									</a>

								</li>
							<?php endwhile; endif; wp_reset_postdata(); wp_reset_query(); ?>
						</ul>
					</div>
				</div>

				<?php if ( $settings[ 'show_pagination' ] == 'yes' ) : ?>
					<?php if ( $p_query->max_num_pages > 1 ) : ?>
						<?php echo most_portfolio_pagination($p_query->max_num_pages, $btntext, $load_btn); ?>
					<?php endif; ?>
				<?php endif; ?>

			<?php endif;?>

		</div>

		<?php if ( Plugin::$instance->editor->is_edit_mode() ) : ?>
			<script>			
				var grid = jQuery('.ms-masonry-gallery');
				grid.isotope();
				grid.imagesLoaded().progress( function() {
					grid.isotope('layout');
				});
			</script>
		<?php endif;	
	}

}