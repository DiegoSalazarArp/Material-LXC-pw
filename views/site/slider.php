<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Slider;
use app\models\Categorias;
$this->title = 'Gestion Slider';

?>
<div class="container">
<div class="row">
    <div class="col-md-3">
    <div class="form-group">
            <a href="<?= Url::toRoute(['site/gestion']) ?>"><button class="btn btn-fill-out btn-block">Volver</button></a>
            </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-9">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Texto 1</th>
                        <th scope="col">Texto 2</th>
                        <th scope="col">Texto 3</th>
                        <th scope="col">Remover</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $slider = Slider::find()->all();?>
                    <?php foreach ($slider as $row) : ?>
                        <tr>

                            <td class="product-thumbnail"><a href="#"><img src="<?= $row->foto ?>"></a></td>
                            <td class="product-name" data-title="Product"><?= $row->texto1 ?></td>
                            <td class="product-name" data-title="Product"><?=  $row->texto2  ?></td>
                            <td class="product-name" data-title="Product"><?=  $row->texto3  ?></td>

                            <td class="product-remove" data-title="Remove"><a href="<?= Url::toRoute(['site/removsl', "id" => $row->id]) ?>"><i class="ti-close"></i>
                                </a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
        <?= Html::beginForm(Url::toRoute("site/upslider"), "POST", ['enctype' => 'multipart/form-data', 'id' => 'cp']) ?>
        <div class="form-group">
                <label for="nombre">Texto 1</label>
                <input type="text" name="texto1" class="form-control" required placeholder="texto 1">
            </div>
            <div class="form-group">
                <label for="nombre">Texto 2</label>
                <input type="text" name="texto2" class="form-control" required placeholder="texto 2">
            </div>
            <div class="form-group">
                <label for="nombre">Texto 3</label>
                <input type="text" name="texto3" class="form-control" required placeholder="texto 3">
            </div>
            <label>Medida Necesaria (1280x650) Formato JPG</label>
            <style>
                #imagen {
                    height: 100px;
                    width: 300px;

                }

                #btn-foto {
                    padding: 10px;
                    color: white;
                    background-color: orangered;
                }
            </style>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label for="file-upload" class="subir">
                        <i id="btn-foto" class="fa fa-cloud-upload"> Seleccionar Imagen</i>
                    </label>
                    <input id="file-upload" name="imagen" onchange='cambiar()' required type="file" style='display: none;' />
                    <div id="info">
                    </div>
                </div>

            </div>
            <div class="row">
                <img id="imagen" src="assets/images/logo.png">
            </div>
            <button class="btn btn-fill-out btn-block">Subír Información</button>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>