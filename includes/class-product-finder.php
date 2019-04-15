<?php
/**
 * Product Finder
 * Main Product finder plugin class.
 * @author  Dharma Raj Gurung < gurungdrg30@gmail.com >
 * @since 1.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Main Class
 */
class PF_Finder {

	/**
	 * Version
	 *
	 * @var string
	 */
	public $version = '1.0';
	/**
	 * The single instance of the class
	 *
	 */
	protected static $_instance = null;
	/**
	 * Main Instance
	 * @return Main instance
	 *
	*/
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	* Class Constructor
	* Loads default options
	* @author Dharma Raj Gurung
    * @since 1.0
	*/
	public function __construct() {
		$this->constants();
		$this->init_hooks();
		$this->includes();
	}
	/**********************
	    Define Constants.
	***********************/
	private function constants() {
		// Plugin Base Path.
		if ( ! defined( 'PF_ABSPATH' ) ) {
			define( 'PF_ABSPATH', dirname( PF_PLUGIN_FILE ) . '/' );
		}
		if ( ! defined( 'PF_TEMPLATE_URL' ) ) {
            define( 'PF_TEMPLATE_URL', plugin_dir_url( PF_PLUGIN_FILE ).'templates/' );
        }
	}
	/*************************************
	 	Hook into actions and filters.
	**************************************/
	private function init_hooks() {
		add_action ( 'wp_head', array( $this, 'product_finder_js_variables'),30 );
		
		add_action( 'product_finder', 'product_finder_template', 10);
		add_action( 'product_finder_list', 'product_finder_list_template', 10,4);
		add_action( 'product_finder_list_more', 'product_finder_list_more_template', 10,4);
		add_action( 'product_finder_list_prev', 'product_finder_list_prev_template', 10,4);


		add_action( 'product_list', 'product_list_template', 10,2);
		add_shortcode('PRODUCT_FINDER', 'product_finder');
	}

	/*************************************************************
	  Include required core files used in admin and on the frontend.
	***************************************************************/
	public function includes() {
		//Product finder - Admin
		include_once( PF_ABSPATH . 'admin/product-finder-taxonomy.php' );
		include_once( PF_ABSPATH . 'admin/product-finder-meta.php' );
		include_once( PF_ABSPATH . 'admin/product-finder-texonomy-image.php' );
		//Product finder - Frontend
		include_once( PF_ABSPATH . 'includes/product-finder-frontend-style.php' );
		include_once( PF_ABSPATH . 'includes/product-finder-frontend-script.php' );
		include_once( PF_ABSPATH . 'includes/product-finder-shortcode.php');
		include_once( PF_ABSPATH . 'includes/product-finder-function.php');
		include_once( PF_ABSPATH . 'includes/product-finder-action.php');
	}

	function product_finder_js_variables(){ 
		?>
		<script type="text/javascript">
		    var pf_ajax_url =  <?php echo json_encode(admin_url( "admin-ajax.php" ) ); ?>; 
		    var pf_loader =  <?php echo json_encode(PF_TEMPLATE_URL.'img/page-loading.gif'); ?>; 
		</script>
		<?php
	}

	/**
	 * Recursively get taxonomy hierarchy
	 */
	public function get_pf_hierarchy( $taxonomy, $parent) {

		$terms = get_terms( $taxonomy, array('parent' => $parent) );
		$children = array();
		foreach( $terms as $term ) {
			$term->children = $this->get_pf_hierarchy( $taxonomy, $term->term_id );
			$children[] = $term;
		}
		return $children;
	}

	public function children_count($data) {
    	$count1 = 0;
    	$i=1;
		foreach($data as $array) {
			if($i==1){
			    $count = 0;
			    if (isset($array->children)) {
			      	$count += count($array->children);
			      	$count += $this->children_count($array->children);
			    }
			    $array->children_count = $count;
			    $count1 += $count;
			}
			$i++;
		}
		
  		return $count1; 
	}


}