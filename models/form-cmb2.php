<?php



/** Formulario y campos para enviar receta **/
function ga_campos_formulario() {

    if ( isset( $_GET['edit_post'] ) && ( $post = get_post( absint( $_GET['edit_post'] ) ) ) ) {
        $title = $post->post_title;
        $content = apply_filters( 'the_content', $post->post_content );
        $term_obj_list = get_the_terms( $post->ID, 'categoria_servicios' );

        if($term_obj_list){
            $terms_string = wp_list_pluck($term_obj_list, 'slug');
        }else{
            $terms_string = array();
        }

        $presupuesto = get_post_meta( $post->ID, 'precio-servicio', true );

        $galeria = get_post_meta( $post->ID, 'galeria-servicios', true ); 
        
        
    }else{
        $title = "";
        $content = "";
        $terms_string = array();
        $presupuesto = "";
        $galeria = ""; 
    }
    $cmb = new_cmb2_box(array(
        'id'           => 'ga_enviar_receta', 
        'object_types' => array('page'), 
        'hookup'       => false, // Si se va a guardar el post como borrador en la página principal
        'save_fields'  => false, // Sino va a guardar los campos durante el hookup
    ));    

    $cmb->add_field(array(
        'name' => 'Imagen del servicio',
        'id'   => 'imagen_destacada',
        'type' => 'text',
        'attributes' => array(
            'type' => 'file'
        ),
     ));

     $cmb->add_field( array(
        'name'       => __( 'Categorias del servicio', 'cmb2' ),
        'id'         => 'submitted_categories',
        'type'       => 'taxonomy_multicheck',
        'default'    => $terms_string,
        'taxonomy'   => 'categoria_servicios', // Taxonomy Slug
        ) );

    $cmb->add_field( array(
        'name' => 'Nombre Servicio',
        'id'   => 'titulo_receta',
        'type' => 'text',
        'default'  => $title
    ));



    $cmb->add_field(array(
        'name' => 'Descripcion del servicio',
        'id'   => 'contenido_receta',
        'type' => 'wysiwyg',
        'options' => array(
        'textarea_rows' => 12,
        'media_buttons' => false 
        ),  
        'default' => $content
    ));

    	// Regular text field
	$cmb->add_field( array(
		'name'       => __( 'Presupuesto', 'cmb2' ),
		'desc'       => __( 'Valor que puede ofrecer', 'cmb2' ),
		'id'         => 'precio-servicio',
        'type'       => 'text',
        'default'    => $presupuesto,
		'show_on_cb' => 'cmb2_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
	) );

    $cmb->add_field( array(
        'name' => 'Galeria',
        'desc' => '',
        'id'   => 'galeria-servicios',
        'default' => $galeria,
        'type' => 'file_list',
        'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        // 'query_args' => array( 'type' => 'image' ), // Only images attachment
        // Optional, override default text strings
        'text' => array(
            'add_upload_files_text' => 'Cargar imagenes', // default: "Add or Upload Files"
            'remove_image_text' => 'Eliminar', // default: "Remove Image"
            'file_text' => 'Imagen', // default: "File:"
            'file_download_text' => 'Descargar', // default: "Download"
            'remove_text' => 'Borrar', // default: "Remove"
        ),
    ) );



}
add_action('cmb2_init', 'ga_campos_formulario');

/** Obtiene la instancia del formulario **/
function ga_formulario_instancia() {
    // ID del metabox
    $metabox_id = 'ga_enviar_receta';
    
    // No aplica el object_id ya que se va a generar automaticamente al crearlo.
    $object_id = 'fake-object-id';
    
    return cmb2_get_metabox($metabox_id, $object_id);
}



