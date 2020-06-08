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

$prefix_plugin_gn = "gestion_morgan_";



define('PREFIX', 'gm_');

define( 'GP_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

define( 'GP_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

define('PLUGIN_BASE_DIR', dirname(__FILE__));


//EMPIEZO A DEFINIR LAS TABLAS DE LA BD


define('TABLA_DATOS_EXTRA_USUARIO' , $wpdb->prefix . $prefix_plugin_gn . 'datos_usuario_extra');
define('TABLA_DATOS_PROPUESTAS' , $wpdb->prefix . $prefix_plugin_gn . 'datos_propuestas');
define('TABLA_DATOS_CHAT' , $wpdb->prefix . $prefix_plugin_gn . 'datos_chat');
define('TABLA_DATOS_USER' , $wpdb->prefix .  'users');




//FINALIZO LA DEFINICION DE LAS TABLAS DE LA BD



function design_styles_pets(){

	//wp_enqueue_style( 'mtb-style-general', GP_PLUGIN_DIR_URL . 'assets/css/style.css', false );

	wp_enqueue_style( 'datatable-public-css','//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css', false );

	wp_enqueue_style( 'datatable-public-responsive-css','https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css', false );

	wp_enqueue_style( 'datatable-buttons','https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css', false );

	wp_enqueue_style( 'chatbox-css', GP_PLUGIN_DIR_URL . 'assets/lib/chat/css/chat.css', false );

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'datatable-public-js','//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js', array('jquery'), '1.10.19', true );

	wp_enqueue_script( 'datatable-public-responsive-js','https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js', array('jquery'), null, true );

	wp_enqueue_script( 'sweet-alert','https://cdn.jsdelivr.net/npm/sweetalert2@8', array('jquery'), null, true );

	wp_enqueue_script( 'fontawesome','https://kit.fontawesome.com/36226558a5.js', array(''), null, true );

	

	wp_enqueue_script( 'mtb-scripts-general', GP_PLUGIN_DIR_URL . 'assets/js/script.js' , array( 'jquery' ), null , false );

	wp_localize_script('mtb-scripts-general','busqueda_vars',['ajaxurl'=>admin_url('admin-ajax.php')]);
}

add_action('wp_enqueue_scripts', 'design_styles_pets');


//Devolver datos a archivo js
add_action('wp_ajax_nopriv_ajax_busqueda','busqueda_ajax');
add_action('wp_ajax_ajax_busqueda','busqueda_ajax');

function busqueda_ajax(){
	include "ajax/busqueda.ajax.php";
	wp_die();
}




/*Incluimos la carpeta de models*/

include GP_PLUGIN_DIR_PATH . "models/index.php";

/*Incluimos la carpeta de models*/

include GP_PLUGIN_DIR_PATH . "controllers/index.php";

/*Incluimos la carpeta de views*/

include GP_PLUGIN_DIR_PATH . "views/index.php";



