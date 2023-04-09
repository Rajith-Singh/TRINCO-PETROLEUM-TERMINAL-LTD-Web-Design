<?php
/**
 * Header Builder Options
 *
 * @package Kadence
 */

namespace Kadence;

use Kadence\Theme_Customizer;
use function Kadence\kadence;

ob_start(); ?>
<div class="kadence-compontent-tabs nav-tab-wrapper wp-clearfix">
	<a href="#" class="nav-tab kadence-general-tab kadence-compontent-tabs-button nav-tab-active" data-tab="general">
		<span><?php esc_html_e( 'General', 'kadence' ); ?></span>
	</a>
	<a href="#" class="nav-tab kadence-design-tab kadence-compontent-tabs-button" data-tab="design">
		<span><?php esc_html_e( 'Design', 'kadence' ); ?></span>
	</a>
</div>
<?php
$compontent_tabs = ob_get_clean();
$settings = array(
	'logo_settings' => array(
		'control_type' => 'kadence_blank_control',
		'section'      => 'title_tagline',
		'settings'     => false,
		'priority'     => 1,
		'description'  => $compontent_tabs,
	),
	'logo_width' => array(
		'control_type' => 'kadence_range_control',
		'section'      => 'title_tagline',
		'priority'     => 5,
		'label'        => esc_html__( 'Logo Max Width', 'kadence' ),
		'description'  => esc_html__( 'Define the maxium width for the logo', 'kadence' ),
		'context'      => array(
			array(
				'setting' => '__current_tab',
				'value'   => 'general',
			),
			array(
				'setting'  => 'custom_logo',
				'operator' => '!empty',
				'value'    => '',
			),
		),
		'live_method'     => array(
			array(
				'type'     => 'css',
				'selector' => '#masthead .custom-logo',
				'property' => 'max-width',
				'pattern'  => '$',
				'key'      => 'size',
			),
		),
		'default'      => kadence()->default( 'logo_width' ),
		'input_attrs'  => array(
			'min'     => array(
				'px'  => 10,
				'em'  => 1,
				'rem' => 1,
				'vw'  => 2,
				'%'   => 2,
			),
			'max'     => array(
				'px'  => 800,
				'em'  => 12,
				'rem' => 12,
				'vw'  => 80,
				'%'   => 80,
			),
			'step'    => array(
				'px'  => 1,
				'em'  => 0.01,
				'rem' => 0.01,
				'vw'  => 1,
				'%'   => 1,
			),
			'units'   => array( 'px', 'em', 'rem', 'vw', '%' ),
		),
	),
	'use_mobile_logo' => array(
		'control_type' => 'kadence_switch_control',
		'section'      => 'title_tagline',
		'transport'    => 'refresh',
		'priority'     => 6,
		'default'      => kadence()->default( 'use_mobile_logo' ),
		'label'        => esc_html__( 'Different Logo for Mobile?', 'kadence' ),
		'context'      => array(
			array(
				'setting' => '__current_tab',
				'value'   => 'general',
			),
			array(
				'setting'  => '__device',
				'operator' => 'in',
				'value'    => array( 'tablet', 'mobile' ),
			),
		),
	),
	'mobile_logo' => array(
		'control_type' => 'media',
		'section'      => 'title_tagline',
		'transport'    => 'refresh',
		'priority'     => 6,
		'mime_type'    => 'image',
		'default'      => '',
		'label'        => esc_html__( 'Mobile Logo', 'kadence' ),
		'context'      => array(
			array(
				'setting' => '__current_tab',
				'value'   => 'general',
			),
			array(
				'setting'  => 'use_mobile_logo',
				'operator' => '=',
				'value'    => true,
			),
			array(
				'setting'  => '__device',
				'operator' => 'in',
				'value'    => array( 'tablet', 'mobile' ),
			),
		),
	),
	'logo_layout' => array(
		'control_type' => 'kadence_multi_radio_icon_control',
		'section'      => 'title_tagline',
		'priority'     => 6,
		'default'      => kadence()->default( 'logo_layout' ),
		'label'        => esc_html__( 'Logo Layout', 'kadence' ),
		'context'      => array(
			array(
				'setting' => '__current_tab',
				'value'   => 'general',
			),
		),
		'partial'      => array(
			'selector'            => '#masthead',
			'container_inclusive' => true,
			'render_callback'     => 'Kadence\header_markup',
		),
	),
	'brand_typography' => array(
		'control_type' => 'kadence_typography_control',
		'section'      => 'title_tagline',
		'label'        => esc_html__( 'Site Title Font', 'kadence' ),
		'context'      => array(
			array(
				'setting' => '__current_tab',
				'value'   => 'design',
			),
			array(
				'setting'    => 'logo_layout',
				'operator'   => 'sub_object_contains',
				'sub_key'    => 'include',
				'responsive' => true,
				'value'      => 'title',
			),
		),
		'default'      => kadence()->default( 'brand_typography' ),
		'live_method'     => array(
			array(
				'type'     => 'css_typography',
				'selector' => array(
					'desktop' => '#main-header .site-branding .site-title',
					'tablet'  => '#mobile-header .site-branding .site-title',
					'mobile'  => '#mobile-header .site-branding .site-title',
				),
				'pattern'  => array(
					'desktop' => '$',
					'tablet'  => '$',
					'mobile'  => '$',
				),
				'property' => 'font',
				'key'      => 'typography',
			),
		),
		'input_attrs'  => array(
			'id' => 'brand_typography',
		),
	),
	'brand_typography_color' => array(
		'control_type' => 'kadence_color_control',
		'section'      => 'title_tagline',
		'label'        => esc_html__( 'Site Title Hover and Active Colors', 'kadence' ),
		'default'      => kadence()->default( 'brand_typography_color' ),
		'live_method'     => array(
			array(
				'type'     => 'css',
				'selector' => '#masthead .site-branding .site-title:hover',
				'pattern'  => '$',
				'property' => 'color',
				'key'      => 'hover',
			),
			array(
				'type'     => 'css',
				'selector' => '#main-header .header-html a:hover',
				'property' => 'color',
				'pattern'  => '$',
				'key'      => 'hover',
			),
			array(
				'type'     => 'css',
				'selector' => 'body.home #masthead .site-branding .site-title',
				'pattern'  => '$',
				'property' => 'color',
				'key'      => 'active',
			),
		),
		'context'      => array(
			array(
				'setting' => '__current_tab',
				'value'   => 'design',
			),
			array(
				'setting'    => 'logo_layout',
				'operator'   => 'sub_object_contains',
				'sub_key'    => 'include',
				'responsive' => true,
				'value'      => 'title',
			),
		),
		'input_attrs'  => array(
			'colors' => array(
				'hover' => array(
					'tooltip' => __( 'Hover Color', 'kadence' ),
					'palette' => true,
				),
				'active' => array(
					'tooltip' => __( 'Active Color', 'kadence' ),
					'palette' => true,
				),
			),
		),
	),
	// Logo Tagline Typography.
	'brand_tag_typography' => array(
		'control_type' => 'kadence_typography_control',
		'section'      => 'title_tagline',
		'label'        => esc_html__( 'Site Tagline Font', 'kadence' ),
		'context'      => array(
			array(
				'setting' => '__current_tab',
				'value'   => 'design',
			),
			array(
				'setting'    => 'logo_layout',
				'operator'   => 'sub_object_contains',
				'sub_key'    => 'include',
				'responsive' => true,
				'value'      => 'tagline',
			),
		),
		'default'      => kadence()->default( 'brand_tag_typography' ),
		'live_method'     => array(
			array(
				'type'     => 'css_typography',
				'selector' => array(
					'desktop' => '#masthead .site-branding .site-description',
					'tablet'  => '.site-branding .site-description',
					'mobile'  => '.site-branding .site-description',
				),
				'pattern'  => array(
					'desktop' => '$',
					'tablet'  => '$',
					'mobile'  => '$',
				),
				'property' => 'font',
				'key'      => 'typography',
			),
		),
		'input_attrs'  => array(
			'id' => 'brand_tag_typography',
		),
	),
	'header_logo_padding' => array(
		'control_type' => 'kadence_measure_control',
		'section'      => 'title_tagline',
		'priority'     => 15,
		'default'      => kadence()->default( 'header_logo_padding' ),
		'label'        => esc_html__( 'Padding', 'kadence' ),
		'context'      => array(
			array(
				'setting' => '__current_tab',
				'value'   => 'design',
			),
		),
		'live_method'     => array(
			array(
				'type'     => 'css',
				'selector' => '.site-branding',
				'property' => 'padding',
				'pattern'  => '$',
				'key'      => 'measure',
			),
		),
		'input_attrs'  => array(
			'min'        => array(
				'px'  => 0,
				'em'  => 0,
				'rem' => 0,
			),
			'max'        => array(
				'px'  => 100,
				'em'  => 6,
				'rem' => 6,
			),
			'step'       => array(
				'px'  => 1,
				'em'  => 0.01,
				'rem' => 0.01,
			),
			'units'      => array( 'px', 'em', 'rem' ),
			'responsive' => true,
		),
	),
	'logo_link_to_site_icon' => array(
		'control_type' => 'kadence_focus_button_control',
		'section'      => 'title_tagline',
		'settings'     => false,
		'priority'     => 25,
		'label'        => esc_html__( 'Site Icon', 'kadence' ),
		'input_attrs'  => array(
			'section' => 'kadence_customizer_site_identity',
		),
	),
	'site_logo_link' => array(
		'control_type' => 'kadence_focus_button_control',
		'section'      => 'site_identity',
		'settings'     => false,
		'priority'     => 5,
		'label'        => esc_html__( 'Site Title and Logo Control', 'kadence' ),
		'input_attrs'  => array(
			'section' => 'title_tagline',
		),
	),
);

Theme_Customizer::add_settings( $settings );
