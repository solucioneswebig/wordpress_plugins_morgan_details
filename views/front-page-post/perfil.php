<?php
ob_start();
?>

<?php








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
       header("Location: ".$url_site."");
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
                    <input type="text" class="form-control" name="documento_usuario" value="<?php echo $documento_usuario; ?>">
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                    <label for="">Sexo</label>
                    <select class="form-control" name="sexo_usuario">
                        <option value="0">Seleccionar</option>
                        <option value="1" <?php if(!empty($obtener_datos_extras) && $obtener_datos_extras->sexo_usuario == 1){ echo "selected"; } ?>>Hombre</option>
                        <option value="2" <?php if(!empty($obtener_datos_extras) && $obtener_datos_extras->sexo_usuario == 2){ echo "selected"; } ?>>Mujer</option>
                    </select>
                </div> 
                </div>



 
                <div class="col-md-12">
                <div class="form-group">
                    <label for="">Direccion</label>
                    <input type="text" class="form-control" name="direccion_usuario" value="<?php echo $direccion; ?>">
                </div> 
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nro Telefono</label>
                    <input type="text" class="form-control" name="telefono_usuario" value="<?php echo $telefono_usuario; ?>">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="">Ciudad</label>
                    <input type="text" class="form-control" name="ciudad_usuario" value="<?php echo $ciudad_usuario; ?>">
                </div>                 
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="">Fecha de nacimiento</label>
                    <input type="date" class="form-control" name="fecha_nacimiento_usuario" value="<?php echo $fecha_usuario; ?>">
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
<?php
ob_end_flush();
?>