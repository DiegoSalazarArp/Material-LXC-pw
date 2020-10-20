<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Slider;

$this->title = 'Pescados y Mariscos Congelados - Salmón Premium | LocosxChiloé';
?>

<!-- START SECTION BANNER -->
<div class="banner_section slide_wrap shop_banner_slider staggered-animation-wrap divcarrousel">
    <div id="carouselExampleControls" class="carousel slide carousel-fade light_arrow" data-loop="true" data-autoplay="true" data-ride="carousel">
        <div class="carousel-inner">
            <?php $j = 0; ?>

            <?php $slider = Slider::find()->all(); ?>
            <?php foreach ($slider as $row) : ?>
                <?php if ($j == 0) : ?>
                    <div class="carousel-item active background_bg" data-img-src="<?= $row->foto ?>">
                        <?php $j++; ?>
                    <?php else : ?>
                        <div class="carousel-item background_bg" data-img-src="<?= $row->foto ?>">
                        <?php endif; ?>
                        <div class="banner_slide_content banner_content_inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6 col-md-8 col-sm-9 col-10">

                                        <div  class="banner_content2">
                                            <!-- texto -->
                                            <!-- <h6 class="mb-2 mb-sm-3 staggered-animation text-uppercase text-white" data-animation="fadeInDown" data-animation-delay="0.2s"><?= $row->texto1 ?></h6> -->
                                            <h2 class="staggered-animation text-white" data-animation="fadeInDown" data-animation-delay="0.3s"><?= $row->texto2 ?></h2>
                                            <p class="staggered-animation text-white" data-animation="fadeInUp" data-animation-delay="0.4s" style="font-size: 20px;"><?= $row->texto3 ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <ol class="carousel-indicators indicators_style2">
                        <?php
                        $i = 0;
                        foreach ($slider as $row) :
                            if ($i == 0) { ?>
                                <li data-target="#carouselExampleControls" data-slide-to="<?= $i ?>" class="active"></li>

                            <?php } else { ?>

                                <li data-target="#carouselExampleControls" data-slide-to="<?= $i ?>"></li>
                            <?php }
                            $i++; ?>
                        <?php endforeach; ?>
                    </ol>
        </div>
    </div>
    <!-- END SECTION BANNER -->
    <div class="section small_pt small_pb">
        <div class="container">
            <div class="heading_s3 text-center">
                <div class="row justify-content-center" style="text-align:center;">
                    <div class="col-md-4" style="float:left">
                        <img style="width:240px; height:240px;" src="<?= $url ?>/assets/images/icono-bienvenida.svg" />
                    </div>

                    <div class="col-md-8" style="float:left; text-align:left; text-align:justify;">
                        <h1 class="text-center">BIENVENIDO SOMOS LOCOSXCHILOE</h1>
                        <br>
                        <div>
                            <p>Sumergete y recorre un viaje junto a nosotros de las maravillas
                                que entrega nuestra isla. Somos LocosxChiloe, una empresa que te brinda los mejores
                                productos al alcance de tu hogar, espero disfrutes tanto
                                como nosotros de las maravillas que nos brinda Chiloé. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- START SECTION SHOP -->
    <div class="section small_pt small_pb" style="background-image: url('/assets/images/fondo-productos-destacados.png')">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-3 text-center">
                    <img class="w-50" style="padding-bottom:20px;" src="assets/images/estrellas-naranjas.svg">

                </div>
                <div class="col-md-6 text-center">
                    <div class="heading_s3 text-center">
                        <h2 style="color:white">PRODUCTOS DESTACADOS</h2>
                    </div>
                    <div class="small_divider clearfix"></div>
                </div>
                <div class="col-md-3 text-center">
                    <img class="w-50 pdb" src="assets/images/estrellas-naranjas.svg">

                </div>
            </div>


            <div class="row">

                <div class="col-md-12">

                    <div class="product_slider carousel_slider owl-carousel owl-theme nav_style4" data-loop="true" data-dots="false" data-nav="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                        <?php foreach ($productos as $row) : ?>

                            <div class="item">
                                <div class="product_box text-center">
                                    <div class="product_img">
                                        <a href="<?= Url::toRoute(['site/product', 'prdctid' => $row->id]) ?>">
                                            <img src="<?= $row->foto_principal ?>" alt="<?= $row->categoria ?>">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <li><a href="<?= Url::toRoute(['site/product', 'prdctid' => $row->id]) ?>"><i class="icon-magnifier-add"></i></a></li>
                                                <!-- <?php if ($row->stock > 0) : ?>
                                                    <li><a href="<?= Url::toRoute(['site/addtocart', 'product' => $row->id]) ?>"><i class="linearicons-cart"></i></a></li>
                                                <?php endif; ?> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title text-uppercase"><a style="color:white;" href="shop-product-detail.html"><?= $row->nombre ?></a></h6>
                                        <div class="product_price">
                                            <span class="price">$<?= number_format($row->precio, 0, ".", ".") ?></span>
                                            <?php if ($row->stock > 0) : ?>
                                                <a href="<?= Url::toRoute(['site/addtocart', 'product' => $row->id]) ?>" class=""><img class="iconDim dimensionImg" src="<?= $url ?>/assets/images/carro-de-compra.svg" alt=""></a>
                                            <?php else : ?>
                                                <button class="btn btn-fill-out btn-radius"><i class="icon-basket-loaded"></i> Agotado</button>

                                            <?php endif; ?>


                                        </div>
                                        <div class="rating_wrap">

                                        </div>
                                        <div class="pr_desc">
                                        </div>
                                        <div class="">


                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <!-- START SECTION BANNER -->
    <div class="section" style="background-image: url('/assets/images/fondo-compra-envio-seguro.png');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3 text-center">
                    <img class="w-50" style="padding-bottom:20px;" src="assets/images/estrellas-naranjas.svg">

                </div>
                <div class="col-md-6">
                    <h2 class="text-dark text-center">COMPRA & ENVÍO SEGURO</h2>
                </div>
                <div class="col-md-3 text-center">
                    <img class="w-50" src="assets/images/estrellas-naranjas.svg">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 p-5">
                    <div class="text-center">
                        <img class="w-25 transY" src="assets/images/paso-1.svg">
                        <img class="w-50" src="assets/images/paso-1-1.svg" alt="pescados_mariscos">
                        <div class="">
                            <span>Productos traidos desde la Isla de Chiloé</span>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-5">
                    <div class="text-center">
                        <img class="w-25  transY" src="assets/images/paso-2.svg" alt="pescados_mariscos">

                        <img class="w-50" src="assets/images/paso-2-2.svg" alt="salmon_ahumado">
                        <div class="">
                            <span>Selecciona tus productos desde nuestra web</span>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-5">
                    <div class="text-center">
                        <img class="w-25  transY" src="assets/images/paso-3.svg" alt="pescados_mariscos">

                        <img class="w-50" src="assets/images/paso-3-3.svg" alt="salmon_ahumado">
                        <div class="">
                            <span>Paga tus productos que se encuentran en el carro de compra</span>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-5">
                    <div class="text-center">
                        <img class="w-25  transY" src="assets/images/paso-4.svg" alt="pescados_mariscos">

                        <img class="w-50" src="assets/images/paso-4-4.svg" alt="salmon_ahumado">
                        <div class="">
                            <span>Envío totalmente gratuito por compras superiores a $15.000</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 p-5">
                    <div class="text-center">
                        <img class="w-25  transY" src="assets/images/paso-5.svg" alt="pescados_mariscos">

                        <img class="w-50" src="assets/images/paso-5-5.svg" alt="salmon_ahumado">
                        <div class="">
                            <span>Disfruta tus productos desde la comodidad de tu hogar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION BANNER -->



    <!-- START SECTION INSTAGRAM IMAGE -->
    <!-- <div class="section small_pt small_pb">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-12">

                <div class="follow_box">
                    <i class="ti-instagram"></i>
                    <h3 class="text-white">Instagram</h3>
                    <a target="_blank" href="https://www.instagram.com/locosxchiloe" class="text-white"><span>@locosxchiloe</span></a>
                </div>
                <div class="client_logo carousel_slider owl-carousel owl-theme" data-dots="false" data-margin="0" data-loop="true" data-autoplay="true" data-responsive='{"0":{"items": "2"}, "480":{"items": "3"}, "767":{"items": "4"}, "991":{"items": "6"}}'>
                    <div class="item">
                        <div class="instafeed_box">
                            <a href="https://www.instagram.com/locosxchiloe/">
                                <img src="assets/images/jaibas.png" alt="jaibas" />
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="instafeed_box">
                            <a href="https://www.instagram.com/locosxchiloe/">
                                <img src="assets/images/instagram_ceviche.png" alt="ceviche" />
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="instafeed_box">
                            <a href="https://www.instagram.com/locosxchiloe/">
                                <img src="assets/images/instagram_salmon-1.png" alt="salmon" />
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="instafeed_box">
                            <a href="https://www.instagram.com/locosxchiloe/">
                                <img src="assets/images/instagram_locosxchiloe.png" alt="filete" />
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="instafeed_box">
                            <a href="https://www.instagram.com/locosxchiloe/">
                                <img src="assets/images/locosxchiloe-plato.png" alt="congelados" />
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="instafeed_box">
                            <a href="https://www.instagram.com/locosxchiloe/">
                                <img src="assets/images/instagram_salmon.png" alt="salmon" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
    <!-- END SECTION INSTAGRAM IMAGE -->

    <div class="section " style="background-image: url('/assets/images/fondo-sus.png'); padding:85px 0; background-repeat: round;">
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
    .dimensionImg {
        width: 40px !important;
        display: initial !important;
    }

    .iconDim {
        width: 100px;
    }

    .comprar {
        border: 1px solid black;
    }
    .pdb{
        padding-bottom: 10px;
    }
</style>
<!-- END MAIN CONTENT -->