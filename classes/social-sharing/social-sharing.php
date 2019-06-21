<?php

/*
Custom Fields
__TLsc__active (is active)
__TLsc__pages (pages to exclude)
__TLsc__icons (group of icons)
__TLsc__email (email to share)
*/

class __TLss__ {
  const PREFIX = '__TLss__';

  private static $instance = null;

  public static function initialize_social_sharing_shortcode() {
    if ( null == self::$instance )
      self::$instance = new self;
    return self::$instance;
  }

  private function __construct() {
    global $post;
    $this->object_id = $post->ID;
    $this->url = get_the_permalink( $this->object_id );
    $this->title = $post->post_title;
    $this->slug = $post->post_name;
    $this->active = get_field( self::PREFIX . 'active', 'options' ) ?
      get_field( self::PREFIX . 'active', 'options' ) :
      false;
    $this->invalids = get_field( self::PREFIX . 'pages', 'options' ) ?
      get_field( self::PREFIX . 'pages', 'options' ) :
      '';
    $this->list = get_field( self::PREFIX . 'icons', 'options' ) ?
      get_field( self::PREFIX . 'icons', 'options' ) :
      array();
    $this->email = get_field( self::PREFIX . 'email', 'options' ) ?
      get_field( self::PREFIX . 'email', 'options' ) :
      'daniel@thelaunch.tech';
  }


  function render( $width, $color ) {
    if ( !$this->active || !$this->is_valid() )
      return false;

    wp_enqueue_style(
      self::PREFIX . 'style',
      get_template_directory_uri() . '/classes/social-sharing/social-sharing.css'
    );

    $output = '';
    $icon_width = 30;
    $icon_color = '#000';
    $socials = $this->get_socials();

    if ( $atts ) {
      $icon_width = $width ? $width : $icon_width;
      $icon_color = $color ? $color : $icon_color;
    }

    $output .= '<div class="' . self::PREFIX . 'wrapper">';
    foreach ( $socials as $social ) {
      $output .= '<a class="' . self::PREFIX . 'anchor" href="' . $social[ 'anchor' ] . '" target="_blank">';
      $output .= '<i class="' . $social[ 'font_awesome_class' ] . '" style="font-size:' . $icon_width . 'px;margin:0 10px;color:' . $icon_color . ';"></i>';
      $output .= '</a>';
    }
    $output .= '</div>';

    echo $output;
  }

  function is_valid() {
    $current = false;
    if ( strlen( $this->invalids ) > 1 ) :
      $invalid_array = explode( ',', $this->invalids );
      foreach ( $invalid_array as $invalid ) {
        if (
          $invalid === $this->object_id ||
          $invalid === $this->title ||
          $invalid === $this->slug
        )
          $current = true;
      }
    else :
      $current = true;
    endif;
    return $current;
  }

  function get_socials() {
    $data = array();

    if ( in_array( 'facebook', $this->list ) )
      $data[] = array(
        'anchor' => 'https://www.facebook.com/sharer.php?u=' . $this->url,
        'font_awesome_class' => 'fab fa-facebook'
      );
    if ( in_array( 'twitter', $this->list ) )
      $data[] = array(
        'anchor' => 'https://twitter.com/intent/tweet?url=' . $this->url . '&text=' . $this->title,
        'font_awesome_class' => 'fab fa-twitter'
      );
    if ( in_array( 'mail', $this->list ) )
      $data[] = array(
        'anchor' => 'mailto:' . $this->email,
        'font_awesome_class' => 'fas fa-envelope'
      );
    if ( in_array( 'google_plus', $this->list ) )
      $data[] = array(
        'anchor' => 'https://plus.google.com/share?url=' . $this->url,
        'font_awesome_class' => 'fab fa-google-plus'
      );
    if ( in_array( 'linked_in', $this->list ) )
      $data[] = array(
        'anchor' => 'https://www.linkedin.com/shareArticle?url=' . $this->url . '&title=' . $this->title,
        'font_awesome_class' => 'fab fa-linkedin'
      );
    if ( in_array( 'reddit', $this->list ) )
      $data[] = array(
        'anchor' => 'https://reddit.com/submit?url=' . $this->url . '&title=' . $this->title,
        'font_awesome_class' => 'fab fa-reddit'
      );
    if ( in_array( 'blogger', $this->list ) )
      $data[] = array(
        'anchor' => 'https://www.blogger.com/blog-this.g?u=' . $this->url . '&n=' . $this->title,
        'font_awesome_class' => 'fab fa-blogger'
      );
    if ( in_array( 'yahoo', $this->list ) )
      $data[] = array(
        'anchor' => 'http://compose.mail.yahoo.com/?body=' . $this->url,
        'font_awesome_class' => 'fab fa-yahoo'
      );

    return $data;
  }

  function load_custom_fields() {
    if ( function_exists( 'acf_add_local_field_group' ) ) :
      acf_add_local_field_group( array(
      	'key' => 'group_5d01343747ce5',
      	'title' => 'Social Sharing',
      	'fields' => array(
      		array(
      			'key' => 'field_5d013447cfc03',
      			'label' => 'Is Active In General',
      			'name' => self::PREFIX . 'active',
      			'type' => 'true_false',
      			'instructions' => 'Overall Active Or Not',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'message' => '',
      			'default_value' => 0,
      			'ui' => 0,
      			'ui_on_text' => '',
      			'ui_off_text' => '',
      		),
      		array(
      			'key' => 'field_5d013469cfc04',
      			'label' => 'Pages To Exclude',
      			'name' => self::PREFIX . 'pages',
      			'type' => 'text',
      			'instructions' => 'Add ID, Title, or URL Slug of each page you want to exclude from sharing. Separate with comma.',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'default_value' => '',
      			'placeholder' => '123, Home Page, contact-us',
      			'prepend' => '',
      			'append' => '',
      			'maxlength' => '',
      		),
      		array(
      			'key' => 'field_5d0134c7cfc05',
      			'label' => 'Which Links Do You Want To Include?',
      			'name' => self::PREFIX . 'icons',
      			'type' => 'checkbox',
      			'instructions' => '',
      			'required' => 1,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'choices' => array(
      				'facebook' => 'facebook',
      				'twitter' => 'twitter',
      				'reddit' => 'reddit',
      				'blogger' => 'blogger',
      				'yahoo' => 'yahoo',
      				'linked_in' => 'linked_in',
      				'google_plus' => 'google_plus',
      				'mail' => 'mail',
      			),
      			'allow_custom' => 0,
      			'default_value' => array(
      				0 => 'facebook',
      				1 => 'twitter',
      				2 => 'reddit',
      				3 => 'blogger',
      				4 => 'yahoo',
      				5 => 'linked_in',
      				6 => 'google_plus',
      				7 => 'mail',
      			),
      			'layout' => 'vertical',
      			'toggle' => 1,
      			'return_format' => 'value',
      			'save_custom' => 0,
      		),
      		array(
      			'key' => 'field_5d01358ccfc07',
      			'label' => 'Social Sharing Personal Email',
      			'name' => self::PREFIX . 'email',
      			'type' => 'email',
      			'instructions' => 'For the "mail" sharing option.',
      			'required' => 1,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'default_value' => 'daniel@thelaunch.tech',
      			'placeholder' => 'daniel@thelaunch.tech',
      			'prepend' => '',
      			'append' => '',
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
