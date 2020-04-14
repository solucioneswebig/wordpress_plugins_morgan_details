<?php 
if ( ! defined( 'ABSPATH' ) ) exit; 
?>


<form action="" method="POST">

<input type="hidden" name="new_post">

<input type="hidden" name="autor" value="<?php echo get_curr ?>">

<input type="text" name="service_name">

<input type="text" name="service_description">

<input type="submit" value="Enviar">

</form>