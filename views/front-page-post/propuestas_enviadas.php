<?php

global $wpdb;

$user = wp_get_current_user();
$id = $user->ID;


$recibidos = 0;

if(isset($_POST["actualizar_propuesta"])){

    $data = [
        "descripcion_propuesta" => $_POST["descrip"],
        "valor_propuesta" => $_POST["precio"]
    ];

    $where = [
        "id_propuesta" => $_POST["id_propuesta"]
    ];

    $modificar = $wpdb->update(TABLA_DATOS_PROPUESTAS,$data,$where);

    if($modificar){
        echo "<div class='alert alert-success'>Propuesta modificada</div>";
    }else{
        echo "<div class='alert alert-danger'>Error al modificar la propuesta</div>";
    }

}


?>


<table class="table">
<thead>
    <tr>
        <th>#</th>
        <th>Trabajo</th>
        <th>Descripcion Propuesta</th>
        <th>Monto</th>
        <th>Modificar</th>
    </tr>
</thead>
<tbody>
<?php
$i = 1;

    $buscar_recibidos = $wpdb->get_results("SELECT * FROM ".TABLA_DATOS_PROPUESTAS." WHERE  id_user = ".$id.""); 



    foreach($buscar_recibidos as $key_2 => $propuesta):
    $user_propuesta = get_userdata($propuesta->id_user);


    $get_post = get_post($propuesta->id_post); 
 
?>
    <tr>
       <td>
        <form method="POST">   
           <?php echo $i; ?>
       </td>
       <td><?php echo $get_post->post_title; ?></td>
       <td>
       <input type="hidden" name="actualizar_propuesta">
       <input type="hidden" name="id_propuesta" value="<?php echo $propuesta->id_propuesta; ?>">
       <input type="hidden" name="id_user" value="<?php echo $propuesta->id_user; ?>">   
       <textarea name="descrip" id="" cols="30" rows="2"><?php echo $propuesta->descripcion_propuesta; ?></textarea> 
       </td>
       <td><input type="text" name="precio" value="<?php echo $propuesta->valor_propuesta; ?>"></td>
       <td>
           <input class="btn btn-success border-0" type="submit" value="Actualizar" name="enviar"> 
        </form>
      </td>
    </tr>
<?php

    endforeach;
?>
</tbody>
</table>