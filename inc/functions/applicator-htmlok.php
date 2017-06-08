<?php // Applicator HTML_OK (Overkill) Constructor-Component Structure

function htmlok( $args = array() ) {
    
    //------------ Requirements
    
    // Require Array
	if ( empty( $args ) ) {
		esc_html_e( 'Please define default parameters in the form of an array.', $GLOBALS['applicator_td'] );
	}
    
    // Require Name
	if ( empty( $args['name'] ) ) {
        esc_html_e( 'Name is required.', $GLOBALS['applicator_td'] );
	}
    
    //------------ Defaults
    
    $defaults = array(
        'name'          => '', // Name: Used in data-name="" and generating the parent-level CSS class name
        'root_css'    => '', // There's a generated parent css based on the 'name' and one can also add a custom
        'css'           => '', // This is a custom CSS that will apply to all structure elements
        'id'            => '', // Parent ID Attribute
        'content'       => '', // Content
        /*
        'content'       => array(
            'Content 1',
            'Content 2',
        ),
        */
        'hr_content'    => '', // Header Content
        'fr_content'    => '', // Footer Content
        'obj_content'   => '',
        /*
        'obj_content'   => array(
            array(
                'txt'   => '',
                'css'   => '',
                'sep'   => '',
                'line'  => array(
                    array(
                        array(
                            'txt'   => '',
                            'css'   => '',
                            'sep'   => '',
                        ),
                        'css'   => '',
                    ),
                ),
            ),
        ),
        */
        'structure'    => array(
            'type'      => '', // Constructor[Web Product, Web Product Start, Main Header, Main Content, Main Footer, Web Product End, Aside] | Module | Component[Generic, Navigation, Actions, Controls] | Object[Information, Label, Note, Form Label, Navigation Item, Action Item, Control Item]
            'subtype'       => '', // For Objects with specific subtypes like Heading | Navigation Item | Action Item | Generic | Anchor
            'elem'          => '', //
            'h_elem'        => '',
            'layout'        => '', // For Objects
            'hr_structure'  => false, //
            'attr'          => array(
                'title'     => '',
                'role'      => '', // Parent Role Attribute - required for main header, main content, main footer, <nav>, <aside>
                'datetime'  => '',
                'href'      => '',
                'h_level'   => '', // h1 | h2 | h3 | h4 | h5 | h6
                'linked'    => false,
            ),
        ),
        'version'       => '', // Version: to be able to supply new code in the same function
        'echo'          => false, // Echo: defaults to return
    );
    
    
    //------------ WordPress Parse Arguments
    $r = wp_parse_args( $args, $defaults );
    
    
    //------------ Regex Pattern and Replacement
    // Convert multiple spaces to single space
    $pat_space = '/\s\s+/';
    $rep_space = ' ';
    $pat_no_space = '/\s+/';
    $rep_no_space = '';
    
    
    //------------ Substring Count
    $substr_start = 0;
    $substr_end = 64;
    
    
    //------------ Term Variations
    $structure_constructor_term_variations = array( 'Constructor', 'constructor', 'cn', );
    $structure_module_term_variations = array( 'Module', 'module', 'md', );
    $structure_component_term_variations = array( 'Component', 'component', 'cp', );
    
    $structure_nav_term_variations = array( 'Navigation', 'Nav', 'n', );
    $structure_aside_term_variations = array( 'Aside', 'as', );
    $structure_object_term_variations = array( 'Object', 'obj', );
    
    $elem_header_term_variations = array( 'header', 'hr', );
    $elem_aside_term_variations = array( 'aside', 'as', );
    
    $obj_elem_anchor_term_variations = array( 'anchor', 'a', );
    
    $layout_block_term_variations = array( 'Block', 'block', 'b', );
    $layout_inline_term_variations = array( 'Inline', 'inline', 'i', );
    
    $structure_type_constructor_term_variations = array( 'Constructor', 'constructor', 'cn', );
    $structure_type_component_term_variations = array( 'Component', 'component', 'cp', );
    $structure_type_object_term_variations = array( 'Object', 'object', 'obj', );
    
    $structure_layout_block_term_variations = array( 'Block', 'block', 'div', );
    $structure_layout_inline_term_variations = array( 'Inline', 'inline', 'span', );
    
    $structure_elem_header_term_variations = array( 'Header', 'header', 'hr', );
    $structure_elem_footer_term_variations = array( 'Footer', 'footer', 'fr', );
    $structure_elem_aside_term_variations = array( 'Aside', 'aside', 'as', );
    $structure_elem_nav_term_variations = array( 'Navigation', 'Nav', 'nav', 'n', );
    
    $structure_subtype_glabel_term_variations = array( 'Generic Label', 'generic label', 'glabel', 'gl', );
    $structure_subtype_link_term_variations = array( 'Link', 'link', );
    $structure_subtype_heading_term_variations = array( 'Heading', 'heading', 'h', );
    $structure_subtype_wpg_term_variations = array( 'WordPress Generated Content', 'wordpress generated content', 'wpg', );
    
    $structure_obj_elem_generic_term_variations = array( 'Generic', 'generic', 'g', );
    $structure_obj_elem_anchor_term_variations = array( 'Anchor', 'anchor', 'a', );
    $structure_obj_elem_heading_term_variations = array( 'Heading', 'heading', 'h', );
    
    $heading_level_term_variations = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', );
    
    
    
    // Require Content
	if ( empty( $args['content'] ) && ! in_array( $args['structure']['type'], $structure_type_object_term_variations, true ) ) {
        esc_html_e( 'Content is required.', $GLOBALS['applicator_td'] );
	}
    
    
    
    //------------ Initialized Variables
    $name = '';
    
    
    $r_name = '';
    $r_structure_type = '';
    $r_structure_elem = '';
    $r_structure_layout = '';
    $r_structure_attr_href = '';
    $r_structure_subtype = '';
    $r_hr_structure = '';
    $hr_structure = '';
    $sanitized_name = '';
    $structure_type = '';
    $structure_subtype = '';
    $structure_type_css = '';
    $structure_subtype_css = '';
    $structure_subtype_abbr = '';
    $cssx = '';
    $id_attrx = '';
    $sanitized_id = '';
    $id = '';
    $role_attrx = '';
    $title_attr = '';
    $sanitized_structure_type = '';
    $sanitized_structure_subtype = '';
    $structure_type_css = '';
    $structure_subtype_css = '';
    $r_structure_attr_linked = '';
    $h_level_tag = '';
    $hr_content_val = '';
    $content_val = '';
    $contentx_val = '';
    $fr_content_val = '';
    $obj_content_val = '';
    $structure_attr_linked = '';
    $structure_elem = '';
    
    $layout_tag = 'div';
    $root_tagx = $layout_tag;
    $branch_tag = $layout_tag;
    
    $structure_name = '';
    $structure_css = '';
    $href_attr = '';
    $escaped_url = '';
    $href_attr = '';
    $target_attr = '';
    
    $structure_type = '';
    $structure_type_abbr = '';
    $branch_css = 'x';
    $h_level_tag = 'h2';
    
    $elem_label_tag = 'span';
    $h_elem_tag = 'div';
    $name = '';
    $root_css = '';
    $css_val = '';
    
    $obj_content_txt = '';
    $sanitized_obj_content_txt = '';
    
    $txt = '';
    $txt_css = '';
    $obj_content_css = '';
    
    $version = '';
    $echo = '';
    
    
    
    // Name
    if ( ! empty( $r['name'] ) ) {
        $r_name = preg_replace( $pat_space, $rep_space, trim( $r['name'] ) );
        $name = $r_name;
        $sanitized_name = substr( sanitize_title( $r_name ), $substr_start, $substr_end );
    }
    
    // Root CSS or Custom CSS placed at the root
    if ( ! empty( $r['root_css'] ) ) {
        $r_root_css = $r['root_css'];
    
        $root_css = '';
        foreach ( (array) $r_root_css as $val ) {
            $root_css .= ' '.preg_replace( $pat_space, $rep_space, trim( $val ) );
        }
    }
    
    // CSS or Custom CSS that will apply to all elements | If blank, use Sanitized Name
    if ( ! empty( $r['css'] ) ) {
        $r_css = $r['css'];
        $css = $r_css;
    
        $css_val = '';
        foreach ( (array) $css as $val ) {
            $css_val .= preg_replace( $pat_space, $rep_space, trim( $val ) );
        }
    }
    
    
    // Structure Elem
    if ( ! empty( $r['structure']['elem'] ) ) {
        $r_structure_elem = preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['elem'] ) );
        $structure_elem = $r_structure_elem;
    }
    
    // ID Attribute
    if ( ! empty( $r['id'] ) ) {
        $r_id = preg_replace( $pat_space, $rep_space, trim( $r['id'] ) );
        $id = $r_id;
        $sanitized_id = substr( sanitize_title( $id ), $substr_start, $substr_end );
        
        // Default
        $id_attrx = ' '.'id="'.$sanitized_id.'"';
        
        // Auto
        if ( 'AUTO' == $id ) {
            $id_attrx = ' '.'id="'.$sanitized_name.'"';
        }
    }
    
    // Structure Role
    if ( ! empty( $r['structure']['attr']['role'] ) ) {
        $r_structure_attr_role = preg_replace( $pat_space, $rep_space, trim( $r['structure']['attr']['role'] ) );
        $sanitized_structure_attr_role = substr( sanitize_title( $r_structure_attr_role ), $substr_start, $substr_end );
        
        // Default
        $role_attrx = ' '.'role="'.$sanitized_structure_attr_role.'"';
    }
    
    // Structure Subtype
    if ( ! empty( $r['structure']['subtype'] ) ) {
        $r_structure_subtype = preg_replace( $pat_space, $rep_space, trim( $r['structure']['subtype'] ) );
    }
    
    
    // Heading Element
    if ( ! empty( $r['structure']['h_elem'] ) ) {
        $r_structure_h_elem = preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['h_elem'] ) );
        $structure_h_elem = $r_structure_h_elem;
        $sanitized_structure_h_elem = substr( sanitize_title( $structure_h_elem ), $substr_start, $substr_end );
        
        if ( in_array( $structure_h_elem, $heading_level_term_variations, true ) ) {
            $h_elem_tag = $sanitized_structure_h_elem;
        }
    }
    
    
    // Header Structure
    if ( ! empty( $r['structure']['hr_structure'] ) ) {
        $r_structure_hr_structure = preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['hr_structure'] ) );
        $hr_structure = $r_structure_hr_structure;
    }
    
    // Structure Type
    if ( ! empty( $r['structure']['type'] ) ) {
        $r_structure_type = preg_replace( $pat_space, $rep_space, trim( $r['structure']['type'] ) );
        $structure_type = $r_structure_type;
        
        //------------------------ Constructor
        if ( in_array( $structure_type, $structure_type_constructor_term_variations, true ) ) {
            $structure_type_abbr = 'CN';
            
            // Header Element
            if ( in_array( $structure_elem, $structure_elem_header_term_variations, true ) ) {
                $root_tagx = 'header';
            }
            
            // Footer Element
            if ( in_array( $structure_elem, $structure_elem_footer_term_variations, true ) ) {
                $root_tagx = 'footer';
            }
            
            // Aside Element
            if ( in_array( $structure_elem, $structure_elem_aside_term_variations, true ) ) {
                $root_tagx = 'aside';
                $role_attrx = ' '.'role="complementary"';
            }
        
            $structure_name = $name.' '.$structure_type_abbr;
            $sanitized_structure_type = substr( sanitize_title( $structure_type_abbr ), $substr_start, $substr_end );
            
            $structure_type_css = $sanitized_structure_type;
            
            if ( ! empty( $css ) ) {
                $cssx = ' '.$css_val;
            } else {
                $cssx = ' '.$sanitized_name;
            }
        
        //------------------------ Component
        } elseif ( in_array( $structure_type, $structure_type_component_term_variations, true ) ) {
            $structure_type_abbr = 'CP';
            
            // Header Element
            if ( in_array( $structure_elem, $structure_elem_header_term_variations, true ) ) {
                $root_tagx = 'header';
            }
            
            // Footer Element
            elseif ( in_array( $structure_elem, $structure_elem_footer_term_variations, true ) ) {
                $root_tagx = 'footer';
            }
            
            // Aside Element
            elseif ( in_array( $structure_elem, $structure_elem_aside_term_variations, true ) ) {
                $root_tagx = 'aside';
                $role_attrx = ' '.'role="complementary"';
            }
            
            // Nav Element
            elseif ( in_array( $structure_elem, $structure_elem_nav_term_variations, true ) ) {
                $root_tagx = 'nav';
                $role_attrx = ' '.'role="navigation"';
                $h_elem_tag = 'h2';
            } else {
                
            }
        
            $structure_name = $name.' '.$structure_type_abbr;
            $sanitized_structure_type = substr( sanitize_title( $structure_type_abbr ), $substr_start, $substr_end );
            
            $structure_type_css = $sanitized_structure_type;
            
            if ( ! empty( $css ) ) {
                $cssx = ' '.$css_val;
            } else {
                $cssx = ' '.$sanitized_name;
            }
            
        //------------------------ Object
        } elseif ( in_array( $structure_type, $structure_type_object_term_variations, true ) ) {
            $structure_type_abbr = 'OBJ';
            
            // Layout
            if ( ! empty( $r['structure']['layout'] ) ) {
                $r_structure_layout = preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['layout'] ) );
                
                // Inline Layout
                if ( in_array( $r_structure_layout, $structure_layout_inline_term_variations, true ) ) {
                    $layout_tag = 'span';
                }
                
                $root_tagx = $layout_tag;
                $branch_tag = $layout_tag;
                $elem_label_tag = $layout_tag;
            }

            // Href Attribute
            if ( ! empty( $r['structure']['attr']['href'] ) ) {
                $r_structure_attr_href = preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['attr']['href'] ) );
                $escaped_url = esc_url( $r_structure_attr_href );

                $href_attr = ' '.'href="'.$r_structure_attr_href.'"';
            }

            // Target Attribute
            if ( ! empty( $r['structure']['attr']['target'] ) ) {
                $r_structure_attr_target = preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['attr']['target'] ) );

                // Default
                $target_attr = ' '.'target="'.$r_structure_attr_target.'"';
            }
            
            // Linked Attribute
            if ( ! empty( $r['structure']['attr']['linked'] ) ) {
                $r_structure_attr_linked = preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['attr']['linked'] ) );
                $structure_attr_linked = $r_structure_attr_linked;
            }
            
            
            //------------------------ Object Subtypes
            
            // Subtype: Generic Label
            if ( in_array( $r_structure_subtype, $structure_subtype_glabel_term_variations, true ) ) {
                $structure_subtype = 'Generic Label';
                $structure_subtype_abbr = 'glabel';
                $branch_css = 'g';
            }
            
            // Subtype: Link
            elseif ( in_array( $r_structure_subtype, $structure_subtype_link_term_variations, true ) ) {
                $structure_subtype = 'Link';
                $structure_subtype_abbr = 'link';
            }
            
            // Subtype: Heading
            elseif ( in_array( $r_structure_subtype, $structure_subtype_heading_term_variations, true ) ) {
                $structure_subtype = 'Heading';
                $structure_subtype_abbr = 'heading';
                $branch_css = 'h';
            }
            
            // Subtype: WordPress Generated Content
            elseif ( in_array( $r_structure_subtype, $structure_subtype_wpg_term_variations, true ) ) {
                $structure_subtype = 'WordPress Generated';
                $structure_subtype_abbr = 'wpg';
                $branch_css = 'wpg';
            }
            
            // Subtype: Generic Label
            else {
                $structure_subtype = 'Generic';
                $branch_css = 'g';
            }
            
            // End: Object Subtypes
            
            
            //------------------------ Object Elements
            
            // Element: Anchor Element
            if ( in_array( $structure_elem, $structure_obj_elem_anchor_term_variations, true ) ) {
                $branch_tag = 'a';
                $branch_css = $branch_tag;
            
            // Element: Heading Element
            } elseif ( in_array( $structure_elem, $structure_obj_elem_heading_term_variations, true ) ) {
                $branch_tag = $h_level_tag;
                $branch_css = 'h';

                // Heading Level Attribute
                if ( ! empty( $r['structure']['attr']['h_level'] ) ) {
                    $r_structure_attr_h_level = preg_replace( $pat_no_space, $rep_no_space, trim( $r['structure']['attr']['h_level'] ) );
                    $sanitized_h_level = substr( sanitize_title( $r_structure_attr_h_level ), $substr_start, $substr_end );
                    $h_level_tag = $sanitized_h_level;

                    if ( in_array( $r_structure_attr_h_level, $heading_level_term_variations, true ) ) {
                        $layout_tag = 'div';

                        $root_tagx = $layout_tag;
                        $branch_tag = $h_level_tag;
                    }
                }
            
            // Element: Generic
            } else {
                $branch_css = 'g';
            }
            
            // End: Object Elements
        
            $structure_name = $name.' '.$structure_subtype.' '.$structure_type_abbr;
            $sanitized_structure_type = substr( sanitize_title( $structure_type_abbr ), $substr_start, $substr_end );
            $sanitized_structure_subtype = substr( sanitize_title( $structure_subtype_abbr ), $substr_start, $substr_end );
            
            $structure_type_css = $sanitized_structure_type;
            $structure_subtype_css = ' '.$sanitized_structure_subtype;
            
            if ( ! empty( $css ) ) {
                $cssx = ' '.$css_val.'-'.$structure_type_css;
            } else {
                $cssx = ' '.$sanitized_name.'-'.$sanitized_structure_subtype.'-'.$sanitized_structure_type;
            }
            
            
        }
            
        // Variable Definitions
        if ( empty( $name ) ) {
            $name = $structure_type;
        }
    }
    
    // Structure Title
    if ( ! empty( $r['structure']['attr']['title'] ) ) {
        $r_structure_attr_title = preg_replace( $pat_space, $rep_space, trim( $r['structure']['attr']['title'] ) );
        
        // Default
        $title_attr = ' '.'title="'.$r_structure_attr_title.'"';
        
        // Auto
        if ( 'AUTO' == $r_structure_attr_title ) {
            $title_attr = ' '.'title="'.$structure_name.'"';
        }
    }
    
    
    // Header
    if ( $r['hr_content'] ) {
        $r_hr_content = $r['hr_content'];
        $hr_content = $r_hr_content;
        
        $hr_content_val = '';
        foreach ( ( array ) $hr_content as $val ) {
            $hr_content_val .= preg_replace( $pat_space, $rep_space, trim( $val ) );
        }
    }
    
    // Content
    if ( ! empty( $r['content'] ) ) {
        $r_content = $r['content'];
        $content = $r_content;
        
        $content_val = '';
        foreach ( ( array ) $content as $val ) {
            $content_val .= preg_replace( $pat_space, $rep_space, trim( $val ) );
        }
    }
    
    // Footer Content
    if ( ! empty( $r['fr_content'] ) ) {
        $r_fr_content = $r['fr_content'];
        $fr_content = $r_fr_content;
        
        $fr_content_val = '';
        foreach ( ( array ) $fr_content as $val ) {
            $fr_content_val .= preg_replace( $pat_space, $rep_space, trim( $val ) );
        }
    }
    
    // Object Content
    if ( ! empty( $r['obj_content'] ) ) {
        $r_obj_content = $r['obj_content'];
        $obj_content = $r_obj_content;
        
        $obj_content_val = '';
        foreach ( ( array ) $obj_content as $val ) {
                
            $txt = '';
            $txt_auto_css = '';
            $txt_css = '';
            $txt_sep = '';
            
            // Array Input: Text Content
            if ( ! empty( $val['txt'] ) ) {
                $r_obj_content_txt = preg_replace( $pat_space, $rep_space, trim( $val['txt'] ) );
                $obj_content_txt = $r_obj_content_txt;
                $sanitized_txt = substr( sanitize_title( $obj_content_txt ), $substr_start, $substr_end );
                
                $txt = $obj_content_txt;
                $txt_auto_css = ' '.$sanitized_txt.'---txt';
                
                // If Text Content is numeric
                if ( is_numeric( $obj_content_txt[0] ) ) {
                    $txt_auto_css = ' '.'num'.' '.'n-'.$sanitized_txt.'---txt';
                }
                
                // Array Input: CSS
                if ( ! empty( $val['css'] ) ) {
                    $r_obj_content_css = preg_replace( $pat_space, $rep_space, trim( $val['css'] ) );
                    $obj_content_css = $r_obj_content_css;
                    $txt_css = ' '.$obj_content_css.'---txt';
                }
                
                // Array Input: Separator
                if ( ! empty( $val['sep'] ) ) {
                    $r_obj_content_sep = preg_replace( $pat_space, $rep_space, $val['sep'] );
                    $obj_content_sep = $r_obj_content_sep;
                    $txt_sep = $obj_content_sep;
                }
                
                $obj_content_val .= $txt_sep.'<span class="txt'.$txt_css.$txt_auto_css.'">'.$txt.'</span>';
                
                if ( ! empty( $val['line'] ) ) {
                    
                    $r_obj_content_line = $val['line'];
                    $obj_content_line = $r_obj_content_line;
                    
                    foreach ( (array) $val['line'] as $line_val ) {
                        
                        $line_val_css = '';
                        $line_val_auto_css = '';
                        
                        if ( ! empty( $line_val[0]['txt'] ) ) {
                            $r_line_val_txt = preg_replace( $pat_space, $rep_space, trim( $line_val[0]['txt'] ) );
                            $line_val_txt = $r_line_val_txt;
                            $sanitized_line_val_txt = substr( sanitize_title( $line_val_txt ), $substr_start, $substr_end );
                            
                            $line_val_auto_css = ' ' . $sanitized_line_val_txt.'---line';
                            
                            if ( is_numeric( $line_val_txt[0] ) ) {
                                $line_val_auto_css = ' '.'n-'.$sanitized_line_val_txt.'---line';
                            }
                            
                            if ( ! empty( $line_val['css'] ) ) {
                                $r_line_val_css = preg_replace( $pat_space, $rep_space, trim( $line_val['css'] ) );
                                $line_val_css = ' '.$r_line_val_css;
                            }
                        }

                        $obj_content_val .= '<span class="line'.$line_val_css.$line_val_auto_css.'">';
                        
                        foreach ( (array) $line_val as $line_txt_val ) {
                        
                            $txt = '';
                            $txt_auto_css = '';
                            $txt_css = '';
                            $txt_sep = '';

                            // Array Input: Text Content
                            if ( ! empty( $line_txt_val['txt'] ) ) {
                                $r_obj_content_line_txt = preg_replace( $pat_space, $rep_space, trim( $line_txt_val['txt'] ) );
                                $obj_content_line_txt = $r_obj_content_line_txt;
                                $sanitized_line_txt = substr( sanitize_title( $obj_content_line_txt ), $substr_start, $substr_end );

                                $txt = $obj_content_line_txt;
                                $txt_auto_css = ' '.$sanitized_line_txt.'---txt';

                                // If Text Content is numeric
                                if ( is_numeric( $obj_content_line_txt[0] ) ) {
                                    $txt_auto_css = ' '.'num'.' '.'n-'.$sanitized_line_txt.'---txt';
                                }

                                // Array Input: CSS
                                if ( ! empty( $line_txt_val['css'] ) ) {
                                    $r_obj_content_line_css = preg_replace( $pat_space, $rep_space, trim( $line_txt_val['css'] ) );
                                    $obj_content_line_css = $r_obj_content_line_css;
                                    $txt_css = ' '.$obj_content_line_css;
                                }

                                // Array Input: Separator
                                if ( ! empty( $line_txt_val['sep'] ) ) {
                                    $r_obj_content_line_sep = preg_replace( $pat_space, $rep_space, $line_txt_val['sep'] );
                                    $obj_content_line_sep = $r_obj_content_line_sep;
                                    $txt_sep = $obj_content_line_sep;
                                }

                                $obj_content_val .= $txt_sep.'<span class="txt'.$txt_auto_css.$txt_css.'">'.$txt.'</span>';

                            }
                            
                        }
                        
                        $obj_content_val .= '</span>';
                        
                    }
                }
            
            // Usually used with Subtype: WordPress Generated Content
            } else {
                
                $obj_content_val .= $val;
            
            }
        }
    }
    
    
    // Version
    if ( ! empty( $r['version'] ) ) {
        $r_version = preg_replace( $pat_space, $rep_space, trim( $r['version'] ) );
        $version = $r_version;
    }
    
    
    // Echo
    if ( ! empty( $r['echo'] ) ) {
        $r_echo = preg_replace( $pat_space, $rep_space, trim( $r['echo'] ) );
        $echo = $r_echo;
    }
    
    
    // Container Markup Structure
    $cr_mu    = '';
    $cr_mu_start    = '';
    $cr_mu_end      = '';
    
    $cr_mu_start   .= '<div class="%1$s'.$cssx.'---%1$s">';
    $cr_mu_start   .= '<div class="%1$s_cr'.$cssx.'---%1$s_cr">';
    
    $cr_mu_end      = '</div>';
    $cr_mu_end     .= '</div>';
        
    
    // Header Markup
    $hr_mu = '';
    $hr_mu .= sprintf( $cr_mu_start,
        'hr'
    );
    $hr_mu .= '<'.$h_elem_tag.' class="h'.$cssx.'---h"><span class="h_l'.$cssx.'---h_l">'.$name.'</span></'.$h_elem_tag.'>';
    $hr_mu .= $hr_content_val;
    $hr_mu .= $cr_mu_end;

    // Content Markup
    $ct_mu = '';
    $ct_mu .= sprintf( $cr_mu_start,
        'ct'
    );
    $ct_mu .= $content_val;
    $ct_mu .= $cr_mu_end;

    // Footer Markup
    $fr_mu = '';
    $fr_mu .= sprintf( $cr_mu_start,
        'fr'
    );
    $fr_mu .= $fr_content_val;
    $fr_mu .= $cr_mu_end;
    
    
    //------------ New Version
    if ( '0.1' == $version ) {
        
        // Initialize
        $output = '';
    
    //------------ Original Version    
    } else {
        
        // Initialize
        $output = '';
        
        $output .= '<'.$root_tagx.$id_attrx.' class="'.$structure_type_css.$structure_subtype_css.$cssx.$root_css.'" '.$role_attrx.$title_attr.' data-name="'.$structure_name.'">';
        
        
        //------------ Constructor, Module, Component Structure Types
        if ( ! in_array( $structure_type, $structure_type_object_term_variations, true ) ) {
            
            $output .= '<'.$branch_tag.' class="cr'.$cssx.'---cr" '.$href_attr.'>';
            
            // Header Content
            if ( $hr_structure || ! empty( $hr_content ) || ! empty( $r_structure_h_elem ) || in_array( $structure_elem, $structure_elem_nav_term_variations, true ) ) {
                $output .= $hr_mu;
            }
            
            // Main Content
            if ( ! empty( $content ) ) {
                $output .= $ct_mu;
            }
            
            // Footer Content
            if ( ! empty( $fr_content ) ) {
                $output .= $fr_mu;
            }
            
            $output .= '</'.$branch_tag.'>';
            
        }
        
        //------------ Object Structure Type
        else {
            
            if ( ! in_array( $r_structure_subtype, $structure_subtype_wpg_term_variations, true ) ) {
            
                // Anchor Markup
                $a_mu = '';
                $a_mu .= '<a class="a'.$cssx.'---a" '.$href_attr.$target_attr.'>';
                $a_mu .= '<span class="a_l'.$cssx.'---a_l">';
                $a_mu .= $obj_content_val;
                $a_mu .= '</span>';
                $a_mu .= '</a>';

                if ( ! in_array( $r_structure_subtype, $structure_subtype_link_term_variations, true ) ) {
                    $output .= '<'.$branch_tag.' class="'.$branch_css.$cssx.'---'.$branch_css.'">';
                }

                if ( $structure_attr_linked || in_array( $r_structure_subtype, $structure_subtype_link_term_variations, true ) ) {
                    $output .= $a_mu;
                } else {
                    $output .= '<'.$elem_label_tag.' class="'.$branch_css.'_l'.$cssx.'---'.$branch_css.'_l">';

                    // Text Content
                    if ( ! empty( $obj_content ) ) {
                        $output .= $obj_content_val;
                    }

                    $output .= '</'.$elem_label_tag.'>';
                }

                if ( !in_array( $r_structure_subtype, $structure_subtype_link_term_variations, true ) ) {
                    $output .= '</'.$branch_tag.'>';
                }
            } else {
                $output .= $obj_content_val;
            }
        }
        
        $output .= '</'.$root_tagx.'><!-- '.$structure_name.' -->';
    
    }
    
    $html = apply_filters( 'htmlok', $output, $args );
    
    if ( $echo ) {
        echo $html;
    } else {
        return $html;
    }
    
}