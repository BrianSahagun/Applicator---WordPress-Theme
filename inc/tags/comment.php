<?php // Comment Item | comments.php

if ( ! function_exists( 'applicator_func_comment' ) ) {
    function applicator_func_comment( $comment, $args, $depth ) {
        
        if ( 'div' === $args['style'] ) {
            $tag       = 'div';
            $add_below = 'comment';
        } else {
            $tag       = 'li';
            $add_below = 'comment';
        }
        
        if ( true === $args['has_children'] ) {
            $comment_has_children_css = 'comment--parent';
        } else {
            $comment_has_children_css = 'comment--solo';
        }

        ?>

        <<?php echo $tag ?> id="comment-<?php comment_ID() ?>" <?php comment_class( 'item cp comment' . ' ' . $comment_has_children_css ) ?> data-name="Comment">
            
        <?php if ( 'div' != $args['style'] ) { ?>
            <article class="cr comment---cr">
        <?php } ?>
                
                <div class="hr comment---hr">
                    <div class="hr_cr comment---hr_cr">
                        <div class="obj comment-title-obj" data-name="Comment Title Object">
                            <h2 class="h comment---h">
                                <span class="h_l comment---h_l">
                                    <a class="a comment---a" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                                        <span class="a_l comment---a_l"><span class="word comment-title---word"><?php esc_html_e( 'Comment', 'applicator' ); ?> <?php comment_ID() ?></span></span>
                                    </a>
                                </span>
                            </h2>
                        </div><!-- Comment Title Object -->
                        
                        <?php if ( current_user_can( 'editor' ) || current_user_can( 'administrator' ) ) { ?>
                        <div class="axns comment-admin-axns" data-name="Comment Admin Actions">
                            <div class="cr com-admin-axns---cr">
                                <div class="h com-admin-axns---h"><span class="h_l com-admin-axns---h_l"><?php esc_html_e( 'Comment Admin Actions', 'applicator' ); ?></span></div>
                                <div class="ct com-admin-axns---ct">
                                    <div class="ct_cr com-admin-axns---ct_cr">
                                        <span class="obj axn edit-comment-axn" data-name="Edit Comment Action">
                                            <?php
                                            // Markup
                                            $edit_comment_axn_a_l_mu = '<span class="a_l edit-com-axn---a_l" title="%5$s"><span class="word %2$s---word">%1$s</span> <span class="word %4$s---word">%3$s</span></span>';

                                            // Content
                                            $edit_comment_axn_a_l = sprintf( $edit_comment_axn_a_l_mu,
                                                esc_html__( 'Edit', 'applicator' ),
                                                'edit',
                                                esc_html__( 'Comment', 'applicator' ) . ' ' . $comment->comment_ID,
                                                'comment-title',
                                                esc_attr__( 'Edit Comment', 'applicator' )
                                            );

                                            edit_comment_link( $edit_comment_axn_a_l, '', '' );                  
                                            ?>
                                        </span><!-- Edit Comment Action -->
                                    </div>
                                </div><!-- ct -->
                            </div>
                        </div><!-- Comment Admin Actions -->
                        <?php } ?>
                        
                        <div class="aside comment-header-aside" data-name="Comment Header Aside">
                            <div class="cr com-hr-as---cr">
                                <div class="h com-hr-as---h"><span class="h_l com-hr-as---h_l"><?php esc_html_e( 'Comment Header Aside', 'applicator' ); ?></span></div>
                                <div class="ct com-hr-as---ct">
                                    <div class="ct_cr com-hr-as---ct_cr">
                                        
                                        <div class="cp comment-meta" data-name="Comment Meta">
                                            <div class="cr com-meta---cr">
                                                <div class="h com-meta---h"><span class="h_l com-meta---h_l">Comment Meta</span></div>
                                                <div class="ct com-meta---ct">
                                                    <div class="ct_cr com-meta---ct_cr">
                                        
                                                        <?php // Comment Published Info
                                                        $com_pub_mu = '<div class="%2$s" data-name="%1$s">';
                                                            $com_pub_mu .= '<div class="cr %3$s---cr">';
                                                                $com_pub_mu .= '<div class="h %3$s---h"><span class="h_l %3$s---h_l">%4$s</span></div>';
                                                                $com_pub_mu .= '<div class="ct %3$s---ct">';
                                                                    $com_pub_mu .= '<div class="ct_cr %3$s---ct_cr">';
                                                                        $com_pub_mu .= '%5$s %6$s';
                                                                    $com_pub_mu .= '</div>';
                                                                $com_pub_mu .= '</div><!-- ct -->';
                                                            $com_pub_mu .= '</div>';
                                                        $com_pub_mu .= '</div><!-- %1$s -->';

                                                                $com_pub_lbl_mu = '<span class="%2$s" data-name="%1$s">';
                                                                    $com_pub_lbl_mu .= '<span class="g %3$s---g"><span class="g_l %3$s---g_l"><span class="word %5$s---word">%4$s</span> <span class="word %7$s---word">%6$s</span></span></span>';
                                                                $com_pub_lbl_mu .= '</span><!-- %1$s -->';

                                                                $com_pub_date_time_mu = '<div class="%2$s" data-name="%1$s">';
                                                                    $com_pub_date_time_mu .= '<div class="cr %3$s---cr">';
                                                                        $com_pub_date_time_mu .= '<div class="h %3$s---h"><span class="h_l %3$s---h_l">%4$s</span></div>';
                                                                        $com_pub_date_time_mu .= '<div class="ct %3$s---ct">';
                                                                            $com_pub_date_time_mu .= '<div class="ct_cr %3$s---ct_cr">%5$s %6$s</div>';
                                                                        $com_pub_date_time_mu .= '</div>';
                                                                    $com_pub_date_time_mu .= '</div>';
                                                                $com_pub_date_time_mu .= '</div><!-- %1$s -->';

                                                                        $com_pub_date_mu = '<span class="%2$s" data-name="%1$s">';
                                                                            $com_pub_date_mu .= '<time class="time %3$s---time" datetime="%11$s">';
                                                                                $com_pub_date_mu .= '<span class="time_l %3$s---time_l">';
                                                                                    $com_pub_date_mu .= '<a class="a %3$s---a" href="%10$s" title="%12$s"><span class="a_l %3$s---a_l"><span class="word %5$s---word">%4$s</span> <span class="word %7$s---word">%6$s</span> <span class="word %9$s---word">%8$s</span></span></a>';
                                                                                $com_pub_date_mu .= '</span>';
                                                                            $com_pub_date_mu .= '</time>';
                                                                        $com_pub_date_mu .= '</span><!-- %1$s -->';

                                                                        $com_pub_time_mu = '<span class="%2$s" data-name="%1$s">';
                                                                            $com_pub_time_mu .= '<time class="time %3$s---time" datetime="%11$s">';
                                                                                $com_pub_time_mu .= '<span class="time_l %3$s---time_l">';
                                                                                    $com_pub_time_mu .= '<a class="a %3$s---a" href="%10$s" title="%12$s"><span class="a_l %3$s---a_l"><span class="word %5$s---word">%4$s</span><span class="sep colon---sep">:</span><span class="word %7$s---word">%6$s</span><span class="sep colon---sep">:</span><span class="word %9$s---word">%8$s</span></span></a>';
                                                                                $com_pub_time_mu .= '</span>';
                                                                            $com_pub_time_mu .= '</time>';
                                                                        $com_pub_time_mu .= '</span><!-- %1$s -->';

                                                        // Comment Published Label
                                                        $com_pub_lbl_NAME = 'Comment Published Date and Time Stamp Label';
                                                        $com_pub_lbl = sprintf( $com_pub_lbl_mu,
                                                            $com_pub_lbl_NAME,
                                                            'obj comment-published-timestamp-label',
                                                            'com-pub-ts-lbl',
                                                            esc_html__( 'Commented', 'applicator' ),
                                                            'published',
                                                            esc_html__( 'on', 'applicator' ),
                                                            'on'
                                                        );

                                                        // Comment Published Date
                                                        $com_pub_date_NAME = 'Comment Published Date Stamp';
                                                        $com_pub_date = sprintf( $com_pub_date_mu,
                                                            $com_pub_lbl_NAME,
                                                            'obj comment-published-date-stamp',
                                                            'com-pub-ds',
                                                            get_comment_date( 'j' ), // Day (d)
                                                            'day',
                                                            get_comment_date( 'M' ), // Month (mmm)
                                                            'month',
                                                            get_comment_date( 'Y' ), // Year (yyyy)
                                                            'year',
                                                            htmlspecialchars( get_comment_link( $comment->comment_ID ) ),
                                                            get_comment_date( DATE_W3C ),
                                                            get_comment_date( 'j F Y')
                                                        );

                                                        // Comment Published Time
                                                        $com_pub_time_NAME = 'Comment Published Time Stamp';
                                                        $com_pub_time = sprintf( $com_pub_time_mu,
                                                            $com_pub_time_NAME,
                                                            'obj comment-published-time-stamp',
                                                            'com-pub-ts',
                                                            get_comment_time( 'H' ), // Day (d)
                                                            'hours',
                                                            get_comment_time( 'i' ), // Month (mmm)
                                                            'minutes',
                                                            get_comment_time( 's' ), // Year (yyyy)
                                                            'seconds',
                                                            esc_url( get_permalink() ),
                                                            get_comment_time( DATE_W3C ),
                                                            get_comment_time( 'H:i:s')
                                                        );

                                                        // Comment Published Date Time Component
                                                        $com_pub_date_time_NAME = 'Comment Published Date and Time Stamp';
                                                        $com_pub_date_time = sprintf( $com_pub_date_time_mu,
                                                            $com_pub_date_time_NAME,
                                                            'cp comment-published-date-time-stamp',
                                                            'com-pub-dts',
                                                            $com_pub_date_time_NAME,
                                                            $com_pub_date,
                                                            $com_pub_time
                                                        );

                                                        // Comment Published Info Component
                                                        $com_pub_NAME = 'Comment Published Info';
                                                        printf( $com_pub_mu,
                                                            $com_pub_NAME,
                                                            'cp comment-published-info',
                                                            'com-pub-info',
                                                            $com_pub_NAME,
                                                            $com_pub_lbl,
                                                            $com_pub_date_time
                                                        );
                                                        ?>

                                                        <div class="cp comment-published-author" data-name="Comment Published Author">
                                                            <div class="cr com-pub-author---cr">
                                                                <div class="h com-pub-author---h"><span class="h_l com-pub-author---h_l"><?php esc_html_e( 'Comment Published Author ', 'applicator' ); ?></span></div>
                                                                <div class="ct com-pub-author---ct">
                                                                    <div class="ct_cr com-pub-author---ct_cr">

                                                                        <span class="obj comment-published-author-label-obj" data-name="Comment Published Author Label Object">
                                                                            <span class="g com-pub-author-lbl-obj---g"><span class="g_l com-pub-author-lbl-obj---g_l"><?php esc_html_e( 'Commented by', 'applicator' ); ?></span></span>
                                                                        </span><!-- Comment Published Author Label Object -->

                                                                        <div class="cp comment-author" data-name="Comment Author">
                                                                            <div class="cr com-author---cr">
                                                                                <div class="h com-author---h"><span class="h_l com-author---h_l"><?php esc_html_e( 'Comment Author', 'applicator' ); ?></span></div>
                                                                                <div class="ct com-author---ct">
                                                                                    <div class="ct_cr com-author---ct_cr">
                                                                                        <span class="obj comment-author-name-obj" title="" data-name="Comment Author Name Object">
                                                                                            <span class="g com-author-name-obj---g"><span class="g_l com-author-name-obj---g_l">
                                                                                                <a class="a com-author-name-obj---a" href="<?php echo get_comment_author_url(); ?>"><span class="a_l com-author-name-obj---a-l"><?php echo get_comment_author(); ?></span></a>
                                                                                            </span></span>
                                                                                        </span><!-- Comment Author Name Object -->
                                                                                        <span class="obj comment-author-avatar-obj" title="" data-name="Comment Author Avatar Object">
                                                                                            <a class="a com-author-avatar-obj---a" href="<?php echo get_comment_author_url(); ?>">
                                                                                                <span class="a_l com-author-avatar-obj---a_l">
                                                                                                    <span class="ee--img com-author-avatar-obj---ee--img"><?php echo get_avatar( $comment, $args['avatar_size'] ); ?></span>
                                                                                                </span>
                                                                                            </a>
                                                                                        </span><!-- Comment Author Avatar Object -->
                                                                                    </div>
                                                                                </div><!-- ct -->
                                                                            </div>
                                                                        </div><!-- Comment Author -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- Comment Published Author -->
                                                    </div>
                                                </div><!-- ct -->
                                            </div>
                                        </div><!-- Comment Meta -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- Comment Header Aside -->
                    </div>
                </div><!-- comment--hr -->
                <div class="ct comment---ct">
                    <div class="ct_cr comment---ct_cr">
                        
                        <?php if ( $comment->comment_approved == '0' ) { ?>
                        <div class="obj note comment-unapproved-note---obj" data-name="Comment Unapproved Note Object">
                            <div class="g comment-unapproved-note---g">
                                <p><?php esc_html_e( 'Your comment is awaiting moderation.', 'applicator' ); ?></p>
                            </div>
                        </div><!-- Comment Unapproved Note Object -->
                        <?php } ?>
                        
                        <?php comment_text(); ?>
                    
                    </div>
                </div><!-- ct -->
                
                <?php if ( is_singular() && comments_open() && get_option( 'thread_comments' ) && $depth < $args['max_depth'] ) { ?>
                <div class="fr comment---fr">
                    <div class="fr_cr comment---fr_cr">
                        
                        <?php
                                                                                                                                 
                        $comment_reply_axn_a_l_mu = '';
                        $comment_reply_axn_a_l_mu .= '<span class="a_l comment-reply-axn---a_l">%1$s</span>';

                        $reply_to_comment_line_mu = '';
                        $reply_to_comment_line_mu .= '<span class="line reply-to-comment---line">';
                            $reply_to_comment_line_mu .= '<span class="txt reply---txt">';
                                $reply_to_comment_line_mu .= esc_html__( 'Reply', 'applicator' );
                            $reply_to_comment_line_mu .= '</span>';
                            $reply_to_comment_line_mu .= ' <span class="txt to---txt">';
                                $reply_to_comment_line_mu .= esc_html__( 'to', 'applicator' );
                            $reply_to_comment_line_mu .= '</span>';
                            $reply_to_comment_line_mu .= ' <span class="txt comment---txt">';
                                $reply_to_comment_line_mu .= esc_html__( 'Comment', 'applicator' );
                            $reply_to_comment_line_mu .= '</span>';
                        $reply_to_comment_line_mu .= '</span>';

                        $sign_in_required_line_mu = '';
                        $sign_in_required_line_mu .= '<span class="line sign-in-required---line">';
                            $sign_in_required_line_mu .= '<span class="txt open-parenthesis---txt">';
                                $sign_in_required_line_mu .= '(';
                            $sign_in_required_line_mu .= '</span>';
                            $sign_in_required_line_mu .= '<span class="txt requires---txt">';
                                $sign_in_required_line_mu .= esc_html__( 'requires', 'applicator' );
                            $sign_in_required_line_mu .= '</span>';
                            $sign_in_required_line_mu .= ' <span class="txt sign---txt">';
                                $sign_in_required_line_mu .= esc_html__( 'Sign', 'applicator' );
                            $sign_in_required_line_mu .= '</span>';
                            $sign_in_required_line_mu .= ' <span class="txt in---txt">';
                                $sign_in_required_line_mu .= esc_html__( 'In', 'applicator' );
                            $sign_in_required_line_mu .= '</span>';
                            $sign_in_required_line_mu .= '<span class="txt close-parenthesis---txt">';
                                $sign_in_required_line_mu .= ')';
                            $sign_in_required_line_mu .= '</span>';
                        $sign_in_required_line_mu .= '</span>';

                        $reply_text_content = sprintf( $comment_reply_axn_a_l_mu,
                            $reply_to_comment_line_mu
                        );

                        $login_text_content = sprintf( $comment_reply_axn_a_l_mu,
                            $reply_to_comment_line_mu.' '.$sign_in_required_line_mu
                        );

                        ob_start();
                        comment_reply_link( array_merge(
                            $args,
                            array(
                                'add_below'     => $add_below,
                                'depth'         => $depth,
                                'max_depth'     => $args['max_depth'],
                                'reply_text'    => $reply_text_content,
                                'login_text'    => $login_text_content
                            )
                        ) );
                        $comment_reply_axn_content = ob_get_contents();
                        ob_end_clean();

                        $comment_reply_axn_obj = htmlok( array(
                            'name'      => 'Comment Reply',
                            'structure' => array(
                                'type'      => 'object',
                                'subtype'   => 'action item',
                                'wpg'       => true,
                            ),
                            'content'   => array(
                                'object'    => $comment_reply_axn_content,
                            ),
                            'echo'      => true,
                        ) );
                        ?>
                    
                    </div>
                </div>
                <?php }
                    
            if ( 'div' != $args['style'] ) { ?>
            </article>
            <?php }
    }
}