<?php

/*
Custom Fields
__TLsc__urls (group of urls)
*/

/*
Shortcode
[__TLsc__render icon_size="30" icon_color="blue" socials="facebook,twitter,etc.."]
*/

class __TLsc__ {
  const PREFIX = '__TLsc__';

  private static $instance = null;

  public static function initialize_social_contact_shortcode() {
    if ( null == self::$instance )
      self::$instance = new self;
    return self::$instance;
  }

  private function __construct() {
    add_shortcode( self::PREFIX . 'render', array( $this, 'render' ) );
  }

  function get_socials( $valids ) {
    $links = get_field( self::PREFIX . 'urls', 'options' );
    $socials = array();

    if ( strpos( $valids, 'facebook' ) !== false )
      $socials[] = array(
        'anchor' => $links[ 'facebook' ],
        'icon' => 'fab fa-facebook'
      );
    if ( strpos( $valids, 'twitter' ) !== false )
      $socials[] = array(
        'anchor' => $links[ 'twitter' ],
        'icon' => 'fab fa-twitter'
      );
    if ( strpos( $valids, 'instagram' ) !== false )
      $socials[] = array(
        'anchor' => $links[ 'instagram' ],
        'icon' => 'fab fa-instagram'
      );
    if ( strpos( $valids, 'google_plus' ) !== false )
      $socials[] = array(
        'anchor' => $links[ 'google_plus' ],
        'icon' => 'fab fa-google-plus'
      );
    if ( strpos( $valids, 'pinterest' ) !== false )
      $socials[] = array(
        'anchor' => $links[ 'pinterest' ],
        'icon' => 'fab fa-pinterest'
      );
    if ( strpos( $valids, 'mail' ) !== false )
      $socials[] = array(
        'anchor' => $links[ 'mail' ],
        'icon' => 'fas fa-envelope'
      );

    return $socials;
  }

  function render( $atts ) {
    if ( !$atts )
      return false;

    wp_enqueue_style(
      self::PREFIX . 'style',
      get_template_directory_uri() . '/classes/social-contact/social-contact.css'
    );

    $socials = $this->get_socials( $atts[ 'socials' ] );
    $icon_width = $atts[ 'icon_width' ] ? $atts[ 'icon_width' ] : 50;
    $icon_color = $atts[ 'icon_color' ] ? $atts[ 'icon_color' ] : '#000';

    $output .= '<div class="' . self::PREFIX . 'wrapper">';
    foreach ( $socials as $social ) {
      $output .= '<a class="' . self::PREFIX . 'anchor" href="' . $social[ 'anchor' ] . '" target="_blank">';
      $output .= '<i class="' . $social[ 'icon' ] . ' ' . self::PREFIX . 'icon" style="font-size:' . $icon_width . 'px;margin:0 5px;color:' . $icon_color . ';"></i>';
      $output .= '</a>';
    }
    $output .= '</div>';

    echo $output;
  }

  function load_custom_fields() {
    if ( function_exists( 'acf_add_local_field_group' ) ) :
      acf_add_local_field_group(array(
      	'key' => 'group_5d0ca73f25bcf',
      	'title' => 'Social Contact',
      	'fields' => array(
      		array(
      			'key' => 'field_5d0ca7824de97',
      			'label' => 'Social Contact Urls',
      			'name' => self::PREFIX . 'urls',
      			'type' => 'group',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'layout' => 'block',
      			'sub_fields' => array(
      				array(
      					'key' => 'field_5d0ca7974de98',
      					'label' => 'Facebook',
      					'name' => 'facebook',
      					'type' => 'url',
      					'instructions' => '',
      					'required' => 0,
      					'conditional_logic' => 0,
      					'wrapper' => array(
      						'width' => '',
      						'class' => '',
      						'id' => '',
      					),
      					'default_value' => '',
      					'placeholder' => '',
      				),
      				array(
      					'key' => 'field_5d0ca7ac4de99',
      					'label' => 'Twitter',
      					'name' => 'twitter',
      					'type' => 'url',
      					'instructions' => '',
      					'required' => 0,
      					'conditional_logic' => 0,
      					'wrapper' => array(
      						'width' => '',
      						'class' => '',
      						'id' => '',
      					),
      					'default_value' => '',
      					'placeholder' => '',
      				),
      				array(
      					'key' => 'field_5d0ca7b34de9a',
      					'label' => 'Instagram',
      					'name' => 'instagram',
      					'type' => 'url',
      					'instructions' => '',
      					'required' => 0,
      					'conditional_logic' => 0,
      					'wrapper' => array(
      						'width' => '',
      						'class' => '',
      						'id' => '',
      					),
      					'default_value' => '',
      					'placeholder' => '',
      				),
      				array(
      					'key' => 'field_5d0ca7bd4de9b',
      					'label' => 'Pinterest',
      					'name' => 'pinterest',
      					'type' => 'url',
      					'instructions' => '',
      					'required' => 0,
      					'conditional_logic' => 0,
      					'wrapper' => array(
      						'width' => '',
      						'class' => '',
      						'id' => '',
      					),
      					'default_value' => '',
      					'placeholder' => '',
      				),
      				array(
      					'key' => 'field_5d0ca7c74de9c',
      					'label' => 'Mail (email)',
      					'name' => 'mail',
      					'type' => 'email',
      					'instructions' => '',
      					'required' => 0,
      					'conditional_logic' => 0,
      					'wrapper' => array(
      						'width' => '',
      						'class' => '',
      						'id' => '',
      					),
      					'default_value' => '',
      					'placeholder' => '',
      					'prepend' => '',
      					'append' => '',
      				),
      				array(
      					'key' => 'field_5d0ca7d24de9d',
      					'label' => 'Google Plus',
      					'name' => 'google_plus',
      					'type' => 'url',
      					'instructions' => '',
      					'required' => 0,
      					'conditional_logic' => 0,
      					'wrapper' => array(
      						'width' => '',
      						'class' => '',
      						'id' => '',
      					),
      					'default_value' => '',
      					'placeholder' => '',
      				),
      			),
      		),
      	),
      	'location' => array(
      		array(
      			array(
      				'param' => 'options_page',
      				'operator' => '==',
      				'value' => 'theme-settings',
      			),
      		),
      	),
      	'menu_order' => 0,
      	'position' => 'normal',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
      ) );
      endif;
  }
}
