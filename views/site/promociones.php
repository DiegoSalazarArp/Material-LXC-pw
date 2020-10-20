<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Product;
use app\models\Categorias;

$this->title = 'Promociones | LocosxChiloe';

?>
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-0">
                    <div class="sidebar">
                        <div class="widget">
                            <h5 class="widget_title">Categorias</h5>
                            <ul class="widget_categories">
                                <?php $p = new Product; ?>
                                <?php $count = $p->find()->where(["active" => 1])->andWhere(["padre" => 0])->count(); ?>

                                <li><a href="<?= Url::toRoute("site/productos") ?>"><span class="categories_name">Todos los Productos</span><span class="categories_num">(<?= $count ?>)</span></a></li>
                                <?php $cat = new Categorias; ?>
                                <?php $c = $cat->find()->all();

                                foreach ($c as $row) :
                                ?>
                                    <?php $count = $p->find()->where(["active" => 1])->andWhere(["padre" => 0])->andWhere(["categoria" => $row->categoria])->count(); ?>

                                    <li><a href="<?= Url::toRoute("site/filter") ?>?categoria=<?= $row->categoria ?>"><span class="categories_name"><?= $row->categoria ?></span><span class="categories_num">(<?= $count ?>)</span></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!--
                        <div class="widget">
                            <div class="shop_banner">
                                <div class="banner_img overlay_bg_20">
                                    <img src="assets/images/sidebar_banner_img.jpg" alt="sidebar_banner_img">
                                </div>
                                <div class="shop_bn_content2 text_white">
                                    <h5 class="text-uppercase shop_subtitle">New Collection</h5>
                                    <h3 class="text-uppercase shop_title">Sale 30% Off</h3>
                                    <a href="#" class="btn btn-white rounded-0 btn-sm text-uppercase">Shop Now</a>
                                </div>
                            </div>
                        </div>
                                -->
                    </div>
                </div>
                <!-- Large modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".iniciar-sesion">Iniciar Sesión</button>

                <div class="modal fade iniciar-sesion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content bg">

                            <!-- Aquí va la sección del modal: Registro -->
                            <div class="">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="">
                                <div class="text-center">
                                    <img class="dimage" src="<?= $url ?>/assets/images/logotipo-inicio-sesion-blanco.svg" alt="">
                                </div>
                                <div class="heading_s1 text-center">
                                    <h4 class="colwhite">INICIO DE SESIÓN</h4>
                                </div>
                                <div class="">
                                    <div class="">
                                        <span>Correo Electrónico</span>
                                        <input type="text" required class="form-control rinput" name="Ingrese su correo electrónico" placeholder="Ingresa su Nombre" required>


                                        <div class="">
                                            <span>Contraseña</span>
                                            <input type="text" required class="form-control rinput" name="Ingrese su contraseña" placeholder="Ingresa sus Apellidos" required>
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="form-group ">
                                        <label class="form-check-label label_info" for="terminos"><span class="colwhite">¿NO TIENES CUENTA? <a class="text-orange" target="_blank" href="/">REGISTRATE AHORA</a></span></label>
                                </div>
                                <div class="form-group ">
                                    <button id="registrar" class="btn btn-orange  btn-block text-center">INICIAR SESIÓN</button>
                                    <button type="button" class="btn ml btn-secondary btn-block text-center" data-dismiss="modal">Cerrar</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>



                <div class="col-md-9 col-xs-12">
                    <div class="row align-items-center mb-4 pb-1">
                        <div class="col-12">
                            <div class="product_header">
                                <div class="product_header_left">
                                    <div class="custom_select">
                                        <?= Html::beginForm(Url::toRoute("site/promociones"), "GET") ?>
                                        <select name="order" onchange="this.form.submit()" class="form-control form-control-sm">
                                            <option value="#">Seleccione Orden</option>
                                            <option value="date">Ordenar Por Fecha</option>
                                            <option value="alphabetic">Ordenar Alfaveticametnte</option>
                                            <option value="price">Ordenar Por Precio Mas Bajo</option>
                                            <option value="price-desc">Ordenar Por Precio Mas Alto</option>
                                        </select>
                                        <?= Html::endForm() ?>
                                    </div>
                                </div>
                                <div class="product_header_right">
                                    <div class="products_view">
                                        <a href="javascript:Void(0);" class="shorting_icon grid"><i class="ti-view-grid"></i></a>
                                        <a href="javascript:Void(0);" class="shorting_icon list active"><i class="ti-layout-list-thumb"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row shop_container list">
                        <?php foreach ($productos as $row) : ?>
                            <div class="col-lg-3 col-md-4 col-6">
                                <div class="product">
                                    <div class="product_img">
                                        <a href="<?= Url::toRoute(["site/product"]) ?>?prdctid=<?= $row->id ?>">
                                            <img src="<?= $row->foto_principal ?>" class="img-thumbnail" alt="<?= $row->categoria ?>">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <?php if ($row->stock > 0) : ?>
                                                    <li class="add-to-cart"><a href="<?= Url::toRoute(["site/addtocart", "product" => $row->id]) ?>"><i class="icon-basket-loaded"></i>Agregar Al Carrito</a></li>
                                                <?php endif; ?>
                                                <li><a href="<?= Url::toRoute(["site/product"]) ?>?prdctid=<?= $row->id ?>"><i class="icon-magnifier-add"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="<?= Url::toRoute(["site/product"]) ?>?prdctid=<?= $row->id ?>"><?= $row->nombre ?></a></h6>
                                        <div class="product_price">
                                            <span class="price">$<?= number_format($row->precio, 0, ".", ".") ?></span>

                                        </div>

                                        <div class="pr_desc">
                                            <p><?= $row->descripcion ?></p>
                                        </div>
                                        <div class="pr_switch_wrap">

                                        </div>
                                        <div class="list_product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <?php if ($row->stock > 0) : ?>
                                                    <li class="add-to-cart"><a href="<?= Url::toRoute(["site/addtocart", "product" => $row->id]) ?>"><i class="icon-basket-loaded"></i> Agregar Al Carrito</a></li>
                                                <?php else : ?>
                                                    <li class="add-to-cart"><a><i class="icon-basket-loaded"></i> Agotado</a></li>
                                                <?php endif; ?>
                                                <li><a href="<?= Url::toRoute(["site/product"]) ?>?prdctid=<?= $row->id ?>" class=""><i class="icon-magnifier-add"></i></a></li>
                                            </ul>
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
</div>


<?php $this->registerJsFile('@web/assets/js/rut.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>


<style>
    .bg {
        background-image: url('/assets/images/fondo-productos-destacados.png');

        background-repeat: round;
        border: 10px solid white;
        border-radius: 30px;
        padding: 30px;
    }

    .colwhite {
        color: white;
    }

    span {
        color: white;
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
</style>