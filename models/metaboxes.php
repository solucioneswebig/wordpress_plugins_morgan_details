<?php

add_action( 'cmb2_admin_init', 'cmb2_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function cmb2_sample_metaboxes() {

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'            => 'test_metabox',
		'title'         => __( 'Adicionales', 'cmb2' ),
		'object_types'  => array( 'servicios', ), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

    $cmb->add_field( array(
		'name'       => __( 'Presupuesto', 'cmb2' ),
		'desc'       => __( 'Valor que maneja para esta solicitud', 'cmb2' ),
        'id'               => 'precio-servicio',
        'type'             => 'select',
        'show_option_none' => false,
        'default'    => 'custom',
        'options'          => array(
            '1'     => __( '0 - 50', 'cmb2' ),
            '2'     => __( '50 - 150', 'cmb2' ),
            '3'     => __( '150 - 300', 'cmb2' ),
            '4'     => __( '300 +', 'cmb2' ),
        ),
    ) );

    $cmb->add_field( array(
        'name' => 'Documentos o Imagenes',
        'desc' => '',
        'id'   => 'galeria-servicios',
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        // 'query_args' => array( 'type' => 'image' ), // Only images attachment
        // Optional, override default text strings
        'text' => array(
            'add_upload_files_text' => 'Replacement', // default: "Add or Upload Files"
            'remove_image_text' => 'Replacement', // default: "Remove Image"
            'file_text' => 'Replacement', // default: "File:"
            'file_download_text' => 'Replacement', // default: "Download"
            'remove_text' => 'Replacement', // default: "Remove"
        ),
    ) );

	// Add other metaboxes as needed

}