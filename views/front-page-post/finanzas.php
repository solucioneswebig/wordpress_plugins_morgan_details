<?php

$user = wp_get_current_user();
$id = $user->ID;

$metodos = [
    '0' => "Transferencia Bancaria",
    '1' => "Deposito en efectivo",
    '2' => "Mercado Pago",
    '3' => "PayPal"
];

?>








<div class="container">

    <div class="row mb-5">
        <div class="col-md-2">
        <p class="mb-0">Disponible</p> <span class="d-inline-block badge badge-success"><h4>$ <?php echo $saldo; ?></h4></span>
        </div>
        <div class="col-md-2">
        <p class="mb-0">Trabajando</p> <span class="d-inline-block badge badge-info"><h4>$ <?php echo $saldo_trabajando; ?></h4></span>
        </div>         
        <div class="col-md-2">
        <p class="mb-0">Pendiente</p> <span class="d-inline-block badge badge-warning"><h4>$ <?php echo $saldo_pendiente; ?></h4></span>
        </div>  
               
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Lista de transacciones</h3>
        </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Monto</th>
                        <th>Metodo</th>
                        <th>Tipo transaccion</th>
                        <th>fecha</th>
                        <th>Estatus</th>
                    </tr>
                </thead>     

                <tbody>
                <?php
                $i = 1;

                    $buscar_transacciones = $wpdb->get_results("SELECT * FROM ".TABLA_DATOS_TRANSACCIONES." WHERE  id_user = ".$id.""); 



                    foreach($buscar_transacciones as $key_2 => $transaccion):
                
                ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td>$ <?php echo number_format($transaccion->monto_transaccion, 2, ',', '.'); ?></td>
                        <td><?php echo $metodos[$transaccion->metodo_transaccion]; ?></td>
                        <td>Recarga</td>
                        <td><?php echo $transaccion->fecha; ?></td>
                        <td><?php 
                        
                        if($transaccion->estatus == 0){
                            echo '<span class="badge badge-warning">Pendiente</span>';
                        }elseif($transaccion->estatus == 1){
                            echo '<span class="badge badge-success">Aprobado</span>';
                        }else{
                            echo '<span class="badge badge-danger">Cancelado</span>';
                        }

                        ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>       
            </table>
        </div>
    </div>

    <div class="row border-top pt-3 mt-3">
        <div class="col-md-12">
            <a class="btn btn-success" href="<?php echo $url; ?>?slug=cargar_saldo"><i class="fa fa-money-bill"></i> Cargar saldo</a>
        </div>
    </div>

</div>
