<?php // Post Categories | content.php

if ( ! function_exists( 'applicator_post_categories' ) ) {
    
    function applicator_post_categories() {        
        
        if ( 'post' === get_post_type() ) {
            
            $categories_list = get_the_category_list();
            
            if ( $categories_list ) {
                
                
                // R: Post Categories Label
                $post_categories_label_obj = applicator_htmlok( array(
                    'name'      => 'Post Categories',
                    'structure' => array(
                        'type'      => 'object',
                        'subtype'   => 'generic label',
                    ),
                    'content'   => array(
                        'object' => array(
                            array(
                                'txt'   => 'Categories',
                            ),
                        ),
                    ),
                ) );
                
                
                // R: Categories
                $categories_cp = applicator_htmlok( array(
                    'name'      => 'Categories',
                    'structure' => array(
                        'type'      => 'component',
                    ),
                    'root_css'  => 'apl-categories',
                    'content'   => array(
                        'component' => $categories_list,
                    ),
                ) );
                
                
                // R: Post Category
                $post_categories_cp = applicator_htmlok( array(
                    'name'      => 'Post Categories',
                    'structure' => array(
                        'type'      => 'component',
                    ),
                    'root_css'  => 'apl-post-categories',
                    'content'   => array(
                        'component' => array(
                            $post_categories_label_obj,
                            $categories_cp,
                        ),
                    ),
                ) );
                
                return $post_categories_cp;
            
            }
        }
    }
}

// Post Tags | content.php
if ( ! function_exists( 'applicator_post_tags' ) ) {
    
    function applicator_post_tags() {        
        
        if ( 'post' === get_post_type() ) {
            
            $tags_list = get_the_tag_list('<ul class="grp post-tags---grp"><li class="item obj post-tag">', '</li><li class="item obj post-tag">', '</li></ul>');
            
            if ( $tags_list ) {
                
                
                
                // R: Post Tags Label
                $post_tags_label_obj = applicator_htmlok( array(
                    'name'      => 'Post Tags',
                    'structure' => array(
                        'type'      => 'object',
                        'subtype'   => 'generic label',
                    ),
                    'content'   => array(
                        'object' => array(
                            array(
                                'txt'   => 'Tags',
                            ),
                        ),
                    ),
                ) );
                
                
                // R: Tags
                $tags_cp = applicator_htmlok( array(
                    'name'      => 'Tags',
                    'structure' => array(
                        'type'      => 'component',
                    ),
                    'root_css'  => 'apl-tags',
                    'content'   => array(
                        'component' => $tags_list,
                    ),
                ) );
                
                
                // R: Post Tags
                $post_tags_cp = applicator_htmlok( array(
                    'name'      => 'Post Tags',
                    'structure' => array(
                        'type'      => 'component',
                    ),
                    'root_css'  => 'apl-post-tags',
                    'content'   => array(
                        'component' => array(
                            $post_tags_label_obj,
                            $tags_cp,
                        ),
                    ),
                ) );
                
                return $post_tags_cp;
            
            }
        }  
    }
}