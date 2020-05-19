<?php 

global $wpdb;

if(isset($_POST["chat_mensaje"])){

	$data = [
			"id_chat" 				=> 0,
      "id_user"   			=> $_POST["id_user"],
      "id_cliente"      => $_POST["id_cliente"],
      "id_post"  				=> $_POST["id_post"],
			"mensaje" 		  	=> $_POST["mensaje"]
	];

	$guardar = $wpdb->insert(
      TABLA_DATOS_CHAT, 
      $data
	);
	
	if($guardar){
		echo 1;
	}

}else if(isset($_POST["abrir_chat"])){

	$id_user = $_POST["id_cliente"];
	$id_post = $_POST["id_post"];

	$buscar_mensaje = $wpdb->get_results("SELECT * FROM ".TABLA_DATOS_CHAT." WHERE id_cliente = ".$id_user." AND id_post = ".$id_post."");

	echo json_encode($buscar_mensaje);

}


	



 ?>