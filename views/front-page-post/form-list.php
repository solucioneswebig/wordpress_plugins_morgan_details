<?php

$user = wp_get_current_user();
$id = $user->ID;

$args = array(
    'post_type' => 'servicios',
    'author' => $id
);

$query = new WP_Query( $args );


if(!$obtener_datos_extras || $datos_faltantes > 0 || $obtener_datos_extras->sexo_usuario == 0):

?>    

<div class="alert alert-warning">
    Es necesario completar el perfil antes de realizar una publicación de un servicio.
</div>

<?php
else:
echo '<a href="'.$url.'?slug=add_new" class="btn btn-success mb-5"><i class="fa fa-plus"></i> Añadir nuevo</a>';  
?>

<table class="table">

<thead>
    <tr>
        <th>#</th>
        <th>Imagen</th>
        <th>Nombre del servicio</th>
        <th>Precio</th>
        <th>Acciones</th>
    </tr>

</thead>

<tbody>
<?php
$i = 1;
if ( $query->have_posts() ) { 
	while ( $query->have_posts() ) { 
        $query->the_post();
        
    if(get_the_post_thumbnail_url()){

        $url_image = get_the_post_thumbnail_url();
    }else{
        $url_image = "https://via.placeholder.com/250/999999/FFFFFF/?text=IMAGE";
    }

?>
<tr>
    <td><?php echo $i; ?></td>
    <td><img src="<?php echo $url_image; ?>" class="card-img shadow border" alt="<?php echo the_title(); ?>" style="height: 50px;width: 50px;object-fit: cover;"></td>
    <td><?php echo the_title(); ?></td>
    <td><?php echo $presupuesto = get_post_meta( get_the_ID(), 'precio-servicio', true ); ?></td>
    <td>
    <form action="" method="POST">
    <input type="hidden" name="delete_post" value="<?php echo get_the_ID(); ?>">
    <a href="<?php echo $url; ?>?slug=edit_post&edit_post=<?php echo get_the_ID(); ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>

    </form>
    
    
    </td>

</tr>
        

<?php
$i++;
	}
}
wp_reset_postdata();
?>
</tbody>
</table>


<?php 
endif;
?>