<?php
/**
 * Customizer Panels Settings - Post Single
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * セクション
 * ------------------------------------------------------ */

/* 投稿詳細 */
$wp_customize->add_section(
	'post_settings',
	array(
		'title'    => __( 'Post single page', 'welcart_mode' ),
		'priority' => 70,
		'panel'    => 'general_settings',
	)
);

/**
 * 投稿詳細 セッティング
 * ------------------------------------------------------ */

/* 3000: 投稿記事アイキャッチの表示非表示　*/
$wp_customize->add_setting(
	'mode_type_options[display_post_thumbnail]',
	array(
		'default'    => 'display',
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_control(
	'display_post_thumbnail',
	array(
		'label'    => __( 'Show eye catch on post single', 'welcart_mode' ),
		'section'  => 'post_settings',
		'settings' => 'mode_type_options[display_post_thumbnail]',
		'type'     => 'radio',
		'priority' => 71,
		'choices'  => array(
			'display'     => __( 'Show', 'welcart_mode' ),
			'not-display' => __( 'Do not show', 'welcart_mode' ),
		),
	)
);
