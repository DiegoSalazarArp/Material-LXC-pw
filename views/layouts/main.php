<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Carrito;
use app\models\Product;
use app\models\User;

$url = "";
if (isset($_SERVER['HTTPS'])) {
    $url = "https://" . $_SERVER['SERVER_NAME'] . "/";
} else {
    $url = "http://" . $_SERVER['SERVER_NAME'] . "/";
}
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-166773481-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-166773481-1');
    </script>


    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <meta name="description" content="Pescados y Mariscos Congelados al mejor precio y calidad, traídos de la Isla de Chiloé. Salmón, Salmón Ahumado, Choritos, Jaibas, Ostión, Pulpo, Merluza, Atún, Camarón,mariscos congelados, santiago, despacho, chiloe" />

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
    <link rel="shortcut icon" type="image/x-icon" href="<?= $url ?>/assets/images/favicon.png">
    <!-- Animation CSS -->
    <?php $this->registerCssFile('@web/assets/css/animate.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <!-- Icon Font CSS -->
    <?php
    $this->registerCssFile('@web/assets/css/all.min.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/css/ionicons.min.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/css/themify-icons.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/css/linearicons.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/css/flaticon.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/css/simple-line-icons.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/owlcarousel/css/owl.carousel.min.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/owlcarousel/css/owl.theme.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/owlcarousel/css/owl.theme.default.min.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/css/magnific-popup.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/css/slick.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/css/slick-theme.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);

    $this->registerCssFile('@web/assets/css/style.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/css/responsive.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/css/jquery-ui.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
    $this->registerCssFile('@web/assets/datatables/datatables.min.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);

    ?>
</head>

<body>



    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div style="background-image:url( <?= $url ?>assets/images/fondo-suscripcion-1.png); background-repeat: round;" class="modal-content bg" >

                <div class="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="">
                    <div class="text-center">
                        <img class="dimage" src="<?= $url ?>/assets/images/logotipo-inicio-sesion-blanco.svg" alt="">
                    </div>
                    <?= Html::beginForm(Url::toRoute("site/registrar"), "POST", ['id' => 'form-registrar']) ?>
                    <div class="heading_s1 text-center">
                        <h4 class="colwhite">FORMULARIO DE REGISTRO</h4>
                    </div>
                    <div class="row">

                        <div class="">

                            <div class="form-row">
                                <div class="col">
                                    <span>Nombres</span>
                                    <input type="text" required class="form-control rinput" name="nombre" placeholder="Ingresa su Nombre" required>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <span>Apellidos</span>
                                        <input type="text" required class="form-control rinput" name="apellidos" placeholder="Ingresa sus Apellidos" required>
                                    </div>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col">
                                    <span>RUT</span>
                                    <input type="text" required class="form-control rinput" id="rut" oninput="checkRut(this)" name="rut" placeholder="Ingrese su RUT" required>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <span>Correo Electrónico</span>
                                        <input class="form-control rinput" required type="email" name="email" placeholder="Ingrese su Correo Electrónico">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="form-row">
                                <div class="col">
                                    <span>Comuna</span>
                                    <div class="custom_select">
                                        <select class="form-control rinput" required name="comuna" id="comuna">
                                            <option value="#">Seleccione comuna</option>
                                            <option value="Cerrillos">Cerrillos</option>
                                            <option value="Cerro Navia">Cerro Navia</option>
                                            <option value="Conchalí">Conchalí</option>
                                            <option value="El Bosque">El Bosque</option>
                                            <option value="Estación Central">Estación Central</option>
                                            <option value="Huechuraba">Huechuraba</option>
                                            <option value="Independencia">Independencia</option>
                                            <option value="La Cisterna">La Cisterna</option>
                                            <option value="La Florida">La Florida</option>
                                            <option value="La Granja">La Granja</option>
                                            <option value="La Pintana">La Pintana</option>
                                            <option value="La Reina">La Reina</option>
                                            <option value="Las Condes">Las Condes</option>
                                            <option value="Lo Barnechea">Lo Barnechea</option>
                                            <option value="Lo Espejo">Lo Espejo</option>
                                            <option value="Lo Prado">Lo Prado</option>
                                            <option value="Macul">Macul</option>
                                            <option value="Maipú">Maipú</option>
                                            <option value="Ñuñoa">Ñuñoa</option>
                                            <option value="Pedro Aguirre Cerda">Pedro Aguirre Cerda</option>
                                            <option value="Peñalolén">Peñalolén</option>
                                            <option value="Providencia">Providencia</option>
                                            <option value="Pudahuel">Pudahuel</option>
                                            <option value="Quilicura">Quilicura</option>
                                            <option value="Quinta Normal">Quinta Normal</option>
                                            <option value="Recoleta">Recoleta</option>
                                            <option value="Renca">Renca</option>
                                            <option value="San Joaquín">San Joaquín</option>
                                            <option value="San Miguel">San Miguel</option>
                                            <option value="San Ramón">San Ramón</option>
                                            <option value="Vitacura">Vitacura</option>
                                            <option value="Puente Alto">Puente Alto</option>
                                            <option value="Pirque">Pirque</option>
                                            <option value="San José de Maipo">San José de Maipo</option>
                                            <option value="Colina">Colina</option>
                                            <option value="Lampa">Lampa</option>
                                            <option value="TilVl">TilVl</option>
                                            <option value="San Bernardo">San Bernardo</option>
                                            <option value="Buin">Buin</option>
                                            <option value="Calera de Tango">Calera de Tango</option>
                                            <option value="Paine">Paine</option>
                                            <option value="Melipilla">Melipilla</option>
                                            <option value="Alhué">Alhué</option>
                                            <option value="Curacaví">Curacaví</option>
                                            <option value="María Pinto">María Pinto</option>
                                            <option value="San Pedro">San Pedro</option>
                                            <option value="Talagante">Talagante</option>
                                            <option value="El Monte">El Monte</option>
                                            <option value="Isla de Maipo">Isla de Maipo</option>
                                            <option value="Padre Hurtado">Padre Hurtado</option>
                                            <option value="Peñaflor">Peñaflor</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <span>Calle principal</span>
                                        <input type="text" class="form-control rinput" name="calle_principal" required="asdasdas" placeholder="Ingrese su Dirección">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <span>Numeración</span>
                                    <input class="form-control rinput" required type="text" name="numeracion" placeholder="Ingrese su Numeración">
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <span>Teléfono</span>
                                        <input class="form-control rinput" required type="text" name="telefono" placeholder="Ingrese su Teléfono *">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <span>Contraseña</span>
                                    <input class="form-control rinput" required type="password" placeholder="Ingrese su Contraseña" id="password" name="password">
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <span>Repetir Contraseña</span>
                                        <input class="form-control rinput" required type="password" placeholder="Repita su Contraseña" id="password2" name="password2">
                                        <b id="coincidencia" class="text-danger">ESTAS CONTRASEÑAS NO COINCIDEN</b>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group ">
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" name="terminos" required id="terminos">
                            <label class="form-check-label label_info" for="terminos"><span class="colwhite">ACEPTO LOS <a class="text-orange" target="_blank" href="index.php?r=site/terminos">TERMINOS Y CONDICIONES</a></span></label>
                        </div>
                    </div>
                    <div class="form-group ">
                        <button id="registrar" class="btn btn-orange  btn-block text-center">REGISTRARSE</button>
                        <button type="button" class="btn ml btn-secondary btn-block text-center" data-dismiss="modal">Cerrar</button>
                    </div>
                    <?= Html::endForm() ?>

                </div>

            </div>
        </div>
    </div>



    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TB6KTFF" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
    if (isset($_GET["al"])) { ?>
        <input type="hidden" id="alerta" value="<?= $_GET["al"] ?>">
    <?php } ?>

    <?php $this->beginBody() ?>
    <!-- START HEADER -->
    <header class="header_wrap fixed-top header_with_topbar">
        <div class="top-header">
            <div>
                <img src="<?= $url ?>/assets/images/tejas.svg" />
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex bd-highlight align-items-center justify-content-center justify-content-md-start">
                            <div class=" mr-2">
                                <!---  <h1>hoalasjdkasl</h1>--->
                            </div>
                            <div class="mr-3">

                            </div>
                            <!--- 
                            <ul class="contact_detail text-center text-lg-left">
                                <li><i class="ti-mobile"></i><span>+569 5700 1623</span></li>
                            </ul>--->
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="text-center text-md-right">
                            <ul class="header_list">
                                <?php if (!Yii::$app->user->isGuest) : ?>
                                    <?php if (User::isUserAdmin(Yii::$app->user->identity->id)) { ?>
                                        <li><a href="<?= Url::toRoute(['site/gestion']) ?>">Gestion Productos</a></li>
                                <?php }
                                endif; ?>
                                <?php if (Yii::$app->user->isGuest) : ?>
                                    <li><a href="" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="ti-pencil"></i><span>Registrarse</span></a></li>

                                    <li><a href="<?= Url::toRoute(['site/login']) ?>"><i class="ti-user"></i><span>Iniciar Sesión</span></a></li>
                                <?php endif; ?>
                                <?php if (!Yii::$app->user->isGuest) : ?>
                                    <li><a class="bcs"><?= Html::beginForm(['/site/logout'], 'post') . Html::submitButton(' <i class="fa fa-power-off"></i>Cerrar Sesión')   . Html::endForm() . '</a>' ?></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>






        <div class="bottom_header dark_skin main_menu_uppercase">

            <div class="container">

                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="<?= $url ?>">

                        <img class="logo_light" src="<?= $url ?>/assets/images/logo_light.png" alt="pescados y mariscos congelados" />
                        <img style=" width: 250px" class="logo_dark" src="<?= $url ?>/assets/images/logotipo-header.svg" alt="salmon premium" />
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false">
                        <span class="ion-android-menu"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li><a class="nav-link nav_item active" href="<?= $url ?>">INICIO</a></li>
                            <li><a class="nav-link nav_item" href="<?= Url::toRoute("site/nosotros") ?>">NOSOTROS</a></li>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="nav-link dropdown-toggle" href="<?= Url::toRoute("site/productos") ?>">PRODUCTOS</a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <li><a class="dropdown-item nav-link nav_item" href="<?= Url::toRoute("site/productos") ?>">todos los productos</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="<?= Url::toRoute(["site/filter", "categoria" => "pescados"]) ?>">pescados</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="<?= Url::toRoute(["site/filter", "categoria" => "mariscos"]) ?>">mariscos</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="<?= Url::toRoute(["site/filter", "categoria" => "queso y hortalizas"]) ?>">quesos y hortalizas</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="<?= Url::toRoute(["site/filter", "categoria" => "ahumados"]) ?>">ahumados</a></li>
                                    </ul>
                                </div>
                            </li>
                            <!-- <li><a class="nav-link nav_item" href="<?= Url::toRoute("site/promociones") ?>">PROMOCIONES</a></li> -->


                            <li><a class="nav-link nav_item" href="<?= Url::toRoute("site/contact") ?>">CONTACTO</a></li>
                        </ul>
                    </div>
                    <ul class="navbar-nav attr-nav align-items-center">

                        <?php if (Yii::$app->user->isGuest) { ?>

                            <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="<?= Url::toRoute(['site/cart']) ?>" data-toggle="dropdown"><i class="linearicons-cart"></i></a>
                                <div class="cart_box dropdown-menu dropdown-menu-right">

                                    <div class="cart_footer">
                                        <p class="cart_total"><strong>Inicia sesión para usar el carrito</strong></p>
                                        <p class="cart_buttons"><a href="<?= Url::toRoute(['site/login']) ?>" class="btn btn-fill-line btn-radius view-cart">Ingresar</a>


                                            <!-- <a href="<?= Url::toRoute(['site/register']) ?>" class="btn btn-fill-out btn-radius checkout">Registrarse</a> -->

                                            <button type="button" class="btn btn-fill-line btn-radius view-cart" data-toggle="modal" data-target=".bd-example-modal-lg">Registrarse</button>


                                        </p>


                                    </div>
                                </div>
                            </li>
                        <?php  } else { ?>
                            <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="<?= Url::toRoute(['site/cart']) ?>" data-toggle="dropdown"><i class="linearicons-cart"></i></a>
                                <div class="cart_box dropdown-menu dropdown-menu-right">

                                    <div class="cart_footer">
                                        <?php
                                        $subtotal = 0;
                                        $c = Carrito::find()->where(["user" => Yii::$app->user->identity->id])->all();
                                        foreach ($c as $row) :
                                            $precio = Product::findOne($row->producto_id);
                                            $subtotal = $subtotal + $precio->precio * $row->cantidad;

                                        endforeach;

                                        ?>
                                        <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">$</span></span><?= number_format($subtotal, 0, ".", ".") ?></p>

                                        <p class="cart_buttons"><a href="<?= Url::toRoute(['site/cart']) ?>" class="btn btn-fill-line btn-radius view-cart">Ver Carrito</a><a href="<?= Url::toRoute(['site/buy']) ?>" class="btn btn-fill-out btn-radius checkout">Pagar</a></p>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!-- END HEADER -->
    <div class="preloader">
        <div class="lds-ellipsis">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="wrap">



        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <?= $content ?>

    </div>
    <!-- logo wsp -->
    <a href="whatsapp://send?text=Hola!&amp;phone=+56957001623&amp;abid=+56957001623">
        <a href="https://wa.me/56957001623?text=Hola!">
            <div class="wsp hvr-push" style="background-image:url( <?= $url ?>assets/images/icons/wsp.png); background-repeat: no-repeat; background-size: 100% 100%;">

            </div>
        </a>

    </a>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v7.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="1014628098699972" theme_color="#0084ff" logged_in_greeting="Hola!, como podemos ayudarte? :)" logged_out_greeting="Hola!, como podemos ayudarte? :)">
    </div>
    <!-- START FOOTER horizontal -->
    <footer class="footer_dark footer-1" style="border-top: 1px solid #454646 !important">
        <div class="" style="padding-top: 50px">
            <div class="container">
                <div class="row">
                    <div class="col-md text-center">
                        <h6 class="text-center text-uppercase" style="padding-bottom: 30px">Gracias por su preferencia</h5>
                            <img style="width: 50%;" src="<?= $url ?>/assets/images/isologo-footer.svg" alt="logo" />
                    </div>
                    <div class=" text-center col-md-6 flex-row">
                        <h6 class="text-uppercase pfooter">¿Algo que decir?</h6><br>
                        <span><b>Servicio al cliente:</b> Horario 09:30 a 20hrs.</span><br>
                        <span><b>Teléfono:</b> +569 5700 1623</span><br>
                        <span><b>Correo:</b> ventas@locosxchiloe.cl</span>

                    </div>

                    <div class="col-md text-center">
                        <h6 class="text-uppercase">Paga con:</h6>
                        <div>
                            <img src="<?= $url ?>/assets/images/wp_lg.png" alt="logo" />
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="container" style="padding-top: 30px;border-top: 1px solid #454646 !important">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="contact_info contact_info_light">

                            <a target="_blank" href="https://www.instagram.com/locosxchiloe/"> <span class="text-uppercase">Buscanos en nuestras redes sociales:</span><br>

                                <i style="font-size: 2.1em; color: white;" class="ti-instagram"></i>

                            </a>
                            &nbsp;&nbsp;
                            <a target="_blank" href="https://www.facebook.com/LocosxChiloe/">
                                <i style="font-size: 2.4em; color: white;" class="fab fa-facebook-square"></i>
                            </a>
                        </ul>

                    </div>
                    <div class=" text-center col-md-4 flex-row">
                        <h6> <a class="nav-link nav_item" href="<?= Url::toRoute(['site/terminos']) ?>">TERMINOS Y CONDICIONES</a></h6>

                    </div>

                    <div class="col-md-4 text-right">
                        <span class="text-uppercase">Todos los derechos reservados a <span style="color:rgb(222, 113, 15);">Locosxchiloe</span></span>

                    </div>
                </div>
            </div>

        </div>

    </footer>

    <!-- START FOOTER vertical -->
    <footer class="footer_dark footer-2">
        <img class="logo_blanco" src="<?= $url ?>/assets/images/logo_light.png" alt="mariscos" />

        <div class="footer_top">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="widget">
                            <h6 class="widget_title">CONTACTA CON NOSOTROS</h6>
                            <ul class="contact_info contact_info_light">
                                <li>
                                    <i style="color:rgb(222, 113, 15);" class="ti-help-alt"></i>
                                    <p>Servicio a cliente <br> Horario: 09:30 a 20hrs.</p>
                                </li>
                                <li>
                                    <i style="color:rgb(222, 113, 15);" class="ti-email"></i>
                                    <a href="ventas@locosxchiloe.cl">ventas@locosxchiloe.cl</a>
                                </li>
                                <li>
                                    <i style="color:rgb(222, 113, 15);" class="ti-mobile"></i>
                                    <p>+569 5700 1623</p>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <div class="widget">
                            <h6 class="widget_title">ENLACES</h6>
                            <ul class="widget_links">
                                <li><a href="<?= $url ?>">Inicio</a></li>
                                <li><a href="<?= Url::toRoute("site/nosotros") ?>">Nosotros</a></li>
                                <li><a href="<?= Url::toRoute("site/productos") ?>">Productos</a></li>
                                <!-- <li><a href="<?= Url::toRoute("site/promociones") ?>">Promociones</a></li> -->
                                <li><a href="<?= Url::toRoute("site/contact") ?>">Contacto</a></li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <img class="paypal" src="<?= $url ?>/assets/images/wp_lg.png" alt="logo">
    </footer>

    <!-- END FOOTER -->
    <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>
    <?php $this->registerJsFile('@web/assets/js/jquery-ui.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>

    <?php $this->registerJsFile('@web/assets/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>

    <!-- popper min js -->
    <?php $this->registerJsFile('@web/assets/js/popper.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>

    <!-- owl-carousel min js  -->
    <?php $this->registerJsFile('@web/assets/owlcarousel/js/owl.carousel.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <!-- magnific-popup min js  -->
    <?php $this->registerJsFile('@web/assets/js/magnific-popup.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <!-- waypoints min js  -->
    <?php $this->registerJsFile('@web/assets/js/waypoints.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <!-- parallax js  -->
    <?php $this->registerJsFile('@web/assets/js/parallax.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <!-- countdown js  -->
    <?php $this->registerJsFile('@web/assets/js/jquery.countdown.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <!-- fit video  -->
    <?php $this->registerJsFile('@web/assets/js/Hoverparallax.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <!-- imagesloaded js -->
    <?php $this->registerJsFile('@web/assets/js/imagesloaded.pkgd.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <!-- isotope min js -->
    <?php $this->registerJsFile('@web/assets/js/isotope.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <!-- jquery.appear js  -->
    <?php $this->registerJsFile('@web/assets/js/jquery.appear.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <!-- jquery.dd.min js -->
    <?php $this->registerJsFile('@web/assets/js/jquery.dd.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <!-- slick js -->
    <?php $this->registerJsFile('@web/assets/js/slick.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <!-- elevatezoom js -->
    <?php $this->registerJsFile('@web/assets/js/jquery.elevatezoom.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <!-- scripts js -->
    <?php $this->registerJsFile('@web/assets/js/sweetalert2.all.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>

    <?php $this->registerJsFile('@web/assets/js/scripts.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <?php $this->registerJsFile('@web/assets/js/ajustes.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>


<style>
    .bg {
        background-image: url('/assets/images/fondo-suscripcion-1.png');

        background-repeat: round;
        border: 10px solid white;
        border-radius: 30px;
        padding: 30px;
    }

    .colwhite {
        color: white;
    }

    span {
        padding: 10px;
    }

    .dimage {
        max-width: 50%;
        padding-bottom: 40px;
    }

    .rinput {
        border-radius: 30px;
    }

    .ml {
        margin-left: 0px !important;
    }

    .pad15 {
        padding: 15px;
    }

    .bcs {
        border-radius: 10px;
        background-color: black;
        color: white;
    }
</style>