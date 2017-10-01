<?php // HTML Classes

if ( ! function_exists( 'applicator_html_class' ) ) {
    function applicator_html_class() {
		
        // Global Variables
        global $is_lynx, $is_gecko, $is_IE, $is_macIE, $is_winIE, $is_edge, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        global $post;
        
        $useragent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
        $is_ipad = preg_match('/ipad/i',$useragent);
        
        
        // View (Front, Inner)
        if ( is_front_page() ) {
        // if ( is_front_page() && ! is_home() )
        // if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) )
            echo ' '. 'view--front';
        }
        else {
            echo ' '. 'view--inner';
        }
        
        
        // Browser Detection
        if ( $is_chrome ) {
            echo ' '. 'browser--chrome';
        }
        elseif ( $is_gecko ) {
            echo ' '. 'browser--gecko';
        }
        elseif ( $is_safari ) {
            echo ' '. 'browser--safari';
        }
        elseif ( $is_opera ) {
            echo ' '. 'browser--opera';
        }
        elseif ( $is_lynx ) {
            echo ' '. 'browser--lynx';
        }
        elseif ( $is_NS4 ) {
            echo ' '. 'browser--ns4';
        }
        elseif ( $is_IE ) {
            echo ' '. 'browser--ie';
        }
        elseif ( $is_macIE ) {
            echo ' '. 'browser--mac-ie';
        }
        elseif ( $is_winIE ) {
            echo ' '. 'browser--win-ie';
        }
        elseif ( $is_edge ) {
            echo ' '. 'browser--edge';
        }
        elseif ( $is_iphone ) {
            echo ' '. 'browser--iphone';
        }
        elseif ( $is_ipad ) {
            echo ' '. 'browser--ipad';
        }
        else {
            echo ' '. 'browser--unlisted';
        }
        
        
        // Device Detection
        if ( wp_is_mobile() ) {
            echo ' '. 'device--mobile';
        }
        else {
            echo ' '. 'device--not-mobile';
        }
        
        
        // Theme Detection
        if ( ! is_child_theme() ){
            echo ' '. 'theme--parent';
        }
        else {
            echo ' '. 'theme--child';
        }
        
        
        // Menu Type Detection
        // If Default Menu or Custom Menu is used as Main Navigation
        if ( ! has_nav_menu( 'main-nav' ) ) {
            echo ' '. 'main-nav--default';
        }
        else {
            echo ' '. 'main-nav--custom';
        }
        
        
        // Authorship Type
        if ( is_multi_author() ) {
            echo ' '. 'authorship--multi';
        }
        else {
            echo ' '. 'authorship--single';
        }
        
        
        // Non-Singular Pages
        if ( ! is_singular() ) {
            echo ' '. 'view--category hfeed';
        }
        else {
            echo ' '. 'view--detail';
        }
        
        // Password Protection
        if ( is_singular() ) {
            
            if ( ! post_password_required() ) {
                echo ' '. 'password--not-required';
            }
            else {
                echo ' '. 'password--required';
            }
        }
        
        // Aside Status
        // Enable or display Sidebars via Appearance > Widgets
            
        $main_header_aside = 'main-header-aside';
        $main_header_content_aside = ' '. 'main-header-content-aside';
        $main_content_aside = ' '. 'main-content-aside';
        $main_footer_aside = ' '. 'main-footer-aside';
        
        $on = '--enabled';
        $off = '--disabled';
        
        // Main Header Aside
        if ( is_active_sidebar( $main_header_aside ) ) {
            echo ' '. $main_header_aside. $on;
        }
        else {
            echo ' '. $main_header_aside. $off;
        }
        
        // Main Content Header Aside
        if ( is_active_sidebar( $main_header_content_aside ) ) {
            echo ' '. $main_header_content_aside. $on;
        }
        else {
            echo ' '. $main_header_content_aside. $off;
        }
        
        // Main Content Aside
        if ( is_active_sidebar( $main_content_aside ) ) {
            echo ' '. $main_content_aside. $on;
        }
        else {
            echo ' '. $main_content_aside. $off;
        }

        // Main Footer Aside
        if ( is_active_sidebar( $main_footer_aside ) ) {
            echo ' '. $main_footer_aside. $on;
        }
        else {
            echo ' '. $main_footer_aside. $off;
        }
        
        
        // In Customizer
        if ( is_customize_preview() ) {
            echo ' '. 'view--customizer';
        }
        
        
        // Customizer: Custom Header
        if ( has_header_image() ) {
            echo ' '. 'main-media-banner'. $on;
        }
        else {
            echo ' '. 'main-media-banner'. $off;
        }
        
        
        // Customizer: Custom Logo
        if ( has_custom_logo() ) {
            echo ' '. 'main-logo'. $on;
        } else {
            echo ' '. 'main-logo'. $off;
        }
        
        
        // Post Type
        if ( isset( $post ) ) {
            echo ' '. 'view--'. $post->post_type;
        }
        
        if ( is_singular() ) {
            echo ' '. 'view--'. $post->post_type . '--'. $post->post_name;
        }

        
        // Main Name, Description
        if ( 'blank' === get_header_textcolor() ) {
            echo ' '. 'web-product-main-name-description'. $off;
        } else {
            echo ' '. 'web-product-main-name-description'. $on;
        }
        
        
        // Main Description
        if ( get_bloginfo( 'description', 'display' ) ) {
            echo ' '. 'main-description--populated';
        } else {
            echo ' '. 'main-description--empty';
        }
        
        
        // Admin Bar
        if ( is_admin_bar_showing() ) {
            echo ' '. 'wp-admin-bar'. $on;
        } else {
            echo ' '. 'wp-admin-bar'. $off;
        }
        
        
        // Comments
        if ( is_singular() ) {
            $comments_count_int = (int) get_comments_number( get_the_ID() );
            
            // Comments Population Count
            if ( $comments_count_int == 1 ) {
                echo ' '.'comments-population--populated--single';
            }
            elseif ( $comments_count_int > 1 ) {
                echo ' '.'comments-population--populated--multiple';
            }
            elseif ( $comments_count_int == 0 ) {
                echo ' '.'comments-population--populated--zero';
            }
            
            // Comment Creation Ability
            if ( comments_open() ) {
                echo ' '.'comment-creation-ability--enabled';
            }
            else {
                echo ' '.'comment-creation-ability--disabled';
            }
            
            // Comments Population Status
            if ( $comments_count_int > 1 ) {
                echo ' '.'comments-population--populated';
            }
            else {
                echo ' '.'comments-population--empty';
            }
        }
        
        
        // Category
        if ( is_singular() ) {
            foreach ( ( get_the_category( $post->ID ) ) as $category ) {
                echo ' '.'category--'. $category->category_nicename;
            }
        }
        
        
        // Page Template
        $template_file = get_post_meta( get_the_ID(), '_wp_page_template', TRUE );
        $page_template_term = 'page-template';
        if ( $template_file ) {
            echo ' '. $page_template_term. ' '. $page_template_term. '--'. sanitize_title( $template_file );
        }
        else {
            echo ' '. $page_template_term. '--none';
        }
        
        
        // Customizer Colors
        $colors = applicator_sanitize_colorscheme( get_theme_mod( 'colorscheme', 'default' ) );
        echo ' '. 'applicator--theme--customizer-colors--'. $colors;
        
        
        // Multisite
        if ( is_multisite() && is_page_template( 'page-templates/multisite-directory.php' ) ) {
            echo ' ' . 'view--multisite-directory';
        }
    }
    add_action( 'applicator_hook_html_class', 'applicator_html_class');
}


// Body Class
if ( ! function_exists( 'applicator_body_class' ) ) {
    function applicator_body_class( $classes ) {

        $classes[] = 'body';
        return $classes;
    
    }
    add_filter( 'body_class', 'applicator_body_class' );
}