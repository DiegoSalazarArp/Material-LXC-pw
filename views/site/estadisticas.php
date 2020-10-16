<?php

/* @var $this yii\web\View */

use app\models\Product;
use yii\helpers\Url;
use app\models\Vendidos;

$this->title = 'Gestion Productos';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <a href="<?= Url::toRoute(['site/gestion']) ?>"><button class="btn btn-fill-out btn-block">Volver</button></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <button onclick="vaciar();" class="btn btn-fill-out btn-block">Vaciar Registros</button>
           <script>
               function vaciar(){
                   if(confirm("Esta segúro de querer continuar?")){
                      location.href="<?= Url::toRoute(['site/trash']) ?>";
                   }else{
                       
                   }
               }
           </script>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Dirección</th>
                            <th>Telefono</th>
                            <th>Total</th>
                            <th>Estado</th>
                           
                            <th>Fecha Entrega</th>
                            <th>Numero Orden</th>
                            <th>Ver Ficha</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ventas as $row) : ?>
                            <tr>
                                <td> <a href="#ventas_filter" onclick="filtrarVenta(<?= $row->orden_compra ?>);"> <?= $row->nombre ?> </a> </td>
                                <td><?= $row->email ?></td>
                                <td><?= $row->direccion ?></td>
                                <td><?= $row->telefono ?></td>
                                <td><?= $row->total ?></td>
                                <td><?php if ($row->estado == 1) {
                                        echo '<p class="text-success">pagado</p>"';
                                    } else {
                                        echo '<p class="text-danger">No Pagado</p>"';
                                    } ?></td>
                                    <?php 
                                    $f= explode(" ",$row->fecha);
                                    $fecha = explode("-",$f[0]);
                                    ?>
                               
                                <td><?= $row->entrega ?></td>
                                <td><?= $row->orden_compra ?></td>
                                <td><a data-toggle="modal" data-target="#Ficha-<?= $row->id ?>" href="#">Ver</a></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <table id="ventas" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Numero Orden</th>
                            <th>Fecha Compra</th>
                            <th>Fecha Entrega</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Precio Total</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Total Venta</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($ventas as $venta):
                           
                        $vendidos = Vendidos::find()->where(["codigo"=>$venta->orden_compra])->orderBy(['codigo' => SORT_DESC])->all();

                        ?>
                        <?php foreach ($vendidos as $row) : ?>
                            <?php $prod = Product::findOne($row->producto_id); ?>
                            <tr>
                                <td><?= $venta->orden_compra ?></td>
                                <?php 
                                    $f= explode(" ",$venta->fecha);
                                    $fecha = explode("-",$f[0]);
                                    ?>
                                <td><?= $fecha[2]."/".$fecha[1]."/".$fecha[0] ?></td>
                                <td><?= $venta->entrega ?></td>
                                <td><?= $prod->nombre ?></td>
                               
                                <td><?= $row->cantidad ?></td>
                                <td><?= $prod->precio ?></td>
                                <td><?= $prod->precio*$row->cantidad ?></td>
                                <td><?= $venta->nombre ?></td>
                                <td><?= $venta->direccion ?></td>
                                <td><?= $venta->email ?></td>
                                <td><?= $venta->telefono ?></td>
                                <td><?= $venta->total ?></td>
                                <td><?php if ($venta->estado == 1) {
                                        echo '<p class="text-success">pagado</p>"';
                                    } else {
                                        echo '<p class="text-danger">No Pagado</p>"';
                                    } ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php foreach ($ventas as $row) : ?>

        <div class="modal" id="Ficha-<?= $row->id ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="row">

                            <div style="height: 50px; padding: 1px; border: solid; font-size:smaller;" class="col-md-4 border-dark">Nombre: <?= $row->nombre ?></div>
                            <div style="height: 50px; padding: 1px; border: solid; font-size:smaller;" class="col-md-4 border-dark">Correo: <?= $row->email ?></div>
                            <div style="height: 50px; padding: 1px; border: solid; font-size:smaller;" class="col-md-4 border-dark">Fecha: <?= $row->fecha ?></div>

                        </div>
                        <div class="row">
                            <div style="height: 50px; padding: 1px; border: solid; font-size:smaller;" class="col-md-6 border-dark">Direccion: <?= $row->direccion ?></div>
                            <div style="height: 50px; padding: 1px; border: solid; font-size:smaller;" class="col-md-6 border-dark">Telefono: <?= $row->telefono ?></div>

                        </div>
                        <div class="row">
                            <div style="height: 300px; padding: 1px; border: solid; font-size:smaller;" class="col-md-6 border-dark">
                                <?php $v = Vendidos::find()->where(["codigo" => $row->orden_compra])->all(); ?>
                                <ul>
                                    <?php foreach ($v as $fila) : ?>
                                        <?php $p = Product::findOne($fila->producto_id); ?>
                                        <li><?= $p->nombre ?> X <?= $fila->cantidad ?> $<?= $p->precio * $fila->cantidad; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div style="height: 50px; padding: 1px; border: solid; font-size:smaller;" class="col-md-6 border-dark"><b> Numero de Orden: <?= $row->orden_compra ?> </b></div>
                            <div style="height: 50px; padding: 1px; border: solid; font-size:smaller;" class="col-md-6 border-dark"><b> Total: $<?= $row->total ?> </b></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<?php $this->registerJsFile('@web/assets/datatables/datatables.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>

<?php $this->registerJsFile('@web/assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/assets/datatables/JSZip-2.5.0/jszip.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/assets/datatables/pdfmake-0.1.36/pdfmake.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/assets/datatables/pdfmake-0.1.36/vfs_fonts.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/assets/js/gestion.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>