function ga_insertar_receta() {

    // si la receta se envia correctamente, notificar al usuario
    if ( isset( $_GET['edit_post'] ) && ( $post = get_post( absint( $_GET['edit_post'] ) ) ) ) {
        $id_post = $_GET['edit_post'];
    }else{
        $id_post = 0;
    }


    // En caso de que no se envie un formulario, no ejecutar nada
    if(empty($_POST) || !isset( $_POST['submit-cmb'], $_POST['object_id']) ) {
        return false;
    }
    
    // Obtener una instancia del formulario
    $cmb = ga_formulario_instancia();
    
    $post_data = array();
    
    // Revisar nonce de seguridad
    if( !isset($_POST[ $cmb->nonce()] ) || !wp_verify_nonce($_POST[ $cmb->nonce()], $cmb->nonce() ) ) {
        return $cmb->prop('submission_error', new WP_Error('security_fail', 'Fallo en la seguridad.') );
    }
    
    // Revisar que haya un titulo de receta
    
    if(empty($_POST['titulo_receta'])) {
        return $cmb->prop('submission_error', new WP_Error('post_data_missing', 'Se requiere un titulo para el post'));
    }
    
    /* Sanitizar datos */
    
    $valores_sanitizados = $cmb->get_sanitized_values($_POST);

    $user = wp_get_current_user();
    $id_user = $user->ID;

    $post_data['ID'] = $id_post;

    $post_data['post_status'] = "publish";

    $post_data['post_author'] = $id_user;
    
    // Agregar titulo a $post_data
    $post_data['post_title'] = $valores_sanitizados['titulo_receta'];
    unset($valores_sanitizados['titulo_receta']);
    
    // Agregar Contenido a $post_data
    $post_data['post_content'] = $valores_sanitizados['contenido_receta'];
    unset($valores_sanitizados['contenido_receta']);
    
   
    
    
    // Agregar Taxonomias al $post_data
    /*
     $etiquetas = explode(',', $valores_sanitizados['etiquetas']);
    $post_data['tax_input'] = array(
            'precio_receta' => $valores_sanitizados['precio-receta'],
            'tipo-comida'   => $valores_sanitizados['tipo-comida'],
            'horario-menu'   => $valores_sanitizados['horario-menu'],
            'estado'        => $etiquetas
    );
    // Llenar los metaboxes
    */
    $post_data['meta_input'] =  array(
            'precio-servicio' => $valores_sanitizados['precio-servicio'],
            'galeria-servicios' => $valores_sanitizados['galeria-servicios']
    );
    
    
    // Post type donde se va a insertar
    $post_data['post_type'] = 'servicios';
    
    // Insertar el post en la BD
    $nuevo_post = wp_insert_post($post_data, true);
    
    if(is_wp_error($nuevo_post)) {
        return $cmb->prop('submission_error', $nuevo_post);
    }
    // Guardamos los campos de CMB
    $cmb->save_fields($nuevo_post, 'post', $valores_sanitizados);
    
    // Intenta agregar una imagen destacada
    $img_id = ga_enviar_imagen_destacada($nuevo_post, $post_data);
    
    // Si no hay errores sube la imagen
    if($img_id && !is_wp_error($img_id)) {
        set_post_thumbnail($nuevo_post, $img_id);
    }

    // si la receta se envia correctamente, notificar al usuario
    if ( isset( $_GET['edit_post'] ) && ( $post = get_post( absint( $_GET['edit_post'] ) ) ) ) {
    // Redireccionamos para prevenir que no haya duplicados
    wp_redirect(esc_url_raw(add_query_arg('update', $nuevo_post)));
    exit;
    }else{
    // Redireccionamos para prevenir que no haya duplicados
    wp_redirect(esc_url_raw(add_query_arg('post_submitted', $nuevo_post)));
    exit;
    }

    
}
add_action('cmb2_after_init', 'ga_insertar_receta');


function ga_enviar_imagen_destacada($post_id, $attachment_post_data = array()) {
    if(
            empty($_FILES) 
            || !isset($_FILES['imagen_destacada'])
            || isset($_FILES['imagen_destacada']['error']) && 0 !== $_FILES['imagen_destacada']['error']
    ) {
        return;
    }
    
    // Filtrar los valores de la imagen destacada
    $archivo = array_filter($_FILES['imagen_destacada']);
    
    // Asegurarnos de que se subió un archivo
    if(empty($archivo) ) {
        return;
    }
    // Agregar el Uploaded de WordPress
    if(!function_exists('media_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
    }
    // Subir el archivo y añadirlo como imagen destacada
    return media_handle_upload('imagen_destacada', $post_id, $attachment_post_data);
}