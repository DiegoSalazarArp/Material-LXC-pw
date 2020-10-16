<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Product;

?>
<div class="section">
    <div class="container">
      
     
        <div class="row">
            <div class="col-md-6">
                <div class="heading_s1">
                    <h4>Rellene los campos con sus datos</h4>
                </div>
                <?= Html::beginForm(Url::toRoute("site/cpay"), "POST", ['id' => 'pay']) ?>
                <div class="form-group">
                    <input type="text" required class="form-control"  name="nombre" value="" placeholder="Nombre*" required>
                </div>
                <div class="form-group">
                    <input type="text" required class="form-control"  name="apellidos" value="" placeholder="Apellidos *" required>
                </div>
                <div class="form-group">
                    <input type="text" required class="form-control"  id="rut" oninput="checkRut(this)" value="" name="rut" placeholder="RUT *" required>
                </div>


                <div class="form-group">
                    <div class="custom_select">
                        <select class="form-control" required name="comuna"  id="comuna">
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
                <div class="form-group">
                    <input type="text" class="form-control"  name="calle_principal" required="" value="" placeholder="Calle Principal *">
                </div>
               
                <div class="form-group">
                    <input class="form-control" required type="text"  name="numeracion" value="" placeholder="Numeración*">
                </div>


                <div class="form-group">
                    <input class="form-control" required type="text"  name="telefono" value="" placeholder="Telefono *">
                </div>
                <div class="form-group">
                    <input class="form-control" required type="email"  value="" name="email" placeholder="Correo Electrónico *">
                </div>
                <div class="form-group">
                    <input class="form-control" required  type="text" id="fecha" name="fecha" placeholder="Fecha de Entrega *">
                </div>
                <div class="heading_s1">
                    <h4>información Adicional</h4>
                </div>
                <div class="form-group mb-0">
                    <textarea rows="5" class="form-control" name="informacion" placeholder="Algún comentario para la entrega?"></textarea>
                </div>
                <input type="hidden" name="total" id="total">
                <button id="enviar" class="btn-white"></button>
                <?= Html::endForm() ?>

            </div>
            <div class="col-md-6">
                <div class="order_review">
                    <div class="heading_s1">
                        <h4>Tu Pedido</h4>
                    </div>
                    <div class="table-responsive order_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($carrito as $row) :
                                    $producto = Product::findOne($row->producto_id);
                                    $sumado=  $producto['precio']*$row->cantidad;
                                    $total = $total + $sumado;
                                ?>
                                    <tr>
                                        <td><?= $producto['nombre'] ?> <span class="product-qty">x <?= $row->cantidad ?></span></td>
                                        <td>$<?= number_format($sumado,0,".",".") ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SubTotal</th>
                                    <td class="product-subtotal">$<?= number_format($total,0,".",".") //$producto->precio ?></td>
                                </tr>

                                <tr>
                                    <th>Total</th>
                                    <td class="product-subtotal">$<?= number_format($total,0,".",".")//$producto->precio ?></td>
                               <input type="hidden" id="ptotal" value="<?= $total ?>">
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <button id="finalizar" form="pay" class="btn btn-fill-out btn-block">Finalizar Pedido</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJsFile('@web/assets/js/rut.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>