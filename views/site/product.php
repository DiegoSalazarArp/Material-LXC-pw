<?php

use app\models\Product;
use yii\db\Expression;
use yii\helpers\Url;
use yii\helpers\Html;


$this->title = $producto->nombre . ' | LocosxChiloé';
$url = "";
if (isset($_SERVER['HTTPS'])) {
    $url = "https://" . $_SERVER['SERVER_NAME'] . "/";
} else {
    $url = "http://" . $_SERVER['SERVER_NAME'] . "/";
}
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
    </div>


    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                    <div class="product-image">
                        <div class="br product_img_box">
                            <img class="br" src='<?= $producto->foto_principal ?>' alt="product_img1" />

                        </div>
                        <!-- <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-slides-to-show="4" data-slides-to-scroll="1" data-infinite="false">
                            <div class="item">
                                <a href="#" class="product_gallery_item active" data-image="<?= $producto->foto_principal ?>" data-zoom-image="<?= $producto->foto_principal ?>">
                                    <img src="<?= $producto->foto_principal ?>" alt="<?= $producto->categoria ?>" />
                                </a>
                            </div>
                            <?php /*
                            $g = json_decode($producto->galeria);
                            foreach ($g as $row) :
                            ?>
                                <div class="item">
                                    <a href="#" class="product_gallery_item" data-image="<?= $row->foto ?>" data-zoom-image="<?= $row->foto ?>">
                                        <img src="<?= $row->foto ?>" alt="<?= $producto->categoria ?>" />
                                    </a>
                                </div>
                            <?php endforeach; */ ?>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="pr_detail">
                        <div class="product_description">
                            <h4 class="product_title backtitle text-uppercase"><a style="color:white;" href="#"><?= $producto->nombre ?></a></h4>



                            <div class="pr_desc">
                                <p class="colorP">DESCRIPCION DEL PRODUCTO:</p>

                                <p><?= $producto->descripcion ?></p>
                            </div>
                            <br>




                        </div>

                        <hr />

                        <div class="product_price" style="float: none;">
                            <span class="price">$<?= number_format($producto->precio, 0, ".", ".") ?></span>

                        </div>
                        <div class="cart_extra">
                            <div class="cart-product-quantity">
                                <form action="<?= Url::toRoute(['site/product']) ?>" method="get">
                                    <select onchange="this.form.submit();" name="prdctid" class="form-control" id="">
                                        <?php $p = new Product; ?>

                                        <?php if ($producto->padre == 0) { ?>
                                            <option value="<?= $producto->id ?>" selected> <?= $producto->nombre ?></option>
                                            <?php $prd = $p->find()->where(["padre" => $producto->id])->orderBy(['nombre' => SORT_ASC])->all();
                                            foreach ($prd as $row) : ?>

                                                <option value="<?= $row->id ?>"><?= $row->nombre ?></option>
                                            <?php endforeach;
                                        } else {
                                            $padre = $p->findOne($producto->padre);
                                            ?>
                                            <?php $prd = $p->find()->where(["padre" => $producto->padre])->orderBy(['nombre' => SORT_ASC])->all(); ?>
                                            <option value="<?= $padre->id ?>"> <?= $padre->nombre ?></option>

                                            <?php foreach ($prd as $row) : ?>
                                                <?php if ($producto->id == $row->id) { ?>
                                                    <option value="<?= $row->id ?>" selected><?= $row->nombre ?></option>

                                                <?php } else { ?>
                                                    <option value="<?= $row->id ?>"><?= $row->nombre ?></option>

                                                <?php } ?>
                                            <?php endforeach; ?>


                                        <?php } ?>
                                    </select>
                                </form>
                            </div>
                            <div class="cart_btn">
                                <?php if ($producto->stock > 0) : ?>
                                    <a href="<?= Url::toRoute(['site/addtocart', 'product' => $producto->id]) ?>" class="btn btn-fill-out btn-radius comprar"><i class="icon-basket-loaded"></i> Comprar</a>
                                <?php else : ?>
                                    <button class="btn btn-fill-out bloqueado btn-radius"><i class="icon-basket-loaded"></i>Agotado</button>

                                <?php endif; ?>


                            </div>
                        </div>
                        <hr />


                    </div>
                </div>
            </div>

            <!-- <div class="row">
                <div class="col-12">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Descripción</a>
                            </li>

                        </ul>
                        <div class="tab-content shop_info_tab">
                            <div class="tab-pane fade show active" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                                <p><?= $producto->descripcion ?></p>
                            </div>


                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-12">
                    <div class="small_divider"></div>
                    <div class="divider"></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 row justify-content-center">
                    <div class="col-md-4 text-center">
                        <img class="iconDim" src="<?= $url ?>/assets/images/estrellas-oscuras.svg" alt="">
                    </div>
                    <div class="col-md-4 text-center">
                        <h3 class="text-center" style="font-size:25px;">PRODUCTOS RELACIONADOS</h3>
                    </div>
                    <div class="col-md-4 text-center">
                        <img class="iconDim" src="<?= $url ?>/assets/images/estrellas-oscuras.svg" alt="">
                    </div>

                </div>
                <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                    <?php $r = new Product;
                    $rel = $r->find()->where(["categoria" => $producto->categoria])->andWhere(["padre" => 0])->orderBy(new Expression('rand()'))->all();
                    foreach ($rel as $row) :
                    ?>
                        <div class="item">
                            <div class="product">
                                <div class="product_img br">
                                    <a href="<?= Url::toRoute(["site/product", "prdctid" => $row->id]) ?>">
                                        <img src="<?= $row->foto_principal ?>" alt="<?= $row->categoria ?>">
                                    </a>
                                    <div class="product_action_box">
                                        <!-- <ul class="list_none pr_action_btn">
                                            <?php if ($row->stock > 0) : ?>

                                                <li class="add-to-cart"><a href="<?= Url::toRoute(["site/addtocart", "product" => $row->id]) ?>"><i class="icon-basket-loaded"></i> Agregar al Carrito</a></li>
                                            <?php endif; ?>
                                            <li><a href="<?= Url::toRoute(["site/product", "prdctid" => $row->id]) ?>" class=""><i class="icon-magnifier-add"></i></a></li>
                                        </ul> -->
                                    </div>
                                </div>
                                <div class="product_info text-center">
                                    <h6 class="product_title"><a class="text-center text-uppercase " href="<?= Url::toRoute(["site/product", "prdctid" => $row->id]) ?>"><?= $row->nombre ?></a></h6>
                                    <div class="product_price">
                                        <span class="price">$<?= number_format($row->precio, 0, ".", ".") ?></span>

                                    </div>

                                    <div class="pr_desc">
                                        <p><?= $row->descripcion ?></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
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
<!-- END SECTION SHOP -->



</div>


<style>
    .iconDim {
        width: 100px;
    }

    .sectpadd {
        padding: 50px;
    }

    .br {
        border-radius: 50px;
    }

    .colorP {
        color: rgb(222, 113, 15);
        font-size: 16px;
    }

    .comprar {
        border: 1px solid black;
    }

    .backtitle {
        background-color: black;
        border-radius: 20px;
        padding: 10px;
    }
</style>