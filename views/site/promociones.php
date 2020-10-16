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
                                                    <li class="add-to-cart"><a href="<?= Url::toRoute(["site/addtocart","product"=>$row->id]) ?>"><i class="icon-basket-loaded"></i>Agregar Al Carrito</a></li>
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
                                                    <li class="add-to-cart"><a href="<?= Url::toRoute(["site/addtocart","product"=>$row->id]) ?>"><i class="icon-basket-loaded"></i> Agregar Al Carrito</a></li>
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