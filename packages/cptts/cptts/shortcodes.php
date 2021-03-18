<?php

if ( ! class_exists( 'Cptts_Shortcodes' ) ):

    class Cptts_Shortcodes {

        /**
         * Map
         *
         * @var array
         */
        private $shortcodes = array(
            'date_func' => 'date',
            'custom_button' => 'c_button',
            'blockquote_func' => 'blockquote',
            'clear_func'    => 'clear',
            'tabs_func'     => 'tabs',
            'tab_func'      => 'tab'
        );

        function get_shortcode_theme_part($part, $vars = array(), $content = '') {
            ob_start();
            get_theme_part($part, [
                'vars' => $vars,
                'content' => $content
            ]);
            return ob_get_clean();
        }
        /**
         * Get Shortcode theme part Example
         *
         * Example below - get content & atts inside page-columns.php 
         * $vars['desktop']
         * $content
         *
         */
/*        function columns_func($atts, $content) {
            shortcode_atts( array(
                'desktop'  => '10',
                'tablet'  => '10',
                'mobile'  => '12'
            ), $atts );
            return $this->get_shortcode_theme_part('page/shortcode/page-columns', $atts, $content);
        }
*/
        /**
         * Get Current Year
         */
        function date_func()
        {
            return date("Y");
        }

        function custom_button( $atts ) {
            shortcode_atts( array(
                'href'  => '#',
                'label' => __( 'Anchor', 'cptts' ),
            ), $atts );

            $href  = $atts['href'];
            $label = $atts['label'];

            return "<a href='$href' class='custom-btn'>$label</a>";
        }

        function blockquote_func( $atts, $content ) {
            shortcode_atts( array(
                'author'  => 'Name',
            ), $atts );

            $author  = $atts['author'];

            return "<blockquote class='blockquote--alt'><cite>$content</cite> <span class='author'>-$author</span></button>";
        }

        function clear_func() {
            return "<div class='clearfix'></div>";
        }

        function tabs_func( $atts, $content = null ) {
            shortcode_atts( array( 'titles' => '' ), $atts );

            $titles = explode( ",", $atts['titles'] );
            $html   = '<div class="tabs">';

            $html .= '<ul>';
            for ( $i = 1; $i <= count( $titles ); $i++ ) {
                $html .= '<li><a href="#tabs-' . $i . '" rel="tabs-' . $i . '">' . trim( $titles[ $i ] ) . '</a></li>';
            }

            $html .= '</ul>';
            $html .= do_shortcode( $content );
            $html .= '</div>';

            return $html;
        }

        function tab_func( $atts, $content = null ) {
            shortcode_atts( array(
                'id' => ''
            ), $atts );

            $html = '<div id="tabs-' . $atts['id'] . '">';
            $html .= do_shortcode( $content );
            $html .= '</div>';

            return $html;
        }

        /**
         * INTERNAL CLASS FUNCTIONALITY
         */

        /**
         * Cptts_Shortcodes constructor.
         */
        function __construct() {
            add_action( 'init', array( $this, 'create_shorcodes' ) );
        }

        /**
         * Registers all shortcodes defined in $this->shortcodes.
         */
        public function create_shorcodes() {
            foreach ( $this->shortcodes as $func => $name ) {
                add_shortcode( $name, array( $this, $func ) );
            }
        }
    }

    new Cptts_Shortcodes();

endif;
