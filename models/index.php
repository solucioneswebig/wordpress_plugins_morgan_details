<?php

if ( ! defined( 'ABSPATH' ) ) exit; 


/**
 *  
 *  SE ESTA ASIGNANDO LA FUNCION DE QUE EL SUSCRIPTOR PUEDA SUBIR ARCHIVOS 
 * 
 */
add_action('admin_init', 'allow_contributor_upload_files');
function allow_contributor_upload_files() {
    $contributor = get_role('subscriber');
    $contributor->add_cap('upload_files');
}


/**
 *  
 *  Para que cada usuario pueda ver y gestionar solo los datos que el sube.
 * 
 */

function mostrar_solamente_archivos_del_usuario($query){
    $user = wp_get_current_user();
    $id = $user->ID;
    $query['author'] = $id;
    return $query;
} 
add_filter('ajax_query_attachments_args', 'mostrar_solamente_archivos_del_usuario');
//Limitar el acceso a la librería solo a tus propios archivos


/**
 * 
 *  CARGANDO DEPENDENCIAS
 * 
 */

include GP_PLUGIN_DIR_PATH . "models/post.php";
include GP_PLUGIN_DIR_PATH . "models/form-cmb2.php";
include GP_PLUGIN_DIR_PATH . "models/cpt.php";
include GP_PLUGIN_DIR_PATH . "models/metaboxes.php";
