<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'Gestion Productos';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        <div class="form-group">
            <a href="<?= Url::toRoute(["site/gestion"]) ?>"><button class="btn btn-fill-out btn-block">Volver</button></a>
            </div>
        </div>
    </div>
 <div class="row">
     <div class="col-md-12">
     <div class="form-group">
     <?= Html::beginForm(Url::toRoute("site/cc"), "POST", ['enctype' => 'multipart/form-data', 'id' => 'cc']) ?>

         <input type="text" placeholder="Nombre de Categoría" name="categoria" class="form-control">
         <button class="btn btn-fill-out btn-block">Crear Categoría</button>
    <?= Html::endForm(); ?>
        </div>
 </div>
 </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre Categoria</th>
                            <th>Remover</th>
                           

                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0;
                        foreach ($categorias as $row) : $i++; ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row->categoria ?></td>

                                <td class="product-remove" data-title="Remove"><a href="<?= Url::toRoute(["site/delcat","id"=>$row->id]) ?>"><i class="ti-close"></i></td>

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