<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Contáctanos | Locosxchiloe';

?>
<div class="main_content">

    <!-- START SECTION CONTACT -->

    <div class="section" style="background-repeat: round; background-image: url('/assets/images/slider-contacto.png');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h1 class="text-center text-uppercase" style="color:white;">¿Algo que decir?</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="section pb_70">
        <div class="container ">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <?= Html::beginForm(Url::toRoute("site/contact"), "POST", ['enctype' => 'multipart/form-data', 'id' => 'cp']) ?>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control border-rounded" placeholder="Ingresa tu Nombre">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="correo">Correo Electronico</label>
                        <input type="text" name="correo" class="form-control border-rounded" placeholder="tucorreo@correo.cl">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="mensaje">Mensaje</label>
                        <textarea class="form-control border-rounded" name="mensaje" id="" placeholder="Escribe tu mensaje aquí"></textarea>
                    </div>
                    <button class="btn btn-fill-out border-rounded">Enviar Mensaje</button>
                    <?= Html::endForm() ?>

                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>

    <hr>
    <div class="container p-5">
        <h2 class="text-center text-uppercase">Comunicate directo con nosotros a:</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="text-center">
                    <img src="<?= $url ?>/assets/images/correo.svg" style="width:50%">
                    <div class="text-center"><br>
                        <b>
                            <span>Correo Electrónico</span> <br>
                            <span class="colormedio">ventas@locosxchiloe.cl</span>
                        </b>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img class="w-50" src="<?= $url ?>/assets/images/telefono.svg" alt="salmon_ahumado">
                    <div class="text-center"><br>
                        <b>
                            <span>Telefóno</span> <br>
                            <span class="colormedio">+569 5700 1623</span>
                        </b>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img class="w-50" src="<?= $url ?>/assets/images/horario.svg" alt="salmon_ahumado">
                    <div class="text-center"><br>
                        <b>
                            <span>Horario de Atención Dudas</span> <br>
                            <span class="colormedio">Lunes a Sábado de <br>9:30 a 20:00hrs </span>
                        </b>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="section " style="background-image: url('/assets/images/fondo-sus.png'); padding:85px 0;background-repeat: round;">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <div class=" mb-md-0 heading_light">
                        <h3 class="text-uppercase">Hey! Es tiempo de que te suscribas</h3>
                        <p>Puedes recibir <span style="color:rgb(222, 113, 15);">grandes ofertas</span> e información de nuevos productos </p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="newsletter_form" style="width: 85%;padding-left: 15%;">
                        <?= Html::beginForm(Url::toRoute("site/suscribir"), "POST") ?>
                        <input type="text" required class="form-control rounded-pill" name="correo" placeholder="tucorreo@correo.com">
                        <button type="submit" class="btn btn-dark rounded-pill" value="Submit" style="background-color:rgb(222, 113, 15)">SUSCRIBIRSE</button>

                        <?= Html::endForm() ?>
                    </div>
                </div>


            </div>
        </div>
    </div>

</div>


<style>
    .border-rounded {
        border: solid 1px black;
        border-radius: 25px;
    }

    .colormedio {
        color: rgb(222, 113, 15);
    }
</style>