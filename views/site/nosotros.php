<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Slider;

$this->title = 'Quienes Somos | Locosxchiloe';
$url = "";
if (isset($_SERVER['HTTPS'])) {
    $url = "https://" . $_SERVER['SERVER_NAME'] . "/";
} else {
    $url = "http://" . $_SERVER['SERVER_NAME'] . "/";
}
?>
<div class="main_content">

    <!-- STAT SECTION ABOUT -->
    <div class="section" style="background-repeat: round; background-image: url('/assets/images/slider-1.png');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">

                    <h1 class="text-center" style="color:white;">¿QUIENES SOMOS?</h1>

                </div>
            </div>
        </div>


    </div>
    <br><br>
    <div class="heading_s1 text-center p-4">
                    <h2 class="text-uppercase">Directamente desde <span style="color:rgb(222, 113, 15);">Chiloé</span> a tu casa</h2>
                </div>

    <div class="container">
        <div class="row">

        <div class="col-lg-4">
                <div class="about_img scene mb-4 mb-lg-0">
                    <img class="img img-responsive" style="border-radius: 30px;" src="<?= $url ?>assets/images/foto1.png" alt="Locosxchiloe" />
                </div>
            </div>

            <div class="col-lg-8">
                
                <p class="quienes-somos">Somos una empresa que nació a raíz de un emprendimiento en noviembre del año 2017, nuestro objetivo es poder proveer un mercado gourmet con una gran variedad de pescados, marisco e incluso cárnicos, quesos y hortalizas, importados de la Gran Isla de Chiloé y otras regiones del país, a las familias de Santiago y sus comunas, llevándolo a la puerta de manera fácil a las puertas de tu hogar.
                </p>
                <p class="quienes-somos">Tenemos un compromiso con el medioambiente y nuestros organismos, además buscamos constantemente una magnífica experiencia de sabores y aseguramos la mejor calidad y responsabilidad para toda nuestra comunidad.
                    Esperamos muy pronto construir nuestra propia casa e invitarlos a degustar con nosotros los mejores sabores de La gran Isla de Chiloé.
                </p>
            </div>
            
        </div>
    </div>
</div>
<br><br>
<div class="section " style="background-image: url('/assets/images/fondo-sus.png'); padding:85px 0; background-repeat: round;">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <div class=" mb-md-0 heading_light">
                        <h3 class="text-uppercase">Hey! Es tiempo de que te suscribas</h3>
                        <p>Puedes recibir <span style="color:rgb(222, 113, 15)">grandes ofertas</span> e información de nuevos productos </p>
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