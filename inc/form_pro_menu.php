<?php 
 function fp_main_menu(){require CHI_PATH.'/templates/form_pro_page.php';}
add_action('lms_scripts', 'lms_scripts_styles_stripe_pro');
function lms_scripts_styles_stripe_pro(){
	echo '<link rel="stylesheet" href="'.CHI_URL.'assets/css/bootstrap.css">';
	echo '<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">';
	echo '<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>';
}
add_action("admin_menu", "cspd_imdb_options_submenu");
function cspd_imdb_options_submenu() {
	add_menu_page( 'Form Pro', 'Form Pro', 'read', 'fp_main_menu', 'fp_main_menu');

}

