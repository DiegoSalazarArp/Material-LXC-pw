<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Categorias;
?>
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <?= Html::beginForm(Url::toRoute("site/cp"), "POST", ['enctype' => 'multipart/form-data', 'id' => 'cp']) ?>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" required placeholder="Nombre Producto">
            </div>
            <div class="form-group">
                <label for="precio">precio</label>

                <input type="number" name="precio" class="form-control" required placeholder="Precio">
            </div>
            <div class="form-group">
                <label for="stock">stock</label>

                <input type="number" name="stock" class="form-control" required placeholder="Stock">
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select class="form-control" name="categoria" id="categoria" required>
                    <option value="">Seleccione Categoria</option>
                    <?php
                    $cat = new Categorias;
                    $categorias =  $cat->find()->all();
                    foreach ($categorias as $row) : ?>
                        <option value="<?= $row->categoria ?>"><?= $row->categoria ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion" cols="30" required rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Seleccione Foto Principal (540x600)</label>
                <style>
                    #imagen {
                        height: 190px;
                        width: 190px;

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
                            <i id="btn-foto" class="fa fa-cloud-upload"> Foto Principal</i>
                        </label>
                        <input id="file-upload" name="imagen" onchange='cambiar()' required type="file" style='display: none;' />
                        <div id="info">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img id="imagen" src="assets/images/logo.png">
                    </div>
                </div>
            </div>
            <?= Html::endForm() ?>

        </div>
        <div class="col-md-4">
            <div class="form-group">
                <button form="cp" class="btn btn-fill-out btn-block">Crear Producto</button>
            </div>
            <div class="form-group">
            <a href="<?= Url::toRoute(['site/gestion']) ?>"><button class="btn btn-fill-out btn-block">Volver</button></a>
            </div>
  
        </div>
    </div>
</div>
