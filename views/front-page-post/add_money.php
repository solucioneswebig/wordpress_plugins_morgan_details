<?php
global $wpdb;
$user = wp_get_current_user();
$id = $user->ID;


if(isset($_POST["cargar_saldo"])){

    /** 
     *  DEBITO CREDITO
     *  0 = Debito
     *  1 = Acreditar
     *  2 = Trabajo en Ejecucion
     * 
     *  METODO DE TRANSACCION
     *  <option value="0">Transferencia Bancaria</option>
     *  <option value="1">Deposito en efectivo</option>
     *  <option value="2">Mercado Pago</option>
     *  <option value="3">PayPal</option>
    */
    
    $data = [
        "id_transaccion" => 0,
        "id_user" => $id,
        "monto_transaccion" => $_POST["monto_transaccion"],
        "debito_credito" => 1,
        "metodo_transaccion" => $_POST["metodo_transaccion"],
        "referencia" => $_POST["referencia"],
        "fecha" => date("Y-m-d H:i:s"),
        "estatus" => 0
    ];

    $guardar = $wpdb->insert(TABLA_DATOS_TRANSACCIONES,$data);

    if($guardar){
        echo $mensaje = '<div class="alert alert-success">Transaccion enviada a revision, si todo va bien pronto se le acreditara el saldo.</div>';
    }else{
        echo $mensaje = '<div class="alert alert-danger">Error al procesar la transaccion</div>';
    }

}


?>

<div class="container">
    <div class="row mb-3 border-bottom">
        <div class="col-md-12">
            <h3>Opciones de pago</h3>
        </div>    
    </div>
    <div class="row">
        <div class="col-md-12">
            
        </div>
        <div class="col-md-12">
           <ul>
                <li><h6><strong>Cuenta Bancaria</strong></h6></li>
                <li>Nro Cuenta:  5555555555</li>
                <li>CBU: 55555555555555555555</li>
                <li>CUIT / CUIL: 55555555555</li>
                <li>DNI: 555555555</li>
           </ul>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h3>Cargar comprobante</h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post">
                  <div class="row">
                      <div class="col-md-3">
                            <div class="form-group">
                            <label for="">Monto:</label>
                            <input type="hidden" name="cargar_saldo">
                            <input type="text" name="monto_transaccion" id="" class="form-control">
                            </div>
                      </div>
                      <div class="col-md-4">
                            <div class="form-group">
                            <label for="">Metodo:</label>
                            <select name="metodo_transaccion" id="" class="form-control">
                                <option value="0">Transferencia Bancaria</option>
                                <option value="1">Deposito en efectivo</option>
                                <option value="2">Mercado Pago</option>
                                <option value="3">PayPal</option>
                            </select>
                            </div>
                      </div>     
                      <div class="col-md-3">
                            <div class="form-group">
                            <label for="">Numero de referencia:</label>
                            <input type="text" name="referencia" id="" class="form-control">
                            </div>
                      </div>
                      <div class="col-md-2 pt-3">
                            <div class="form-group mt-3"> 
                            <button type="submit" class="btn btn-info"><i class="fa fa-credit-card"></i> Añadir</button>
                            </div>    
                      </div>                                                           
                  </div>  
            </form>
        </div>
        <div class="col-md-12">

        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="<?php echo $url; ?>?slug=mis_finanzas"><i class="fa fa-undo"></i> Volver a finanzas</a>
        </div>
    </div>    
</div>
