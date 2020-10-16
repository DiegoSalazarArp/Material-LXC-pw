<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\db\Expression;

$this->title = 'Mi Carrito | LocosxChiloé';

?>
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive shop_cart_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Producto</th>
                                    <th class="product-price">Precio</th>
                                    <th class="product-quantity">Cantidad</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Quitar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $p = new Product;
                                $bloquear = 0;

                                foreach ($productos as $row) :

                                    $prod = $p->findOne($row->producto_id);


                                ?>
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img src="<?= $prod->foto_principal ?>"></a></td>
                                        <td class="product-name" data-title="Product"><a href="#"><?= $prod->nombre ?></a></td>
                                        <td class="product-price" data-title="Price">$<?= number_format($prod->precio, 0, ".", ".") ?></td>
                                        <?php if ($prod->stock < 1) : ?>
                                            <?php $bloquear = 1; ?>
                                            <td class="product-quantity" data-title="Quantity"> <b class="text-danger">Sin stock</b></td>
                                        <?php else : ?>
                                            <td class="product-quantity" data-title="Quantity"><?= $row->cantidad ?></td>
                                        <?php endif; ?>
                                        <td class="product-subtotal" data-title="Total">$<?= number_format($row->cantidad * $prod->precio, 0, ".", ".") ?></td>
                                        <td class="product-remove" data-title="Remove"><a href="<?= Url::toRoute(['site/removep', "id" => $prod->id]) ?>"><i class="ti-close"></i>
                                            </a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="px-0">
                                        <div class="row no-gutters align-items-center">

                                            <div class="col-lg-4 col-md-6 mb-3 mb-md-0">

                                            </div>
                                            <div class="col-lg-8 col-md-6 text-left text-md-right">
                                                <?php if ($bloquear > 0) : ?>
                                                    <button class="btn btn-line-fill btn-sm bloqueado">Finalizar Pago</button>
                                                <?php else : ?>
                                                    <a href="<?= Url::toRoute(['site/buy']) ?>"><button class="btn btn-line-fill btn-sm" type="submit">Finalizar Pago</button></a>
                                                <?php endif; ?> </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="heading_s1">
                        <h3>Productos Relacionados</h3>
                    </div>
                    <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                        <?php $r = new Product;
                        $rel = $r->find()->where(["active" => 1])->andWhere(["padre" => 0])->orderBy(new Expression('rand()'))->all();
                        foreach ($rel as $row) :
                        ?>
                            <div class="item">
                                <div class="product">
                                    <div class="product_img">
                                        <a href="<?= Url::toRoute(["site/product", "prdctid" => $row->id]) ?>">
                                            <img src="<?= $row->foto_principal ?>" alt="<?= $row->categoria ?>">
                                        </a>
                                        <div class="product_action_box">
                                            <ul class="list_none pr_action_btn">
                                                <?php if ($row->stock > 0) : ?>

                                                    <li class="add-to-cart"><a href="<?= Url::toRoute(["site/addtocart", "product" => $row->id]) ?>"><i class="icon-basket-loaded"></i> Agregar al Carrito</a></li>
                                                <?php endif; ?>
                                                <li><a href="<?= Url::toRoute(["site/product", "prdctid" => $row->id]) ?>" class=""><i class="icon-magnifier-add"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_info">
                                        <h6 class="product_title"><a href="<?= Url::toRoute(["site/product", "prdctid" => $row->id]) ?>"><?= $row->nombre ?></a></h6>
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
    </div>
    <!-- END SECTION SHOP -->

</div>