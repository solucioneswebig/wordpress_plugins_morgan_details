<?php

$user = wp_get_current_user();
$id = $user->ID;

$args = array(
	'author'        =>  $id,
	'post_type'	=> 'servicios'
);

$post_autor = get_posts($args);
$recibidos = 0;
?>


<table class="table">
<thead>
    <tr>
        <th>#</th>
        <th>Trabajo</th>
        <th>Participante</th>
        <th>Descripcion Propuesta</th>
        <th>Messaje</th>
    </tr>
</thead>
<tbody>
<?php
$i = 1;
foreach($post_autor as $key => $post):
    $buscar_recibidos = $wpdb->get_results("SELECT * FROM ".TABLA_DATOS_PROPUESTAS." WHERE id_post = ".$post->ID.""); 

    foreach($buscar_recibidos as $key_2 => $propuesta):
    $user_propuesta = get_userdata($propuesta->id_user);
    $datos_usuario = $wpdb->get_row("SELECT * FROM ".TABLA_DATOS_EXTRA_USUARIO." WHERE id_user = ".$propuesta->id_user.""); 
 
?>
    <tr>
       <td><?php echo $i; ?></td>
       <td><?php echo $post->post_title; ?></td>
       <td><?php 
       if(!empty($datos_usuario)){

           echo $datos_usuario->nombres_usuario." ".$datos_usuario->apellidos_usuario; 
       }
        ?></td>
       <td><?php echo $post->post_title; ?></td>
       <td><button type="button" class="btn btn-propuesta messenger" id-user="<?php echo get_current_user_id(); ?>" id-post="<?php echo $post->ID ?>" id-cliente="<?php echo $propuesta->id_user; ?>" id_enviado="<?php echo get_current_user_id() ?>">Enviar Mensaje</button> </td>
    </tr>
<?php
    endforeach;
endforeach;
?>
</tbody>
</table>