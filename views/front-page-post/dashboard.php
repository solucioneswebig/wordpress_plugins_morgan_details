<?php
global $wpdb;
$user = wp_get_current_user();
$id = $user->ID;

?>

<div class="container">
    <div class="row">
            <div class="col-md-12">
            <h1>Panel de control</h1>
            <h3>Bienvenido <?php echo $user->display_name; ?></h3>
            </div>
    </div>
    <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">Publicados</div>
                <div class="card-body text-center">
                    <h3 class="card-title">2</h3>
                </div>
                </div>                
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header">Enviadas</div>
                <div class="card-body text-center">
                <h3 class="card-title">2</h3>
                </div>
                </div>            
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Recibidas</div>
                <div class="card-body text-center">
                <h3 class="card-title">2</h3>
                </div>
                </div>             
            </div>
            <div class="col-md-3">
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">Saldo</div>
                <div class="card-body text-center">
                <h3 class="card-title">$ 0.00</h3>
                </div>
                </div>            
            </div>
    </div>
</div>
