<?php 

function page_chat( $atts ){


  $atts = shortcode_atts( array(
                'prueba' => "exito"
        ), $atts);

  extract($atts);

  include "chat/html-chat.php";


}
add_shortcode( 'chat' , 'page_chat' );