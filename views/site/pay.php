<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="text-center order_complete">
                     <?php
                       $url = "";
                       if (isset($_SERVER['HTTPS'])) {
                           $url = "https://" . $_SERVER['SERVER_NAME'];
                       } else {
                           $url = "http://" . $_SERVER['SERVER_NAME'];
                       }
                     ?>
                     <img src="<?= $url ?>/assets/images/webpay.png" alt="" srcset="">
                        
                        <form action="<?= $formAction ?>" method="POST" role="form">
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                            <input type="hidden" name="token_ws" value="<?= $token ?>">
                            <button class="btn btn-fill-out">Pagar en Webpay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION SHOP -->

    <script>
    
        setTimeout(function() {
            document.forms[1].submit();
        }, 10000);
    
    </script>
</div>