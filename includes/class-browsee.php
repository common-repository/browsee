<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Browsee {

	public function __construct()
	{
		
	}

	public function init() 
	{
		$this->init_admin();
    	$this->enqueue_script();
    	$this->enqueue_admin_styles();
	}

	public function init_admin() {
		register_setting( 'browsee', 'browsee_project_key' );
    	add_action( 'admin_menu', array( $this, 'create_nav_page' ) );
	}

	public function create_nav_page() {
		add_options_page(
		  esc_html__( 'Browsee', 'browsee' ), 
		  esc_html__( 'Browsee', 'browsee' ), 
		  'manage_options',
		  'browsee_settings',
		  array($this,'admin_view')
		);
	}

	public static function admin_view()
	{
		require_once plugin_dir_path( __FILE__ ) . '/../admin/views/settings.php';
	}

	public static function browsee_script()
	{
		$browsee_project_key = get_option( 'browsee_project_key' );
		$is_admin = is_admin();

		$browsee_project_key = trim($browsee_project_key);
		if (!$browsee_project_key) {
			return;
		}

		if ( $is_admin ) {
			return;
		}

		echo "
    <script>
    window._browsee = window._browsee || function () { (_browsee.q = _browsee.q || []).push(arguments) };
    _browsee('init', '$browsee_project_key');
    </script>
    <script async src='https://cdn.browsee.io/js/browsee.min.js'></script>
		<script>
		</script>
		";
	}

	private function enqueue_script() {
		add_action( 'wp_footer', array($this, 'browsee_script') );
	}

  private function enqueue_admin_styles() {
      add_action( 'admin_enqueue_scripts', array($this, 'browsee_admin_styles' ) );
  }

  public static function browsee_admin_styles() {
      wp_register_style( 'browsee_custom_admin_style', plugins_url( '../admin/static/browsee-admin.css', __FILE__ ), array(), '20190701', 'all' );
      wp_enqueue_style( 'browsee_custom_admin_style' );
  }

}

?>
