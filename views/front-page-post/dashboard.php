<?php
global $wpdb;
$user = wp_get_current_user();
$id = $user->ID;
$id_user = get_current_user_id();
$buscar_propuesta = $wpdb->get_results("SELECT * FROM ".TABLA_DATOS_PROPUESTAS." WHERE id_user = ".$id_user."");  





$args = array(
	'author'        =>  $id_user,
	'post_type'	=> 'servicios'
);

$post_autor = get_posts($args);
$recibidos = 0;
foreach($post_autor as $key => $value){

    $buscar_recibidos = $wpdb->get_results("SELECT * FROM ".TABLA_DATOS_PROPUESTAS." WHERE id_post = ".$value->ID.""); 

    if($buscar_recibidos){
        $recibidos++;
    }

}


?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
            <h1>Panel de control</h1>
            <h3>Bienvenido <?php echo $user->display_name; ?></h3>
            </div>
    </div>
    <div class="row">
            <div class="col-md-6">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">Saldo disponible</div>
                <div class="card-body text-center">
                <h3 class="card-title">$ <?php echo $saldo; ?></h3>
                </div>
                </div>            
            </div>    
            <div class="col-md-6">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">Servicios publicados</div>
                <div class="card-body text-center">
                    <h3 class="card-title"><?php echo count($post_autor); ?></h3>
                </div>
                </div>                
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Propuestas enviadas</div>
                <div class="card-body text-center">
                <h3 class="card-title"><?php echo count($buscar_propuesta); ?></h3>
                </div>
                </div>            
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header">Propuestas recibidas</div>
                <div class="card-body text-center">
                <h3 class="card-title"><?php echo $recibidos; ?></h3>
                </div>
                </div>             
            </div>
    </div>
</div>
