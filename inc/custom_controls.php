<?php
if ( ! function_exists( 'wpc_extended_sass_customizer_script' ) ) :
remove_action( 'customize_controls_enqueue_scripts', 'wpc_extended_customizer_script', 10 );

function wpc_extended_sass_customizer_script() {
	$theme_settings = WPC_Extended_Sass::Instance();

	wp_register_script( 'customizer-admin', plugins_url() . '/wpc-extended/js/customizer-admin.js', array(), true, true );
	wp_localize_script( 'customizer-admin', 'wpc_extended_conditional_logic', $theme_settings->get_conditional_logic() );
	wp_enqueue_script( 'customizer-admin' );
}
add_action( 'customize_controls_enqueue_scripts', 'wpc_extended_sass_customizer_script', 9 );
endif;
?>
