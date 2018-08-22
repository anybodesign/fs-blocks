<?php defined('ABSPATH') or die();
/**
 * FS Porfolio Sub-navigation Walker for Main Menu
 *
 * @package WordPress
 * @subpackage FS_Porfolio
 * @since 1.0
 * @version 1.0
 */

class fs_subnav_walker extends Walker_Nav_Menu {

   function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
       
       $item_html = '';
       parent::start_el($item_html, $item, $depth, $args);

       if ( $item->is_dropdown ) {

           $item_html = str_replace( '</a>', '</a> <button class="sub-menu-unfold" aria-expanded="false"><span>'.__("Unfold Sub-Menu","fs-portfolio").'</span></button>', $item_html );
       
       }
       $output .= $item_html;
    }


    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {

        $element->is_dropdown = !empty( $children_elements[$element->ID] );

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}