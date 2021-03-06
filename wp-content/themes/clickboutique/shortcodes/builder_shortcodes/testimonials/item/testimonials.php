<?php
/**
 * @version    $Id$
 * @package    IG Pagebuilder
 * @author     InnoGearsTeam <support@TI.com>
 * @copyright  Copyright (C) 2012 TI.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.TI.com
 * Technical Support:  Feedback - http://www.TI.com
 */
if ( ! class_exists( 'IG_Item_Testimonials' ) ) {

	class IG_Item_Testimonials extends IG_Pb_Shortcode_Child {

		public function __construct() {
			parent::__construct();
		}

		/**
		 * DEFINE configuration information of shortcode
		 */
		public function element_config() {
			$this->config['shortcode'] = strtolower( __CLASS__ );
			$this->config['exception'] = array(
				'data-modal-title' => __( 'Testimonials Item',  'plumtree' )
			);
            $this->config['edit_using_ajax'] = true;
		}

		/**
		 * DEFINE setting options of shortcode
		 */
		public function element_items() {
			$this->items = array(
				'Notab' => array(

					array(
						'name'  => __( 'Heading',  'plumtree' ),
						'id'    => 'heading',
						'type'  => 'text_field',
						'class' => 'jsn-input-xxlarge-fluid',
						'role'  => 'title',
						'std'   => __( IG_Pb_Utils_Placeholder::add_placeholder( 'Testimonials Item %s', 'index' ),  'plumtree' ),
                        'tooltip' => __( 'Set the text of your heading items',  'plumtree' ),
					),

                    array(
                        'name'    => __( 'Image File',  'plumtree' ),
                        'id'      => 'image_file',
                        'type'    => 'select_media',
                        'std'     => '',
                        'class'   => 'jsn-input-large-fluid',
                        'tooltip' => __( 'Select background image for item',  'plumtree' )
                    ),

					array(
						'name' => __( 'Body',  'plumtree' ),
						'id'   => 'body',
						'role' => 'content',
						'type' => 'editor',
						'std'  => IG_Pb_Helper_Type::lorem_text(),
                        'tooltip' => __( 'Set content of element',  'plumtree' ),
					),

                    array(
                        'name'  => __( 'Signature',  'plumtree' ),
                        'id'    => 'sign',
                        'type'  => 'text_field',
                        'class' => 'jsn-input-xxlarge-fluid',
                        'role'  => 'title',
                        'std'   => '',
                        'tooltip' => __( 'Set the text items',  'plumtree' ),
                    ),

				)
			);
		}

		/**
		 * DEFINE shortcode content
		 *
		 * @param type $atts
		 * @param type $content
		 */
		public function element_shortcode_full( $atts = null, $content = null ) {
			extract( shortcode_atts( $this->config['params'], $atts ) );
			$content_class = ! empty( $image_file ) ? 'carousel-caption' : 'carousel-content';
			$hidden        = ( empty( $heading ) && empty( $content) ) ? 'style="display:none"' : '';
			$img           = ! empty( $image_file ) ? "<div class='test-image'><img src='{$image_file}'  alt='{$heading}' /></div>" : '';
			$inner_content = IG_Pb_Helper_Shortcode::remove_autop( $content );
			return "
				<li class='test-item'>
						{$img}<div class=\"t-cont\">{$inner_content}<div class=\"t-sign\">{$sign}</div></div>
				</li><!--seperate-->";
		}

	}

}
