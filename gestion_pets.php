<?php

/*

Plugin Name: GESTION DE SISTEMA DE SERVICIOS

Plugin URI: https://solucioneswebig.com/

Description: Sistema de gestion para la carga de servicios

Version: 1.0

Author: SolucionesWeBig - Alexander Gutierrez

Author URI: https://solucioneswebig.com/

License: GPLv2

*/



if ( ! defined( 'ABSPATH' ) ) exit; 

 

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {

	require_once dirname( __FILE__ ) . '/cmb2/init.php';

} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {

	require_once dirname( __FILE__ ) . '/CMB2/init.php';

}








global $wpdb;

$prefix_plugin_gn = "gestion_nomina_";



define('PREFIX', 'gn_');

define( 'GP_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

define( 'GP_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

define('PLUGIN_BASE_DIR', dirname(__FILE__));


//EMPIEZO A DEFINIR LAS TABLAS DE LA BD

/*
define('TABLA_EMPLEADOS' , $wpdb->prefix . $prefix_plugin_gn . 'perfil_empleado');
*/

//FINALIZO LA DEFINICION DE LAS TABLAS DE LA BD



function design_styles(){

	wp_enqueue_style( 'mtb-style-general', GP_PLUGIN_DIR_URL . 'assets/css/style.css', false );

	wp_enqueue_style( 'datatable-public-css','//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css', false );

	wp_enqueue_style( 'datatable-public-responsive-css','https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css', false );

	wp_enqueue_style( 'datatable-buttons','https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css', false );

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'datatable-public-js','//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js', array('jquery'), '1.10.19', true );

	wp_enqueue_script( 'datatable-public-responsive-js','https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js', array('jquery'), null, true );


	wp_enqueue_script( 'sweet-alert','https://cdn.jsdelivr.net/npm/sweetalert2@8', array('jquery'), null, true );

	wp_enqueue_script( 'mtb-scripts-general', GP_PLUGIN_DIR_URL . 'assets/js/script.js' , array( 'jquery' ), null , false );


}

add_action('wp_enqueue_scripts', 'design_styles');






/*Incluimos la carpeta de models*/

include GP_PLUGIN_DIR_PATH . "models/index.php";

/*Incluimos la carpeta de models*/

include GP_PLUGIN_DIR_PATH . "controllers/index.php";

/*Incluimos la carpeta de views*/

include GP_PLUGIN_DIR_PATH . "views/index.php";



