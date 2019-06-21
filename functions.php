<?php

class __TL__ {
	const PREFIX = '__TL__';
	const LANG = 'the-launch';
	const VERSION = '1';

  private static $instance = null;

  public static function initialize() {
    if ( null == self::$instance )
      self::$instance = new self;
    return self::$instance;
  }

  private function __construct() {
		$this->ASSETS = get_template_directory_uri() . '/assets/';
		$this->CLASSES = get_template_directory() . '/classes/';
		$this->HELPERS = get_template_directory() . '/helpers/';

		require $this->HELPERS . 'configure-acf.php';
		require $this->HELPERS . 'template-tags.php';
    require $this->HELPERS . 'disable-gutenberg.php';

		require $this->CLASSES . 'social-contact/social-contact.php';
		require $this->CLASSES . 'social-sharing/social-sharing.php';

		add_action( 'after_setup_theme', array( $this, self::PREFIX . 'setup' ) );
		add_action( 'after_setup_theme', array( $this, self::PREFIX . 'low_priority_setup' ), 0 );
		add_action( 'widgets_init', array( $this, self::PREFIX . 'widgets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, self::PREFIX . 'scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, self::PREFIX . 'styles' ) );

		$SOCIAL_CONTACT = __TLsc__::initialize_social_contact_shortcode();
		$SOCIAL_CONTACT->load_custom_fields();
		if ( is_admin() ) :
			$SOCIAL_SHARING = __TLss__::initialize_social_sharing_shortcode();
			$SOCIAL_SHARING->load_custom_fields();
		endif;
	}

	function __TL__setup() {
		load_theme_textdomain( self::LANG, get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary', self::LANG ),
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'customize-selective-refresh-widgets' );
	}

	function __TL__low_priority_setup() {
		$GLOBALS['content_width'] = apply_filters( self::PREFIX . 'content_width', 1170 );
	}

	function __TL__widgets() {
		register_sidebar( array(
			'name'          => esc_html__( 'Default Sidebar', self::LANG ),
			'id'            => self::PREFIX . 'default-sidebar',
			'description'   => esc_html__( 'Add widgets here.', self::LANG ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title ' . self::PREFIX . 'widget">',
			'after_title'   => '</h4>',
		) );
	}

	function __TL__scripts() {
		wp_enqueue_script( self::PREFIX . 'focus-fix-script', $this->ASSETS . 'js/skip-link-focus-fix.js', array(), self::VERSION, true );
		wp_enqueue_script( self::PREFIX . 'animejs-script', $this->ASSETS . 'js/anime.min.js', array(), self::VERSION, true );
		wp_enqueue_script( self::PREFIX . 'aos-script', $this->ASSETS . 'js/aos.js', array(), self::VERSION, true );
		wp_enqueue_script( self::PREFIX . 'scroll-top-script', $this->ASSETS . 'js/scroll-top.js', array( 'jquery' ), self::VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	}

	function __TL__styles() {
		wp_enqueue_style( self::PREFIX . 'style', get_stylesheet_uri() );
		wp_enqueue_style( self::PREFIX . 'font-awesome-style', 'https://use.fontawesome.com/releases/v5.7.1/css/all.css' );
		wp_enqueue_style( self::PREFIX . 'general-style', $this->ASSETS . 'css/general.css' );
		wp_enqueue_style( self::PREFIX . 'aos-style', $this->ASSETS . 'css/aos.css' );
	}
}

__TL__::initialize();
