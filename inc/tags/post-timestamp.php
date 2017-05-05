<?php // Published Timestamp | content.php

if ( ! function_exists( 'apl_post_pub_mod_ts' ) ) {
    function apl_post_pub_mod_ts() {
        
        $post_pub_mod_info_mu = '<div class="cp %2$s" data-name="Post Published Modified Info">';
            $post_pub_mod_info_mu .= '<div class="cr %3$s---cr">';
                $post_pub_mod_info_mu .= '<div class="h %3$s---h"><span class="h_l %3$s---h_l">%1$s</span></div>';
                $post_pub_mod_info_mu .= '<div class="ct %3$s---ct">';
                    $post_pub_mod_info_mu .= '<div class="ct_cr %3$s---ct_cr">%4$s %5$s</div>';
                $post_pub_mod_info_mu .= '</div>';
            $post_pub_mod_info_mu .= '</div>';
        $post_pub_mod_info_mu .= '</div>';
        
        $post_pub_mod_lbl_mu = '<span class="obj %3$s" data-name="%6$s Timestamp Label">';
            $post_pub_mod_lbl_mu .= '<span class="label %4$s---label"><span class="label_l %4$s---label_l"><span class="word %5$s---word">%1$s</span> <span class="word on---word">%2$s</span></span></span>';
        $post_pub_mod_lbl_mu .= '</span>';
        
        $post_pub_mod_ts_mu = '<span class="obj %2$s" data-name="%1$s">';
            $post_pub_mod_ts_mu .= '<time class="time %3$s---time" datetime="%6$s">';
                $post_pub_mod_ts_mu .= '<span class="time_l %3$s---time_l">';
                    $post_pub_mod_ts_mu .= '<a class="a %3$s---a" href="%4$s" title="%5$s"><span class="a_l %3$s---a_l"><span class="word day---word">%7$s</span> <span class="word month---word">%8$s</span> <span class="word year---word">%9$s</span></span></a>';
                $post_pub_mod_ts_mu .= '</span>';
            $post_pub_mod_ts_mu .= '</time>';
        $post_pub_mod_ts_mu .= '</span><!-- %1$s -->';
        
        $post_pub_mod_mu = '<div class="cp %2$s" data-name="%1$s">';
            $post_pub_mod_mu .= '<div class="cr %3$s---cr">';
                $post_pub_mod_mu .= '<div class="h %3$s---h"><span class="h_l %3$s---h_l">%1$s</span></div>';
                $post_pub_mod_mu .= '<div class="ct %3$s---ct">';
                    $post_pub_mod_mu .= '<div class="ct_cr %3$s---ct_cr">';
                        $post_pub_mod_mu .= '%4$s %5$s';
                    $post_pub_mod_mu .= '</div>';
                $post_pub_mod_mu .= '</div><!-- ct -->';
            $post_pub_mod_mu .= '</div>';
        $post_pub_mod_mu .= '</div><!-- %1$s -->';
        
        // Post Published
        $post_pub_ts = sprintf( $post_pub_mod_ts_mu,
            esc_attr__( 'Post Published Timestamp', 'applicator' ),
            'post-published-timestamp',
            'post-pub-ts',
            esc_url( get_permalink() ),
            get_the_title(),
            get_the_date( DATE_W3C ),
            get_the_date( 'j' ), // Day (d)
            get_the_date( 'M' ), // Month (mmm)
            get_the_date( 'Y' ) // Year (yyyy)
        );
        
        // Post Modified
        $post_mod_ts = sprintf( $post_pub_mod_ts_mu,
            esc_attr__( 'Post Modified Timestamp', 'applicator' ),
            'post-modified-timestamp',
            'post-mod-ts',
            esc_url( get_permalink() ),
            get_the_title(),
            get_the_modified_date( DATE_W3C ),
            get_the_modified_date( 'j' ), // Day (d)
            get_the_modified_date( 'M' ), // Month (mmm)
            get_the_modified_date( 'Y' ) // Year (yyyy)
        );
        
        $post_pub_lbl = sprintf( $post_pub_mod_lbl_mu,
            esc_html__( 'Published', 'applicator' ),
            esc_html__( 'on', 'applicator' ),
            'post-published-timestamp-label',
            'post-pub-ts-lbl',
            'published',
            'Post Published'
        );
        
        $post_mod_lbl = sprintf( $post_pub_mod_lbl_mu,
            esc_html__( 'Modified', 'applicator' ),
            esc_html__( 'on', 'applicator' ),
            'post-modified-timestamp-label',
            'post-mod-ts-lbl',
            'modified',
            'Post Modified'
        );
        
        $post_pub = sprintf( $post_pub_mod_mu,
            esc_attr__( 'Post Published', 'applicator' ),
            'post-published',
            'post-pub',
            $post_pub_lbl,
            $post_pub_ts
        );
        
        $post_mod = sprintf( $post_pub_mod_mu,
            esc_attr__( 'Post Modified', 'applicator' ),
            'post-modified',
            'post-mod',
            $post_mod_lbl,
            $post_mod_ts
        );
        
        printf( $post_pub_mod_info_mu,
            esc_attr__( 'Post Published Modified Info', 'applicator' ),
            'post-published-modified-info',
            'post-pub-mod-info',
            $post_pub,
            $post_mod
        );
    
    }
}