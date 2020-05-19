<?php



function gn_database(){

    global $wpdb;

    global $gn_dbversion;

    $gn_dbversion = '0.1';

    $charset_collate = $wpdb->get_charset_collate();


    $datos_extras_usuario = "CREATE TABLE IF NOT EXISTS " . TABLA_DATOS_EXTRA_USUARIO . " (

        id_usuario_datos bigint(20) NOT NULL AUTO_INCREMENT,

        id_user int(20) NOT NULL,

        nombres_usuario longtext NOT NULL,

        apellidos_usuario longtext NOT NULL,

        nro_documento_usuario longtext NOT NULL,

        nro_telefono_usuario longtext NOT NULL,
       
        direccion_usuario longtext NOT NULL,

        ciudad_usuario longtext NOT NULL,

        sexo_usuario longtext NOT NULL,

        fecha_nacimiento_usuario longtext NOT NULL,        

        PRIMARY KEY (id_usuario_datos)

    )$charset_collate;";


    $datos_extras_usuario = "CREATE TABLE IF NOT EXISTS " . TABLA_DATOS_PROPUESTAS . " (

        id_propuesta bigint(20) NOT NULL AUTO_INCREMENT,

        id_user int(20) NOT NULL,

        id_post int(20) NOT NULL,

        descripcion_propuesta longtext NOT NULL,

        valor_propuesta longtext NOT NULL,

        fecha_comienzo date NOT NULL,
         
        fecha_fin date NOT NULL,

        estatus int(20) NOT NULL,

        fecha_propuesta date NOT NULL,

        PRIMARY KEY (id_propuesta)

    )$charset_collate;";


    $datos_extras_usuario = "CREATE TABLE IF NOT EXISTS " . TABLA_DATOS_CHAT . " (

        id_chat bigint(20) NOT NULL AUTO_INCREMENT,

        id_user int(20) NOT NULL,

        id_cliente int(20) NOT NULL,

        id_post int(20) NOT NULL,

        mensaje longtext NOT NULL,

        fecha timestamp NOT NULL,

        PRIMARY KEY (id_chat)

    )$charset_collate;";
  

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


    dbDelta($datos_extras_usuario);





    add_option('gn_dbversion', $gn_dbversion);



}



add_action('init', 'gn_database');











