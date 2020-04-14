<?php

if ( ! defined( 'ABSPATH' ) ) exit; 


if(isset($_POST["new_post"])){

    $data = [
        "service_name"         => $_POST["service_name"],
        "service_description"  => $_POST["service_description"],
        "post_author"          => $_POST["autor"]
    ];

    $guardar = create(0,$data);

}

if(isset($_POST["delete_post"])){

    wp_delete_post( $_POST["delete_post"], true);
   
}