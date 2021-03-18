<?php
/**
 * Block
 * This class collects Block functionalities.
 */
class Block {
	private $_block = null;

	public function __construct( $block ) {
		$this->_block = $block;
	}

	/**
	 * Generate Block class
	 *
	 * @return string
	 */
	public function block_class( $custom = '' ) {
		$class = 'acf-block';
        $class .= ' block-' . str_replace( 'acf/', '', $this->_block['name'] );

		if ( ! empty( $custom ) ) {
			$class .= ' ' . $custom;
		}

		if ( isset( $this->_block['align'] ) ) {
			$class .= ' align' . $this->_block['align'];
		}

		if ( isset( $this->_block['className'] ) ) {
			$class .= ' ' . $this->_block['className'];
		}

		return $class;
	}
	
	/**
	 * Generate Block Container class
	 *
	 * @return string
	 */
	public function container_class( $custom = '' ) {
		$class = "container";
		if ( ! empty( $custom ) ) {
			$class .= ' ' . $custom;
		}

		if ( isset( $this->_block['align'] ) ) {
			$class .= ' container--' . $this->_block['align'];
		}
		
		return $class;
	}

	/**
	 * Check if block exists on current page
	 *
	 * @return string
	 */
	public static function if_block_exists( $block, $check_class = true  ) {
		if (!$block) {
			return false;
		}
		$post_id = get_the_ID();

		if (is_home()) {
			$post_id = get_option('page_for_posts') ?: get_the_ID();
		}

		$p = get_post($post_id);

		if (empty($p)) {
			return;
		}
		
		if ($check_class) {
			preg_match( "/$block/", get_filtered_content($p), $matches );
			$cond = !empty($matches) ? true : false;
			return $cond;
		} else {
			return has_block($block, $p);
		}
	}

    public function block_name() {
        return $this->_block['name'];
    }
}
