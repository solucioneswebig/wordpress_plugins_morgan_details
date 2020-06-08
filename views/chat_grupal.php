<?php 

function page_chat_grupal( $atts ){


  $atts = shortcode_atts( array(
                'prueba' => "exito"
        ), $atts);

  extract($atts);

  include "chat_grupal/html-chat-grupal.php";


}
add_shortcode( 'chat_grupal' , 'page_chat_grupal' );