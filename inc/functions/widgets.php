<?php

/**
 * Widgets
 *
 * @package WordPress\Applicator\PHP
 */





/**
 * Aside Initialization
 */
function applicator_aside_init() {
    
    // Widget HTML Markup
    $widget_start_mu = '<div id="%1$s" class="cp widget %2$s" data-name="Widget">';
        $widget_start_mu .= '<div class="cr widget---cr">';
            $widget_start_mu .= '<div class="hr widget---hr">';
                $widget_start_mu .= '<div class="hr_cr widget---hr_cr">';
                    $widget_start_mu .= '<div class="h widget---h" aria-hidden="true">';
                        $widget_start_mu .= '<span class="h_l widget---h_l">';
                            $widget_start_mu .= '<span class="l widget---l">';
                                $widget_start_mu .= esc_html__( 'Widget', 'applicator' );
                            $widget_start_mu .= '</span>';
                        $widget_start_mu .= '</span>';
                    $widget_start_mu .= '</div>';
                $widget_start_mu .= '</div>';
            $widget_start_mu .= '</div>';
            $widget_start_mu .= '<div class="mn widget---mn">';
                $widget_start_mu .= '<section class="mn_cr widget---mn_cr widget--main" data-main-name="Widget MN">';
                    $widget_start_mu .= '<div class="cp widget-content" data-name="Widget Content CP">';
                        $widget_start_mu .= '<div class="cr widget-content---cr">';
                            $widget_start_mu .= '<div class="hr widget-content---hr">';
                                $widget_start_mu .= '<div class="hr_cr widget-content---hr_cr">';
                                    $widget_start_mu .= '<h4 class="h widget-content---h" aria-hidden="true">';
                                        $widget_start_mu .= '<span class="h_l widget-content---h_l">';
                                            $widget_start_mu .= '<span class="l widget-content---l">';
                                                $widget_start_mu .= esc_html__( 'Widget Content', 'applicator' );
                                            $widget_start_mu .= '</span>';
                                        $widget_start_mu .= '</span>';
                                    $widget_start_mu .= '</h4>';
                                $widget_start_mu .= '</div>';
                            $widget_start_mu .= '</div>';
                            $widget_start_mu .= '<div class="mn widget-content---mn">';
                                $widget_start_mu .= '<div class="mn_cr widget-content---mn_cr widget-content--main" data-main-name="Widget Content MN">';

                                $widget_end_mu = '</div>';
                            $widget_end_mu .= '</div>';
                        $widget_end_mu .= '</div>';
                    $widget_end_mu .= '</div>';
                $widget_end_mu .= '</section>';
            $widget_end_mu .= '</div>';
        $widget_end_mu .= '</div>';
    $widget_end_mu .= '</div>';
    
    $widget_h_start_mu = '<div class="obj widget-heading" data-name="Widget Heading OBJ">';
        $widget_h_start_mu .= '<h4 class="h widget-heading---h">';
            $widget_h_start_mu .= '<span class="h_l widget-heading---h_l">';
                $widget_h_start_mu .= '<span class="l widget-heading---l">';

                $widget_h_end_mu = '</span>';
            $widget_h_end_mu = '</span>';
        $widget_h_end_mu .= '</h4>';
    $widget_h_end_mu .= '</div>';
    
    register_sidebar( array(
		'name'          => __( '1. Main Header', 'applicator' ),
		'id'            => 'main-header-aside',
		'description'   => __( 'Aside located in Main Header', 'applicator' ),
		'before_widget' => $widget_start_mu,
		'after_widget'  => $widget_end_mu,
		'before_title'  => $widget_h_start_mu,
		'after_title'   => $widget_h_end_mu,
	) );
    
    register_sidebar( array(
		'name'          => __( '2. Main Actions', 'applicator' ),
		'id'            => 'main-actions-aside',
		'description'   => __( 'Aside located after Main Nav', 'applicator' ),
		'before_widget' => $widget_start_mu,
		'after_widget'  => $widget_end_mu,
		'before_title'  => $widget_h_start_mu,
		'after_title'   => $widget_h_end_mu,
	) );
    
    register_sidebar( array(
		'name'          => __( '3. Main Banner', 'applicator' ),
		'id'            => 'main-banner-aside',
		'description'   => __( 'Aside located in Main Banner', 'applicator' ),
		'before_widget' => $widget_start_mu,
		'after_widget'  => $widget_end_mu,
		'before_title'  => $widget_h_start_mu,
		'after_title'   => $widget_h_end_mu,
	) );
    
    register_sidebar( array(
		'name'          => __( '4. Main Content Header', 'applicator' ),
		'id'            => 'main-content-header-aside',
		'description'   => __( 'Aside located in Main Content Header', 'applicator' ),
		'before_widget' => $widget_start_mu,
		'after_widget'  => $widget_end_mu,
		'before_title'  => $widget_h_start_mu,
		'after_title'   => $widget_h_end_mu,
	) );
    
    register_sidebar( array(
		'name'          => __( '5. Main Content', 'applicator' ),
		'id'            => 'main-content-aside',
		'description'   => __( 'Aside located in Main Content', 'applicator' ),
		'before_widget' => $widget_start_mu,
		'after_widget'  => $widget_end_mu,
		'before_title'  => $widget_h_start_mu,
		'after_title'   => $widget_h_end_mu,
	) );
    
    register_sidebar( array(
		'name'          => __( '6. Main Footer', 'applicator' ),
		'id'            => 'main-footer-aside',
		'description'   => __( 'Aside located in Main Footer', 'applicator' ),
		'before_widget' => $widget_start_mu,
		'after_widget'  => $widget_end_mu,
		'before_title'  => $widget_h_start_mu,
		'after_title'   => $widget_h_end_mu,
	) );
}
add_action( 'widgets_init', 'applicator_aside_init' );