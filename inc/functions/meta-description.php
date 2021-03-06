<?php // Meta Description
// Uses the Content or the Excerpt of a Post or Page for the Meta Description in <head>


if ( ! function_exists( 'applicator_meta_description' ) )
{
    function applicator_meta_description()
    {
        if ( is_single() || is_page() )
        {
            $queried_object = get_queried_object();
            
            // Check for Excerpt
            if ( ! empty( $queried_object->post_excerpt ) )
            {
                $content = $queried_object->post_excerpt;
            }

            // Check for Content
            elseif ( ! empty( $queried_object->post_content ) )
            {
                $content = $queried_object->post_content;
            }
            
            else
            {
                return;
            }
            
            $content = wp_trim_words( strip_shortcodes( $content ), 55 );
            ?>

            <meta name="description" content="<?php echo esc_attr( $content ); ?>">
        <?php
        }
    }
    add_action( 'wp_head', 'applicator_meta_description' );
}
