<?php

class MyWalker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '<ul>';
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $classes = array();
        if( !empty( $item->classes ) ) {
            $classes = (array) $item->classes;
        }

        $active_class = '';
        if( in_array('current-menu-item', $classes) ) {
            $active_class = 'active';
        } else if( in_array('current-menu-parent', $classes) ) {
            $active_class = 'active-parent';
        } else if( in_array('current-menu-ancestor', $classes) ) {
            $active_class = 'active-ancestor';
        }

        $url = '';
        if( !empty( $item->url ) ) {
            $url = $item->url;
        }

        $output .= '<li class="navbar__link-wrapper '. $active_class . '"><a class="navbar__link" href="' . $url . '">' . $item->title . '</a></li>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= '</li>';
    }
}
