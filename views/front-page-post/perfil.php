<?php
global $wpdb;
$user = wp_get_current_user();
$id = $user->ID;


$obtener_datos_extras = $wpdb->get_row("SELECT * FROM ".TABLA_DATOS_EXTRA_USUARIO." WHERE id_user ='".$id."'");

$datos_faltantes = 0;
if($obtener_datos_extras){
    foreach($obtener_datos_extras as $key){

        if($key == ""){
            $datos_faltantes++;
        }
        

    }

    $nombres = $obtener_datos_extras->nombres_usuario;
    $apellidos = $obtener_datos_extras->apellidos_usuario;
}else{
    $nombres = $user->first_name;
    $apellidos = $user->last_name;
}


if(isset($_POST["guardar_datos"])){

    if(!$obtener_datos_extras){

        $data = [

            "id_usuario_datos" => 0,
            "id_user"  => $id,
            "nombres_usuario" => $_POST["nombres_usuario"],
            "apellidos_usuario" => $_POST["apellidos_usuario"],
            "nro_documento_usuario" => $_POST["documento_usuario"],
            "nro_telefono_usuario" => $_POST["telefono_usuario"],
            "direccion_usuario" => $_POST["direccion_usuario"],
            "ciudad_usuario" => $_POST["ciudad_usuario"],
            "sexo_usuario" => $_POST["sexo_usuario"],
            "fecha_nacimiento_usuario" => $_POST["fecha_nacimiento_usuario"]

        ]; 

        $guardar = $wpdb->insert(TABLA_DATOS_EXTRA_USUARIO, $data);

    }else{

        $data = [

            "nombres_usuario" => $_POST["nombres_usuario"],
            "apellidos_usuario" => $_POST["apellidos_usuario"],
            "nro_documento_usuario" => $_POST["documento_usuario"],
            "nro_telefono_usuario" => $_POST["telefono_usuario"],
            "direccion_usuario" => $_POST["direccion_usuario"],
            "ciudad_usuario" => $_POST["ciudad_usuario"],
            "sexo_usuario" => $_POST["sexo_usuario"],
            "fecha_nacimiento_usuario" => $_POST["fecha_nacimiento_usuario"]

        ]; 

        $where = [

            "id_user" => $id

        ];

        $guardar = $wpdb->update(TABLA_DATOS_EXTRA_USUARIO, $data, $where);

    }

    if($guardar){
        echo "<script>location.reload();</script>";



    }else{
        echo "Error";
    }
}


?>
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <h1>Perfil de la cuenta</h1>
            <h4>Datos personales</h4>           
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php 
            if(!$obtener_datos_extras || $datos_faltantes > 0 || $obtener_datos_extras->sexo_usuario == 0):
            ?>

            <div class="alert alert-warning">
                Perfil aun no completado, por favor complete todos los datos de su cuenta.
            </div>

            <?php 
            endif;
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="" class="row" method="POST">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nombres</label>
                    <input type="text" class="form-control" name="nombres_usuario" value="<?php echo $nombres; ?>">
                </div>                
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos_usuario" value="<?php echo $apellidos; ?>">
                </div>               
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nro Documento de identidad</label>
                    <input type="text" class="form-control" name="documento_usuario" value="<?php echo $obtener_datos_extras->nro_documento_usuario; ?>">
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label for="">Sexo</label>
                    <select class="form-control" name="sexo_usuario">
                        <option value="0">Seleccionar</option>
                        <option value="1" <?php if($obtener_datos_extras->sexo_usuario == 1){ echo "selected"; } ?>>Hombre</option>
                        <option value="2" <?php if($obtener_datos_extras->sexo_usuario == 2){ echo "selected"; } ?>>Mujer</option>
                    </select>
                </div> 
                </div>



 
                <div class="col-md-12">
                <div class="form-group">
                    <label for="">Direccion</label>
                    <input type="text" class="form-control" name="direccion_usuario" value="<?php echo $obtener_datos_extras->direccion_usuario; ?>">
                </div> 
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nro Telefono</label>
                    <input type="text" class="form-control" name="telefono_usuario" value="<?php echo $obtener_datos_extras->nro_telefono_usuario; ?>">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="">Ciudad</label>
                    <input type="text" class="form-control" name="ciudad_usuario" value="<?php echo $obtener_datos_extras->ciudad_usuario; ?>">
                </div>                 
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="">Fecha de nacimiento</label>
                    <input type="date" class="form-control" name="fecha_nacimiento_usuario" value="<?php echo $obtener_datos_extras->fecha_nacimiento_usuario; ?>">
                </div>  
                </div>
                <div class="col-md-12">
                <div class="form-group">
                    <button tyep="submit" class="btn btn-success" name="guardar_datos">Actualizar datos</button>
                </div>  
                </div>
            </form>
        </div>
    </div>    
</div>