<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Categorias;
?>
<div class="container">
  
    <div class="row">
        <div class="col-md-8">
            <?= Html::beginForm(Url::toRoute("site/up"), "POST", ['enctype' => 'multipart/form-data', 'id' => 'up']) ?>
            <input type="hidden" name="id" value="<?= $producto->id ?>">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" value="<?= $producto->nombre ?>" name="nombre" class="form-control" required placeholder="Nombre Producto">
            </div>
            <div class="form-group">
                <label for="precio">precio</label>

                <input type="number" name="precio" value="<?= $producto->precio ?>" class="form-control" required placeholder="Precio">
            </div>
            <div class="form-group">
                <label for="stock">stock</label>

                <input type="number" name="stock" value="<?= $producto->stock ?>" class="form-control" required placeholder="Stock">
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select class="form-control" name="categoria" id="categoria" required>
                    <option value="<?= $producto->categoria ?>"><?= $producto->categoria ?></option>
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
                <textarea class="form-control" name="descripcion" id="descripcion" cols="30" required rows="5"><?= $producto->descripcion ?></textarea>
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
                        <input id="file-upload" name="imagen" onchange='cambiar()' type="file" style='display: none;' />
                        <div id="info">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img id="imagen" src="<?= $producto->foto_principal ?>">
                    </div>
                </div>
            </div>
            <?= Html::endForm() ?>

        </div>
        <div class="col-md-4">
            <div class="form-group">
                <button form="up" class="btn btn-fill-out btn-block">Actualizar Producto</button>
            </div>
            <?php if($producto->padre==0): ?>
            <div class="form-group">
                <button data-toggle="modal" data-target="#variante" class="btn btn-fill-out btn-block">Crear Variante</button>
            </div>
            <?php endif; ?>

            <div class="form-group">
            <a href="<?= Url::toRoute(['site/gestion']) ?>"><button class="btn btn-fill-out btn-block">Volver</button></a>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="variante">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <?= Html::beginForm(Url::toRoute("site/variante"), "POST", ['enctype' => 'multipart/form-data', 'id' => 'va']) ?>

                <div class="form-group">
                    <input type="hidden" value="<?= $producto->id ?>" name="padre">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre">
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" class="form-control" name="precio">
                </div>
                <div class="form-group">
                    <button class="btn btn-fill-out btn-block">Crear Variante</button>
                </div>
                <?= Html::endForm() ?>

            </div>
        </div>
    </div>
</div>