<?php

$user = wp_get_current_user();
$id = $user->ID;



?>
<div class="container">
    
    <div class="row">
        <div class="col-md-12">
            <h1>Perfil de la cuenta</h1>
            <h4>Cambio de contraseña y usuario de la cuenta</h4>           
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo do_shortcode('[clean-login-edit]'); ?>
        </div>
    </div>    
</div>