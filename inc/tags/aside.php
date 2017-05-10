<?php

// Aside Constructor Markup
$GLOBALS['aside_cn_mu'] = '<aside id="%2$s" class="cn aside %2$s" data-name="%1$s" role="complementary">';
    $GLOBALS['aside_cn_mu'] .= '<div class="cr %3$s---cr">';
        $GLOBALS['aside_cn_mu'] .= '<div class="hr %3$s---hr">';
            $GLOBALS['aside_cn_mu'] .= '<div class="hr_cr %3$s---hr_cr">';
                $GLOBALS['aside_cn_mu'] .= '<h2 class="h %3$s---h"><span class="h_l %3$s---h_l">%1$s</span></h2>';
            $GLOBALS['aside_cn_mu'] .= '</div>';
        $GLOBALS['aside_cn_mu'] .= '</div>';
        $GLOBALS['aside_cn_mu'] .= '<div class="ct %3$s---ct">';
            $GLOBALS['aside_cn_mu'] .= '<div class="ct_cr %3$s---ct_cr">';
                $GLOBALS['aside_cn_mu'] .= '%4$s';
            $GLOBALS['aside_cn_mu'] .= '</div>';
        $GLOBALS['aside_cn_mu'] .= '</div>';
    $GLOBALS['aside_cn_mu'] .= '</div>';
$GLOBALS['aside_cn_mu'] .= '</aside>';

// Main Header Aside
if ( ! function_exists( 'apl_func_main_header_aside' ) ) {
    function apl_func_main_header_aside() {
        
        ob_start();
        dynamic_sidebar('main-header-aside');
        $aside = ob_get_contents();
        ob_end_clean();
        
        if ( is_active_sidebar( 'main-header-aside' )  ) {
            printf( $GLOBALS['aside_cn_mu'],
                esc_html__( 'Main Header Aside', 'applicator' ),
                esc_attr__( 'main-header-aside', 'applicator' ),
                esc_attr__( 'main-hr-as', 'applicator' ),
                $aside
            );
        }
    
    }
}


// Main Content Header Aside
if ( ! function_exists( 'apl_func_main_content_header_aside' ) ) {
    function apl_func_main_content_header_aside() {
        
        ob_start();
        dynamic_sidebar('main-content-header-aside');
        $aside = ob_get_contents();
        ob_end_clean();
        
        if ( is_active_sidebar( 'main-content-header-aside' )  ) {
            printf( $GLOBALS['aside_cn_mu'],
                esc_html__( 'Main Content Header Aside', 'applicator' ),
                esc_attr__( 'main-content-header-aside', 'applicator' ),
                esc_attr__( 'main-ct-hr-as', 'applicator' ),
                $aside
            );
        }
    
    }
}


// Main Content Aside
if ( ! function_exists( 'apl_func_main_content_aside' ) ) {
    function apl_func_main_content_aside() {
        
        ob_start();
        dynamic_sidebar('main-content-aside');
        $aside = ob_get_contents();
        ob_end_clean();
        
        printf( $GLOBALS['aside_cn_mu'],
            esc_html__( 'Main Content Aside', 'applicator' ),
            esc_attr__( 'main-content-aside', 'applicator' ),
            esc_attr__( 'main-ct-as', 'applicator' ),
            $aside
        );
    
    }
}


// Main Footer Aside
if ( ! function_exists( 'apl_func_main_footer_aside' ) ) {
    function apl_func_main_footer_aside() {
        
        ob_start();
        dynamic_sidebar('main-footer-aside');
        $aside = ob_get_contents();
        ob_end_clean();
        
        if ( is_active_sidebar( 'main-footer-aside' )  ) {
            printf( $GLOBALS['aside_cn_mu'],
                esc_html__( 'Main Footer Aside', 'applicator' ),
                esc_attr__( 'main-footer-aside', 'applicator' ),
                esc_attr__( 'main-fr-as', 'applicator' ),
                $aside
            );
        }
    
    }
}