<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

require("front-page-post/form-standar.php");

/**
 * Handle the cmb-frontend-form shortcode
 *
 * @param  array  $atts Array of shortcode attributes
 * @return string       Form html
 */
function wds_do_frontend_form_submission_shortcode( $atts = array() ) {

	$atts = shortcode_atts( array(
		'doce_meses' => 0.561272,
        'nueve_meses' => 0.452492,
        'seis_meses' => 0.32402
	), $atts );

    extract($atts , EXTR_SKIP);

    ob_start();

    $url = get_site_url()."/mi-cuenta/";

    if(is_user_logged_in()){

    if(isset($_GET["slug"]) && $_GET["slug"] == "list"){
        echo '<h1>Lista de servicios</h1>';

        echo '<a href="'.$url.'?slug=add_new" class="btn btn-success mb-5"><i class="fa fa-plus"></i> Añadir nuevo</a>';        

        include "front-page-post/form-list.php";

    }elseif(isset($_GET["slug"]) && $_GET["slug"] == "add_new"){

        echo '<h1>Publicar nueva solicitud</h1>';

        echo '<a href="'.$url.'" class="btn btn-warning mb-3"><i class="fa fa-list"></i> Volver a la lista</a>';

        echo do_shortcode('[form_service]');
        
    }elseif(isset($_GET["slug"]) && $_GET["slug"] == "edit_post"){

        echo '<h1>Editar solicitud</h1>';

        echo '<a href="'.$url.'" class="btn btn-warning mb-3"><i class="fa fa-list"></i> Volver a la lista</a> <a href="'.$url.'?slug=add_new" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Añadir nuevo</a>';

        echo do_shortcode('[form_service]');
    }else{
        echo '<h1>Lista de solicitudes</h1>';

        echo '<a href="'.$url.'?slug=add_new" class="btn btn-success mb-5"><i class="fa fa-plus"></i> Añadir nuevo</a>';

        include "front-page-post/form-list.php";
    }
    }else{
        echo '<h3>No tiene permisos para ver esta página</h3>';
    }
	return ob_get_clean();
}



add_shortcode( 'service_front_admin', 'wds_do_frontend_form_submission_shortcode' );

/**
 * Handle the cmb-frontend-form shortcode
 * Crear shortcode, utiliza [form_service]
 * @param  array  $atts Array of shortcode attributes
 * @return string       Form html
 */

function ga_formulario_enviar_receta_shortcode() {
    // Obtener el ID del formulario para imprimir el formulario  en el HTML
    $cmb = ga_formulario_instancia();
    
    $output = '';
    
    // Obtener algún error
    if ( ( $error = $cmb->prop( 'submission_error' ) ) && is_wp_error( $error ) ) {
		// If there was an error with the submission, add it to our ouput.
		$output .= '<h3>' . sprintf( __( 'Hubo un error: %s', 'ga_artist' ), '<strong>'. $error->get_error_message() .'</strong>' ) . '</h3>';
	}
    
    // si la receta se envia correctamente, notificar al usuario
    if ( isset( $_GET['post_submitted'] ) && ( $post = get_post( absint( $_GET['post_submitted'] ) ) ) ) {

		// Get submitter's name
		$nombre = get_post_meta( $post->ID, 'autor_receta', 1 );
		$nombre = $nombre ? ' '. $nombre : '';

		// Imprimir un aviso.
		$output .= '<h3>' . sprintf( __( 'Gracias%s, Tu receta ha sido agregada, una vez que pase la revisión será publicada', 'ga_artist' ), esc_html( $nombre ) ) . '</h3>';
	}
    // si la receta se envia correctamente, notificar al usuario
    if ( isset( $_GET['edit_post'] ) && ( $post = get_post( absint( $_GET['edit_post'] ) ) ) ) {
        $id_post = $_GET['edit_post'];
    }else{
        $id_post = 0;
    }

    
    // Imprimir el formulario
    $output .= cmb2_get_metabox_form( $cmb, 'fake-oject-id', array( 'save_button' => __( 'Guardar Servicio', 'ga_artist' ) ) );
    
    return $output;
}
add_shortcode('form_service', 'ga_formulario_enviar_receta_shortcode');