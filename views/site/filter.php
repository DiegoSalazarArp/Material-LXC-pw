<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Categorias;
use app\models\Product;

$this->title = $categoria . ' | Locosxchiloe';

?>
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section" style="background-repeat: round; background-image: url('/assets/images/slider-productos1.png');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <h1 class="text-center text-uppercase" style="color:white;">Nuestros productos</h1>
                </div>
            </div>
        </div>
    </div>


    <div class="sectpadd">
        <div class="container">
            <h2 class="text-center">CATEGORÍAS</h2>
            <div class="row justify-content-center">
                <div class="col-md-2 text-center  p-4">

                    <?php $p = new Product; ?>
                    <?php $count = $p->find()->where(["active" => 1])->andWhere(["padre" => 0])->count(); ?>

                    <a class="text-center" href="<?= Url::toRoute("site/productos") ?>">
                        <img class="iconDim" src="<?= $url ?>/assets/images/categorias_productos1/servicios1.svg" alt=""> <br>
                        <span class="categories_name text-uppercase">Todos los Productos</span>
                    </a>

                </div>
                <div class="col-md-2 text-center  p-4">

                    <a class="text-center" href="<?= Url::toRoute("site/filter") ?>?categoria=Pescados">
                        <img class="iconDim" src="<?= $url ?>/assets/images/categorias_productos1/pescado1.svg" alt=""> <br>
                        <span class="categories_name text-uppercase">Pescados</span>

                    </a>

                </div>

                <div class="col-md-2 text-center p-4">

                    <a class="text-center" href="<?= Url::toRoute("site/filter") ?>?categoria=Mariscos">
                        <img class="iconDim" src="<?= $url ?>/assets/images/categorias_productos1/almeja1.svg" alt=""> <br>
                        <span class="categories_name text-uppercase">Mariscos</span>

                    </a>

                </div>

                <div class="col-md-2 text-center p-4">

                    <a class="text-center" href="<?= Url::toRoute("site/filter") ?>?categoria=Queso y Hortalizas">
                        <img class="iconDim" src="<?= $url ?>/assets/images/categorias_productos1/queso1.svg" alt=""> <br>
                        <span class="categories_name text-uppercase">Quesos y Hortalizas</span>

                    </a>

                </div>

                <div class="col-md-2 text-center p-4">

                    <a class="text-center" href="<?= Url::toRoute("site/filter") ?>?categoria=Ahumados">
                        <img class="iconDim" src="<?= $url ?>/assets/images/categorias_productos1/plato-caliente1.svg" alt=""> <br>
                        <span class="categories_name text-uppercase">Ahumados</span>

                    </a>

                    <div class="col-md-2 text-center p-4">
                    </div>


                </div>
            </div>
        </div>



        <div class="">
            <div class="container">
                <div class="row">
                    <!-- <div class="col-md-3">
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
                                
                    </div>
                </div> -->
                    <div class="col-md-12">
                        <div class="row align-items-center mb-4 pb-1">
                            <div class="col-12">
                                <hr>

                                <div class="product_header">
                                    <div class="product_header_left">
                                        <div class="custom_select">
                                            <?= Html::beginForm(Url::toRoute("site/filter"), "GET") ?>
                                            <input type="hidden" name="categoria" value="<?= $categoria ?>">
                                            <select name="order" onchange="this.form.submit()" class="form-control form-control-sm border-rounded">
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
                                        <div class="product_header_right">
                                            <div class="products_view">
                                                <!-- <a href="javascript:Void(0);" class="shorting_icon grid border-rounded"><i class="ti-view-grid"></i></a> -->
                                                <a href="javascript:Void(0);" class="shorting_icon list active border-rounded"><i class="ti-layout-list-thumb"></i></a>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row shop_container list containerR">
                            <?php foreach ($productos as $row) : ?>
                                <div class="col-lg-3 col-md-4 col-6 minWidth">
                                    <div class="product">
                                        <div class="product_img">
                                            <a href="<?= Url::toRoute(["site/product", "prdctid" => $row->id]) ?>">
                                                <img src="<?= $row->foto_principal ?>" class="img-thumbnail border-rounded" alt="<?= $row->categoria ?>">
                                            </a>
                                            <div class="product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <?php if ($row->stock > 0) : ?>
                                                        <li class="add-to-cart"><a href="<?= Url::toRoute(["site/addtocart", "product" => $row->id]) ?>"><i class="icon-basket-loaded"></i>Agregar Al Carrito</a></li>
                                                    <?php endif; ?>
                                                    <li><a href="<?= Url::toRoute(["site/product", "prdctid" => $row->id]) ?>"><i class="icon-magnifier-add"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_title tamañoTitulo text-uppercase"><a class="titul" href="<?= Url::toRoute(["site/product", "prdctid" => $row->id]) ?>"><?= $row->nombre ?></a></h6>


                                            <div class="pr_desc">
                                                <p class="colorP">DESCRIPCION DEL PRODUCTO:</p>

                                                <p><?= $row->descripcion ?></p>
                                            </div>
                                            <div class="product_price">
                                                <span class="price">$<?= number_format($row->precio, 0, ".", ".") ?></span>

                                            </div>
                                            <div class="pr_switch_wrap">

                                            </div>
                                            <div class="list_product_action_box">
                                                <ul class="list_none pr_action_btn">
                                                    <?php if ($row->stock > 0) : ?>
                                                        <li class="add-to-cart"><a href="<?= Url::toRoute(["site/addtocart", "product" => $row->id]) ?>"><img class="iconDim" src="<?= $url ?>/assets/images/carro-de-compra.svg" alt=""></a></li>
                                                    <?php else : ?>
                                                        <li class="add-to-cart"><a><i class="agot"></i> Agotado</a></li>

                                                    <?php endif; ?>
                                                    <!-- <li><a href="<?= Url::toRoute(["site/product", "prdctid" => $row->id]) ?>" class=""><i class="icon-magnifier-add"></i></a></li> -->
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
    <div class="section " style="background-image: url('/assets/images/fondo-sus.png'); padding:85px 0;">
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
    .iconDim {
        width: 100px;
    }

    .sectpadd {
        padding: 50px;
    }


    .border-rounded {
        border-radius: 25px;
    }

    .colormedio {
        color: rgb(222, 113, 15);
    }

    .containerR {
        display: flex;
        flex-direction: row;
    }

    .minWidth {
        min-width: 50% ! important;
    }

    .tamañoTitulo {
        font-size: 15px;
    }


    .spanPrice {
        border: 1px solid red;
        padding: 3px 10px 3px 10px;
        border-radius: 30px;
    }


    .colorP {
        color: rgb(222, 113, 15);
        font-size: 16px;
    }

    .titul {
        font-size: 18px;
    }

    .agot{
        width: 80px;
        color: rgb(222, 113, 15);
        background-color: transparent;
    }
</style>