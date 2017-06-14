<?php
add_action( 'plugins_loaded', 'wpc_extended_sass_init' );

function wpc_extended_sass_init() {
if ( ! class_exists( 'WPC_Extended_Sass' ) && class_exists( 'WPC_Extended' ) ) :
class WPC_Extended_Sass extends WPC_Extended {
	/**
	 * Template directory.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $template_directory;

	/**
	 * Template directory uri.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $template_directory_uri;

	/**
	 * Sass input directory.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $sass_input_directory;

	/**
	 * Sass output directory.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $sass_output_directory;

	/**
	 * Sass vardump file.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $sass_vardump;

	/**
	 * Sass output file.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $sass_output;

	/**
	 * Live css file.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $live_css;

	/**
	 * Sass entry point.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $sass_entry_point = 'style.scss';

	/**
	 * CSS backup quantity.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var int
	 */
	private $css_backup_quantity = 1;

	/**
	 * Sets template directory.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $path Template directory path.
	 */
	public function set_template_directory( $path ) {
		$this->template_directory = $path;
	}

	/**
	 * Sets template directory uri.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $path Template directory uri.
	 */
	public function set_template_directory_uri( $path ) {
		$this->template_directory_uri = $path;
	}

	/**
	 * Sets Sass entry point.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $filename Filename for the Sass entry point.
	 */
	public function set_sass_entry_point( $filename ) {
		$this->sass_entry_point = $filename;
	}

	/**
	 * Sets Sass input directory.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $directory Location for the Sass input directory.
	 */
	public function set_sass_input_directory( $directory ) {
		$this->sass_input_directory = $directory;
	}

	/**
	 * Sets Sass output directory.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $directory Location for the Sass output directory.
	 */
	public function set_sass_output_directory( $directory ) {
		$this->sass_output_directory = $directory;
	}

	/**
	 * Sets CSS backup quantity.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param int $quantity Number of css backup files to create.
	 */
	public function set_css_backup_quantity( $quantity ) {
		$this->css_backup_quantity = $quantity;
	}

	/**
	 * Sets Sass vardump file location.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $file Location for the Sass vardump file.
	 */
	public function set_sass_vardump( $file ) {
		$this->sass_vardump = $file;
	}

	/**
	 * Sets Sass output file location.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $file Location for the Sass output file.
	 */
	public function set_sass_output( $file ) {
		$this->sass_output = $file;
	}

	/**
	 * Sets live css file location.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $file Location for the live css file.
	 */
	public function set_live_stylesheet( $file ) {
		$this->live_css = $file;
	}

	/**
	 * Get path for a directory or file.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $request The requested directory or file.
	 * @param book   $type The type of path.
	 */
	public function get_path( $request, $type = 'local' ) {
		switch( $type ) :
			case 'uri' :
			case 'live' :
				$path = $this->template_directory_uri;
				break;

			default :
				$path = $this->template_directory;
				break;
		endswitch;

		switch( $request ) :
			case 'input_directory' :
			case 'input directory' :
				$path .= "/$this->sass_input_directory/";
				break;

			case 'vardump' :
			case 'var_dump' :
				$path .= "/$this->sass_input_directory/$this->sass_vardump";
				break;

			case 'sassoutput' :
			case 'sass_output' :
			case 'sass output' :
			case 'output' :
				$path .= "/$this->sass_output_directory/$this->sass_output";
				break;

			case 'stylesheet' :
			case 'livecss' :
			case 'live_css' :
			case 'live css' :
			case 'css' :
				$path .= "/$this->live_css";
				break;
		endswitch;

		return $path;
	}

	/**
	 * Compile Sass.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function compile() {
		// Get setting values.
		$values = $this->get_settings( 'show_reference' );

		// Save vardump.
		$this->save_vardump( $values );

		// Load scssphp compiler.
		require plugin_dir_path( __FILE__ ) . '/scssphp/scss.inc.php';
		$scss = new Leafo\ScssPhp\Compiler;

		// Set import directory.
		$scss->setImportPaths( $this->get_path( 'input_directory' ) );

		// Set variables.
		$scss->setVariables( $values );

		// Save css to file.
		file_put_contents( $this->get_path( 'sass_output' ), $scss->compile( '@import "' . $this->sass_entry_point . '"' ) );
	}

	/**
	 * Save values into vardump file.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array $values Array of setting values.
	 */
	private function save_vardump( $values = null ) {
		$var_dump = "";

		if ( null === $values ) :
			$values = $this->get_settings( 'show_reference' );
		endif;

		foreach ( $this->settings as $setting_id => $data ) :
			if ( 'title' === $data['vardump'] ) :
				// Add label to string as comment.
				$var_dump .= "\n// " . $data['label'] . "\n";
			elseif ( 'subtitle' === $data['vardump'] ) :
				// Add label to string as comment.
				$var_dump .= "// " . $data['label'] . "\n";
			elseif ( array_key_exists( $setting_id, $values ) ) :
				// Get setting value
				$value = $values[$setting_id];

				// Add $ if it's a reference to another variable
				if ( 'inherit' === $data['vardump'] ) :
					$value = '$' . $value;
				endif;

				// Add value to string.
				$var_dump .= "\$$setting_id: $value;\n";
			endif;
		endforeach;

		// Save $var_dump to Sass dump file.
		file_put_contents( $this->get_path( 'vardump' ), $var_dump );
	}

	/**
	 * Push CSS live.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function push_live() {
		$live_css_path = $this->get_path( 'live_css' );

		// Get live css file path without the .css extension
		$target = substr( $live_css_path, 0, -4 );

		for ($i = $this->css_backup_quantity; $i > 0; $i--) {
			$prev = ( $i > 1 ) ? '.backup' . ( $i - 1 ) : '';
			rename( "$target$prev.css", "$target.backup$i.css" );
		}

		copy( $this->get_path( 'sass_output' ), $live_css_path );
	}

	/**
	 * Using singleton pattern.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function Instance() {
		static $instance = null;
		if ( $instance === null ) {
			$instance = new WPC_Extended_Sass;
		}
		return $instance;
	}

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		$this->set_template_directory( get_stylesheet_directory() );
		$this->set_template_directory_uri( get_stylesheet_directory_uri() );

		$this->set_sass_input_directory( 'sass' );
		$this->set_sass_output_directory( 'sass_output' );

		$this->set_sass_vardump( '_customizer_variables.scss' );
		$this->set_sass_output( 'style.css' );
		$this->set_live_stylesheet( 'style.css' );

		add_action( 'customize_register', array( $this, 'register' ) );
		add_action( 'customize_preview_init', array( $this, 'compile' ) );
		add_action( 'customize_save_after', array( $this, 'compile' ) );
		add_action( 'customize_save_after', array( $this, 'push_live' ), 11 );
	}
}
endif;
}
?>
