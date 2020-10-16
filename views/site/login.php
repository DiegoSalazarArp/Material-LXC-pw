<?php 
use yii\helpers\Html;
use yii\helpers\Url;

use yii\bootstrap\ActiveForm;
$url = "";
if (isset($_SERVER['HTTPS'])) {
    $url = "https://" . $_SERVER['SERVER_NAME']."/";
} else {
    $url = "http://" . $_SERVER['SERVER_NAME']."/";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Login Locosxchiloe</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="<?= $url ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <!-- ===== Animation CSS ===== -->
    <link href="<?= $url ?>assets/css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="<?= $url ?>assets/css/style.css" rel="stylesheet">
    <link href="<?= $url ?>assets/css/login.css" rel="stylesheet">

    <!-- ===== Color CSS ===== -->
    <link href="<?= $url ?>assets/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="background-image: url('<?= $url ?>assets/images/blanco.jpg');" class="mini-sidebar">
    <!-- Preloader -->
    <?php
    if(isset($_GET["al"])){ ?>
    <?php if($_GET["al"]=="s"){ ?>
<input type="hidden" id="alertaLogin" value="s">
   <?php }else{ ?>
    <input type="hidden" id="alertaLogin" value="f">


 <?php  } } ?>
    <div class="row">
    <div class="col-md-4"></div>
    <div style="background-color: white" class="col-md-4">
    <section id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">
              
                    <img class="logo" src="<?= $url ?>assets/images/logo_redondo.png" alt="iniciar sesión" srcset="">
                    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label("Correo Electronico ") ?>

        <?= $form->field($model, 'password')->passwordInput()->label("Contraseña") ?>

      

        <div class="form-group">
            <div class="col-lg-12 ">
                <?= Html::submitButton('Iniciar Sesion', ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'login-button']) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12 ">
            <a style="width: 100%;" href="<?= $url ?>" class="btn btn-fill-out">Volver a la Pagina</a>
            </div>
            <br>
            <div class="col-md-12">
            <a style="width: 100%;" href="<?= Url::toRoute(['site/register']) ?>" class="btn btn-fill-out">Regístrarse</a>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
                  
                    
                   
                
      
            </div>
        </div>
    </section>
    <!-- jQuery -->
    
    </div>
    <div class="col-md-4"></div>

    </div>
    <?php $this->registerJsFile('@web/js/jquery.slimscroll.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
        <!-- ===== Wave Effects JavaScript ===== -->
        <?php $this->registerJsFile('@web/js/bootstrap.min.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
        <?php $this->registerJsFile('@web/js/waves.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
        <!-- ===== Menu Plugin JavaScript ===== -->

        <?php $this->registerJsFile('@web/js/sidebarmenu.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
        <!-- ===== Custom JavaScript ===== -->
        <?php $this->registerJsFile('@web/js/custom.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
        <!-- ===== Plugin JS ===== -->
        <!-- ===== Style Switcher JS ===== -->
       
        <?php $this->registerJsFile('@web/js/style.switcher.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
        <?php $this->registerJsFile('@web/assets/js/sweetalert2.all.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>

<?php $this->registerJsFile('@web/assets/js/scripts.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php $this->registerJsFile('@web/assets/js/ajustes.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
</body>

</html>
