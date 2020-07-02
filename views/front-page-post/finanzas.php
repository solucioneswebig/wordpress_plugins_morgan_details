<?php

$user = wp_get_current_user();
$id = $user->ID;



?>








<div class="container">

    <div class="row mb-5">
        <div class="col-md-2">
        <p class="mb-0">Disponible</p> <span class="d-inline-block badge badge-success"><h4>$ 25.00</h4></span>
        </div>
        <div class="col-md-2">
        <p class="mb-0">Trabajando</p> <span class="d-inline-block badge badge-info"><h4>$ 00.00</h4></span>
        </div>         
        <div class="col-md-2">
        <p class="mb-0">Pendiente</p> <span class="d-inline-block badge badge-warning"><h4>$ 00.00</h4></span>
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
                    </tr>
                </thead>     

                <tbody>
                
                    <tr>
                        <td>1</td>
                        <td>$ 25.00</td>
                        <td>Transferencia</td>
                        <td>Recarga</td>
                        <td>26/06/2020</td>
                    </tr>
                
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
