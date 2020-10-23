<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Registrarse | LocosxChiloé';
?>
<div class="container">
    <?= Html::beginForm(Url::toRoute("site/registrar"), "POST", ['id' => 'form-registrar']) ?>

    <div class="row">
        <div class="col-md-6">
            <div class="heading_s1">
                <h4>Rellene los campos con sus datos</h4>
            </div>
            <div class="form-group">
                <input type="text" required class="form-control" name="nombre" placeholder="Nombre*" required>
            </div>
            <div class="form-group">
                <input type="text" required class="form-control" name="apellidos" placeholder="Apellidos *" required>
            </div>
            <div class="form-group">
                <input type="text" required class="form-control" id="rut" oninput="checkRut(this)" name="rut" placeholder="RUT *" required>
            </div>
            <div class="form-group">
                <input class="form-control" required type="email" name="email" placeholder="Correo Electrónico *">
            </div>
            <div class="form-group">
                <div class="custom_select">
                    <select class="form-control" required name="comuna" id="comuna">
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
                        <option value="San Bernardo">San Bernardo</option>
                        <option value="Calera de Tango">Calera de Tango</option>
                        <option value="Talagante">Talagante</option>
                        <option value="Peñaflor">Peñaflor</option>
                    </select>
                </div>
            </div>





        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" name="calle_principal" required="asdasdas" placeholder="Calle Principal *">
            </div>

            <div class="form-group">
                <input class="form-control" required type="text" name="numeracion" placeholder="Numeración*">
            </div>


            <div class="form-group">
                <input class="form-control" required type="text" name="telefono" placeholder="Telefono *">
            </div>


            <div class="form-group">
                <input class="form-control" required type="password" placeholder="Contraseña" id="password" name="password">


            </div>
            <div class="form-group">
                <input class="form-control" required type="password" placeholder="Repetir Contraseña" id="password2" name="password2">
                <b id="coincidencia" class="text-danger">ESTAS CONTRASEÑAS NO COINCIDEN</b>
            </div>
            <div class="form-group ">
                <div class="custome-checkbox">
                    <input class="form-check-input" type="checkbox" name="terminos" required id="terminos">
                    <label class="form-check-label label_info" for="terminos"><span>ACEPTO LOS <a class="text-orange" target="_blank" href="index.php?r=site/terminos">TERMINOS Y CONDICIONES</a></span></label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group ">
        <button id="registrar" class="btn btn-orange  btn-block text-center">REGISTRARSE</button>
    </div>
    <?= Html::endForm() ?>

</div>

<?php $this->registerJsFile('@web/assets/js/rut.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>