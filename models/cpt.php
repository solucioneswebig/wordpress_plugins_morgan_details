<?php 

function crear_post_type(){

    $labels = array(
    
    'name'  => _X('Servicios','Post Type General Name', 'gm_pets'),
    'singular_name'  => _X('Servicio','Post Type Singular Name', 'gm_pets'),
    'menu_name'  => __('Servicios', 'gm_pets'),
    'parent_item_colon'  => __('Servicio Padre', 'gm_pets'),
    'all_items'  => __('Todos los Servicios', 'gm_pets'),
    'view_item'  => __('Ver Servicio', 'gm_pets'),
    'add_new_item'  => __('Agregar Nuevo Servicio', 'gm_pets'),
    'add_new'  => __('Agregar Nuevo Servicio', 'gm_pets'),
    'edit_item'  => __('Editar Servicio', 'gm_pets'),
    'update_item'  => __('Actualizar Servicio', 'gm_pets'),
    'search_items'  => __('Buscar Servicio', 'gm_pets'),
    'not_found'  => __('No encontrado', 'gm_pets'),
    'not_found_in_trash'  => __('No encontrado en la papelera', 'gm_pets') 
    );
    
    // otras opciones 
    
    $args = array(
    'label' => __('Servicios', 'gm_pets'),
    'description'  => __('Servicios', 'gm_pets'),
    'labels' => $labels, 
    //'supports' => array('title','editor','excerpt','author','thumbnail','comments','revisions','custom-fields','slug'),
    'supports' => array('title','editor','author','thumbnail'),
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_admin_bar' => true,
    'menu_position' => 6,
    'has_archive' => true,
    'can_export' => true,
    'exclude_from_search' => false,
    'capibility_type' => 'page',
    'menu_icon'   => 'dashicons-megaphone'
    );
    
    //Registrar
    register_post_type('servicios',$args);
    
}
    
add_action('init', 'crear_post_type', 0);


    
function taxonomia_categoria_localidades(){

$labels = array(

'name'  => _X('Categoria Servicios','taxonomy general name', 'gm_pets'),
'singular_name'  => _X('servicio','taxonomy singular name', 'gm_pets'),
'parent_item_colon'  => __('Categoria padre', 'gm_pets'),
'all_items'  => __('Categorias de Servicios', 'gm_pets'),
'view_item'  => __('Ver Categoria', 'gm_pets'),
'add_new_item'  => __('Agregar nueva categoria servicio', 'gm_pets'),
'add_new'  => __('Agregar nueva categoria de Servicios', 'gm_pets'),
'edit_item'  => __('Editar categoria de Servicios', 'gm_pets'),
'update_item'  => __('Actualizar categoria de Servicios', 'gm_pets'),
'search_items'  => __('Buscar categoria de Servicios', 'gm_pets'),
'not_found'  => __('No encontrada', 'gm_pets'),
'menu_name'  => __('Categoria servicios', 'gm_pets'),
'not_found_in_trash'  => __('No encontrada en la papelera', 'gm_pets') );


$args = array(


'labels' => $labels, 
'hierarchical' => true, // True para taxonomías del tipo "Categoría" y false para el tipo "Etiquetas"
'show_ui' => true,
'show_admin_column' => true,
'query_var' => true,
'rewrite' => array( 'slug' => 'categorias-servicios' ),
);


register_taxonomy('categoria_servicios',array('servicios'),$args);
}


add_action('init','taxonomia_categoria_localidades');
    
    