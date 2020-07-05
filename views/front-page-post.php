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
    global $wpdb;
    $user = wp_get_current_user();
    $id = $user->ID;
    $obtener_datos_extras = $wpdb->get_row("SELECT * FROM ".TABLA_DATOS_EXTRA_USUARIO." WHERE id_user ='".$id."'");
    $host= $_SERVER["HTTP_HOST"];
    $url= $_SERVER["REQUEST_URI"];
    $url_site =  "https://" . $host . $url;
    $datos_faltantes = 0;
    if($obtener_datos_extras){
        foreach($obtener_datos_extras as $key){

            if($key == ""){
                $datos_faltantes++;
            }
            

        }

        $nombres = $obtener_datos_extras->nombres_usuario;
        $apellidos = $obtener_datos_extras->apellidos_usuario;
        $documento_usuario = $obtener_datos_extras->nro_documento_usuario;
        $direccion = $obtener_datos_extras->direccion_usuario;
        $telefono_usuario = $obtener_datos_extras->nro_telefono_usuario;
        $ciudad_usuario = $obtener_datos_extras->ciudad_usuario;
        $fecha_usuario = $obtener_datos_extras->fecha_nacimiento_usuario;
    }else{
        $nombres = $user->first_name;
        $apellidos = $user->last_name;
        $documento_usuario = "";
        $direccion = "";
        $telefono_usuario = "";
        $ciudad_usuario = "";
        $fecha_usuario = "";
    }


    $obtener_saldo = $wpdb->get_row("SELECT saldo FROM ".TABLA_DATOS_SALDO." WHERE  id_user = ".$id."");

    if($obtener_saldo){
        $saldo = $obtener_saldo->saldo;
    }else{
        $saldo = "0.00";
    }

    $obtener_saldo_pendiente = $wpdb->get_row("SELECT SUM(monto_transaccion) as total FROM ".TABLA_DATOS_TRANSACCIONES." WHERE  id_user = ".$id." and debito_credito = 1 and estatus = 0");

    if($obtener_saldo_pendiente){
        $saldo_pendiente = $obtener_saldo_pendiente->total;
    }else{
        $saldo_pendiente = "0.00";
    }

    $saldo_trabajando = "0.00";


    $atts = shortcode_atts( array(
		'doce_meses' => 0.561272,
        'nueve_meses' => 0.452492,
        'seis_meses' => 0.32402
	), $atts );

    extract($atts , EXTR_SKIP);

    ob_start();

    $url = get_site_url()."/mi-cuenta/";

    if(is_user_logged_in()){

   
    if(!$obtener_datos_extras || $datos_faltantes > 0 || $obtener_datos_extras->sexo_usuario == 0):
    ?>

    <div class="alert alert-warning">
        Perfil aun no completado, por favor complete todos los datos de su cuenta. <?php if(isset($_GET["slug"]) && $_GET["slug"] != "editar_perfil" ){ ?><a href="<?php echo get_site_url(); ?>/mi-cuenta/?slug=editar_perfil">Completar ahora</a><?php } ?>
    </div>

    <?php 
    endif;   

    if(isset($_GET["slug"]) && $_GET["slug"] == "lista_servicios"){
        echo '<h1>Lista de servicios</h1>';

              

        include "front-page-post/form-list.php";

    }elseif(isset($_GET["slug"]) && $_GET["slug"] == "mis_finanzas"){

        //echo '<h1>Mis finanzas</h1>';


        include "front-page-post/finanzas.php";

        
    }elseif(isset($_GET["slug"]) && $_GET["slug"] == "cargar_saldo"){

        //echo '<h1>Mis finanzas</h1>';


        include "front-page-post/add_money.php";

        
    }elseif(isset($_GET["slug"]) && $_GET["slug"] == "editar_perfil"){


        include "front-page-post/perfil.php";

        
    }elseif(isset($_GET["slug"]) && $_GET["slug"] == "cambiar_contrasena"){

        include "front-page-post/cambiar_password.php";
        
    }elseif(isset($_GET["slug"]) && $_GET["slug"] == "propuestas_recibidas"){

        echo '<h1>Propuestas recibidas</h1>';
        include "front-page-post/propuestas_recibidas.php";

        
    }elseif(isset($_GET["slug"]) && $_GET["slug"] == "propuestas_enviadas"){

        echo '<h1>Propuestas enviadas</h1>';
        include "front-page-post/propuestas_enviadas.php";

        
    }elseif(isset($_GET["slug"]) && $_GET["slug"] == "add_new"){

        echo '<h1>Publicar nueva solicitud</h1>';
        echo '<a href="'.$url.'?slug=lista_servicios" class="btn btn-warning mb-3"><i class="fa fa-list"></i> Volver a la lista</a>';
        echo do_shortcode('[form_service]');
        
    }elseif(isset($_GET["slug"]) && $_GET["slug"] == "edit_post"){

        echo '<h1>Editar solicitud</h1>';

        echo '<a href="'.$url.'?slug=lista_servicios" class="btn btn-warning mb-3"><i class="fa fa-list"></i> Volver a la lista</a> <a href="'.$url.'?slug=add_new" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Añadir nuevo</a>';

        echo do_shortcode('[form_service]');
    }else{

        include "front-page-post/dashboard.php";
    }
    }else{
        echo '<h3>Por favor accede con tu usuario para poder visualizar esta pagina</h3>';


        echo '<a href="'.get_site_url().'/acceder/" class="btn btn-info"><i class="fa fa-sign-in-alt"></i> Acceder / Registrate</a>';
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