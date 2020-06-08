<?php 

global $wpdb;

if(isset($_POST["chat_mensaje"])){

	$data = [
			"id_chat" 				=> 0,
      "id_user"   			=> $_POST["id_user"],
      "id_cliente"      => $_POST["id_cliente"],
      "id_post"  				=> $_POST["id_post"],
			"mensaje" 		  	=> $_POST["mensaje"],
			"id_envio"				=> $_POST["id_envio"]
	];

	$guardar = $wpdb->insert(
      TABLA_DATOS_CHAT, 
      $data
	);
	echo json_encode($guardar);

}else if(isset($_POST["abrir_chat"])){

	$id_user = $_POST["id_cliente"];
	$id_post = $_POST["id_post"];

	$buscar_mensaje = $wpdb->get_results("SELECT * FROM ".TABLA_DATOS_CHAT." WHERE id_cliente = ".$id_user." AND id_post = ".$id_post."");

	echo json_encode($buscar_mensaje);

}else if(isset($_POST["notificacion"])){

	$id_cliente = $_POST["id_cliente"];
	

	$contar_mensajes = $wpdb->get_results("SELECT * FROM ".TABLA_DATOS_CHAT." WHERE id_cliente = ".$id_cliente." ");

	echo json_encode($contar_mensajes);

}else if(isset($_POST["abrir_chat_grupal"])){

	$mostrar_usuario = $wpdb->get_results("SELECT * FROM ".TABLA_DATOS_PROPUESTAS." as propuesta 
														LEFT JOIN ".TABLA_DATOS_USER." as user ON user.ID = propuesta.id_user
														GROUP BY propuesta.id_user ");

	echo json_encode($mostrar_usuario);

}


	



 ?>