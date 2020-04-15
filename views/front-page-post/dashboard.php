<?php

$user = wp_get_current_user();
$id = $user->ID;



?>

<h3>Bienvenido <?php echo $user->email; ?></h3>