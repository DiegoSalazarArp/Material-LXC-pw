<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Variantes Productos';
?>
<div class="container">
    <div class="row">
      
        <div class="col-md-3">
            <a href="<?= Url::toRoute(['site/gestion']) ?>"><button class="btn btn-fill-out btn-block">Volver</button></a>
        </div>
      
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Foto Principal</th>
                            <th>Categoria</th>
                            <th>Fecha Publicación</th>
                            <th>Stock</th>
                            <th>Borrar</th>
                            <th>Editar</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $row) : ?>
                            <tr>
                                <td><?= $row->nombre ?></td>
                                <td><?= $row->precio ?></td>
                                <td> <a href="<?= $row->foto_principal ?>" target="_blank">Ver</a> </td>
                                <td><?= $row->categoria ?></td>
                                <td><?= $row->fecha ?></td>
                                <td><?= $row->stock ?></td>

                                <td class="product-remove" data-title="Remove"><a href="<?= Url::toRoute(['site/delprod', "id" => $row->id]) ?>"><i class="ti-close"></i></a></td>
                                <td class="product-remove" data-title="Edit"><a href="<?= Url::toRoute(['site/editprod', "id" => $row->id]) ?>"><i class="ti-write"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->registerJsFile('@web/assets/datatables/datatables.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>

<?php $this->registerJsFile('@web/assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/assets/datatables/JSZip-2.5.0/jszip.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/assets/datatables/pdfmake-0.1.36/pdfmake.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/assets/datatables/pdfmake-0.1.36/vfs_fonts.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/assets/js/gestion.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>