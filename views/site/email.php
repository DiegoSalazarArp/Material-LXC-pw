<?php

use app\models\Venta;
use app\models\Product;

$v = new Venta;
$venta = $v->find()->where(["orden_compra" => $orden])->one();
$nombre = explode(" ", $venta->nombre);
?>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
    <tbody>
        <tr>
            <td align="center" valign="top">
                <div id="m_-8314280984903415343m_5364710692626112803template_header_image">
                </div>
                <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_-8314280984903415343m_5364710692626112803template_container" style="background-color:#ffffff;border:1px solid #dedede;border-radius:3px">
                    <tbody>
                        <tr>
                            <td align="center" valign="top">

                                <table border="0" cellpadding="0" cellspacing="0" width="100%" id="m_-8314280984903415343m_5364710692626112803template_header" style="background-color:#ffffff;color:#DE710F;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;border-radius:3px 3px 0 0">
                                    <tbody>
                                        <tr>
                                            <td id="m_-8314280984903415343m_5364710692626112803header_wrapper" style="padding:36px 48px;display:block; height:57px;">
                                                <img style="height: 124px!important; position: absolute;" class="logo" src="https://locosxchiloe.cl/assets/images/logo_redondo.png" alt="logo" srcset="">
                                                <h1 style="position: absolute; margin-left: 13%; font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;text-align:left;color:#DE710F">Gracias por tu pedido</h1>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">

                                <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_-8314280984903415343m_5364710692626112803template_body">
                                    <tbody>
                                        <tr>
                                            <td valign="top" id="m_-8314280984903415343m_5364710692626112803body_content" style="background-color:#ffffff">

                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <td valign="top" style="padding:48px 48px 32px">
                                                                <div id="m_-8314280984903415343m_5364710692626112803body_content_inner" style="color:#636363;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">
                                                                    <h2 style="color:#DE710F;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">Hola <?= $nombre[0] ?></h2>


                                                                    <p style="margin:0 0 16px">Gracias por tu pedido. Está en espera hasta que confirmemos que se ha recibido el pago. Mientras tanto, aquí tienes un recordatorio de lo que has pedido:</p>

                                                                    <p style="margin:0 0 16px">Si necesitas contactar con nosotros escríbenos a <a href="mailto:ventas@locosxchiloe.cl" rel="noreferrer" target="_blank">ventas@locosxchiloe.cl</a> o al whatsapp +569 5700 1623</p>

                                                                    <h3 style="color:#DE710F;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:16px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">Datos de Entrega:</h3>
                                                                    <ul>
                                                                        <li>Fecha Entrega: <strong><?= $venta->entrega ?></strong>
                                                                        </li>
                                                                        <li>Número orden: <strong>#<?= $orden ?></strong>
                                                                        </li>
                                                                    </ul>
                                                                    <h2 style="color:#DE710F;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">
                                                                        Detalle Pedido:</h2>

                                                                    <div style="margin-bottom:40px">
                                                                        <table cellspacing="0" cellpadding="6" border="1" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Producto</th>
                                                                                    <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Cantidad</th>
                                                                                    <th scope="col" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Precio</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <!--aqui foreach -->
                                                                                <?php $total=0; ?>
                                                                                <?php foreach ($cuenta as $row): ?>
                                                                                    <?php $producto= Product::findOne( $row->producto_id); ?>
                                                                                <tr>
                                                                                    <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;word-wrap:break-word">
                                                                                        <?= $producto->nombre ?> </td>
                                                                                    <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                                        <?= $row->cantidad ?> </td>
                                                                                    <td style="color:#636363;border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif">
                                                                                    <?php $precio= $row->cantidad*$producto->precio; ?>    
                                                                                    <span><span>$</span><?=number_format($precio, 0, ".", ".")?></span> </td>
                                                                                </tr>
                                                                                <?php $total = $total+$precio; ?>
                                                                                <?php endforeach; ?>
                                                                            </tbody>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px">Subtotal:</th>
                                                                                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px"><span><span>$</span><?=number_format($total, 0, ".", ".")?></span></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Total:</th>
                                                                                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left"><span><span>$</span><?=number_format($total, 0, ".", ".")?></span></td>
                                                                                </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                    </div>

                                                                    <div style="display:none;font-size:0;max-height:0;line-height:0;padding:0"></div>
                                                                    <table id="m_-8314280984903415343m_5364710692626112803addresses" cellspacing="0" cellpadding="0" border="0" style="width:100%;vertical-align:top;margin-bottom:40px;padding:0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td valign="top" width="50%" style="text-align:left;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;border:0;padding:0">
                                                                                    <h2 style="color:#DE710F;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">Dirección de facturación</h2>

                                                                                    <address style="padding:12px;color:#636363;border:1px solid #e5e5e5">
                                                                                        <?= $venta->nombre ?>
                                                                                        <br>
                                                                                        <?= $venta->direccion ?>
                                                                                        <br><a href="tel:<?= $venta->telefono ?>" style="color:#DE710F;font-weight:normal;text-decoration:underline" rel="noreferrer" target="_blank"><?= $venta->telefono ?></a> <br><a href="mailto:<?= $venta->email ?>" rel="noreferrer" target="_blank"><?= $venta->email ?></a> </address>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">

                <table border="0" cellpadding="10" cellspacing="0" width="600" id="m_-8314280984903415343m_5364710692626112803template_footer">
                    <tbody>
                        <tr>
                            <td valign="top" style="padding:0;border-radius:6px">
                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" valign="middle" id="m_-8314280984903415343m_5364710692626112803credit" style="border-radius:6px;border:0;color:#8a8a8a;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:12px;line-height:150%;text-align:center;padding:24px 0">
                                                
                                                © 2020 LocosxChiloé. Desarrollado por  <a href="https://astucia.cl" style="color:#DE710F;font-weight:normal;text-decoration:underline" rel="noreferrer" target="_blank" >Astucia Digital</a></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </td>
        </tr>
    </tbody>
</table>