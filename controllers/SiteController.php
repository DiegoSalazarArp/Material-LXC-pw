<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\mail\MailerInterface;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Product;
use app\models\User;
use app\models\FormRegister;
use app\models\Users;
use yii\mail\BaseMailer;
use yii\mail\Swift_Mailer;
use app\models\Carrito;
use app\models\Venta;
use app\models\Slider;

use app\models\Categorias;
use app\models\Vendidos;
use yii\db\conditions\NotCondition;
use yii\helpers\BaseJson;
use yii\db\ActiveRecord;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\WebpayNormal;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'venta', 'entrada', 'admin'],
                'rules' => [
                    [
                        //El administrador tiene permisos sobre las siguientes acciones
                        'actions' => ['logout', 'admin', 'venta', 'entrada'],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un administrador
                            return User::isUserAdmin(Yii::$app->user->identity->id);
                        },
                    ],
                    [
                        //Los usuarios VENTA tienen permisos sobre las siguientes acciones
                        'actions' => ['logout', 'venta'],
                        //Esta propiedad establece que tiene permisos
                        'allow' => true,
                        //Usuarios autenticados, el signo ? es para invitados
                        'roles' => ['@'],
                        //Este método nos permite crear un filtro sobre la identidad del usuario
                        //y así establecer si tiene permisos o no
                        'matchCallback' => function ($rule, $action) {
                            //Llamada al método que comprueba si es un usuario simple
                            return User::isUserSimple(Yii::$app->user->identity->id);
                        },
                    ],

                ],
            ],
            //Controla el modo en que se accede a las acciones, en este ejemplo a la acción logout
            //sólo se puede acceder a través del método post
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $p = new Product;
        $prod = $p->find()->where(['padre' => 0])->andWhere(["active" => 1])->all();

        return $this->render('index', ["productos" => $prod]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionIniciar()
    {
        $model = new LoginForm();

        return $this->renderPartial('iniciar', [
            'model' => $model,
        ]);
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->renderPartial('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        if (Yii::$app->request->post('nombre')) {
            Yii::$app->mailer->compose()
                ->setFrom('no-reply@locosxchiloe.cl')
                ->setTo('ventas@locosxchiloe.cl')
                ->setSubject('Formulario de contacto')
                ->setTextBody('Plain text content')
                ->setHtmlBody('<table>
            <tr>
            <td>NOMBRE:</td>
            <td>' . Yii::$app->request->post('nombre') . '</td>
            </tr>
            <tr>
            <td>CORREO:</td>
            <td>' . Yii::$app->request->post('correo') . '</td>
            </tr>
            <tr>
            <td>MENSAJE:</td>
            <td>' . Yii::$app->request->post('mensaje') . '</td>
            </tr>
            </table>')->send();
            return $this->redirect(['site/contact', "al" => "mr"]);
        }
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionProduct()
    {
        if (Yii::$app->request->get('prdctid') != null) {
            $p = new Product;
            $prod = $p->findOne(Yii::$app->request->get('prdctid'));
            return $this->render('product', ["producto" => $prod]);
        }

        return $this->redirect(["site/index"]);
    }
    private function randKey($str = '', $long = 0)
    {
        $key = null;
        $str = str_split($str);
        $start = 0;
        $limit = count($str) - 1;
        for ($x = 0; $x < $long; $x++) {
            $key .= $str[rand($start, $limit)];
        }
        return $key;
    }
    public function actionAddtocart()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->request->get('product') != null) {
                $user =  Yii::$app->user->identity->id;
                $p =   Yii::$app->request->get('product');
                $c = new Carrito;
                $prod = $c->find()->where(["user" => $user])->andWhere(["producto_id" => $p])->one();
                if ($prod) {
                    $prod->cantidad = $prod->cantidad + 1;
                    $prod->update();
                    return $this->redirect(["site/cart"]);
                } else {
                    $c->producto_id = $p;
                    $c->cantidad = 1;
                    $c->user = $user;
                    $c->insert();
                    return $this->redirect(["site/cart"]);
                }
            }
        } else {
            //return $this->redirect(["site/login"]);
            $id =   Yii::$app->request->get('product');

            if (isset($_COOKIE['carrito'])) {
                $cart = unserialize($_COOKIE["carrito"], ["allowed_classes" => false]);
                $cantidad = 1;
                $listo = json_decode(json_encode(array_unique($cart, SORT_REGULAR)));
                $i = 0;
                foreach ($listo as $row) {
                    if ($row->producto_id == $id) {


                        $cantidad++;
                        $a = array();
                        array_push($a, [
                            "producto_id" => $id,
                            "cantidad" => $row->cantidad + 1,
                        ]);
                        array_splice($listo, 0, 2, $a);
                    }
                    $i++;
                }
                if ($cantidad == 1) {
                    array_push($listo, [
                        "producto_id" => $id,
                        "cantidad" => 1,
                    ]);
                }
                $listo = array_values(array_unique($listo, SORT_REGULAR));

                setcookie("carrito", serialize($listo), time() + (3600 * 2));


                return $this->redirect(["site/cart"]);

                //  return $this->redirect(["sites/cart"]);
            } else {
                $carrito = array();
                array_push($carrito, [
                    "producto_id" => $id,
                    "cantidad" => 1,
                ]);
                setcookie("carrito", serialize($carrito), time() + (3600 * 2));

                //$cart = unserialize($_COOKIE["carrito"], ["allowed_classes" => false]);

                return $this->redirect(["site/cart"]);
            }
        }
        return $this->redirect(["site/index"]);
    }
    public function actionRemovec()
    {
        $id =   Yii::$app->request->get('id');
        $cart = unserialize($_COOKIE["carrito"], ["allowed_classes" => false]);
        $carrito = json_decode(json_encode(array_unique($cart, SORT_REGULAR)));
        $a = array();
        foreach ($carrito as $row) {
            if ($row->producto_id == $id) {
                //no cargar fila
            } else {

                array_push($a, [
                    "producto_id" => $row->producto_id,
                    "cantidad" => $row->cantidad,
                ]);
            }
        }
        setcookie("carrito", serialize($a), time() + (3600 * 2));

        return $this->redirect(["site/cart"]);
    }
    public function actionCart()
    {
        //cambiar esta wea
        if (Yii::$app->user->isGuest) {
            if (isset($_COOKIE['carrito'])) {
                $cart = unserialize($_COOKIE["carrito"], ["allowed_classes" => false]);
                $listo = json_decode(json_encode(array_unique($cart, SORT_REGULAR)));
                if ($listo == null) {
                    return $this->goHome();
                }
                return $this->render("ccart", ["productos" => $listo]);
            } else {
                return $this->goHome();
            }
        } else {
            $user = Yii::$app->user->identity->id;
            $c = new Carrito;
            $cart = $c->find()->where(["user" => $user])->all();
            return $this->render('cart', ["productos" => $cart]);
        }
    }

    public function actionBuy()
    {
        if (Yii::$app->request->get('prd') != null) {
            $prodsel = Yii::$app->request->get('prd');

            if (Yii::$app->user->isGuest) {
                $prod = new Product;
                $producto = $prod->findOne($prodsel);

                return $this->render('buy', ['tipo' => 'solo', 'producto' => $producto]);
                //uno es solo y el otro es carro

            } else {
                $prod = new Product;
                $c = new Carrito;
                $prodsel = Yii::$app->request->get('prd');
                $e = $c->find()->where(["producto_id" => $prodsel])->andWhere(["user" => Yii::$app->user->identity->id])->one();
                if ($e) {
                    $e->cantidad = $e->cantidad + 1;
                    $e->update();
                    $carrito = $c->find()->where(["user" => Yii::$app->user->identity->id])->all();

                    return $this->render("buy2", ["carrito" => $carrito]);
                } else {
                    $c->producto_id = $prodsel;
                    $c->cantidad = 1;
                    $c->user = Yii::$app->user->identity->id;
                    $c->insert();
                    $carrito = $c->find()->where(["user" => Yii::$app->user->identity->id])->all();
                    return $this->render("buy2", ["carrito" => $carrito]);
                }
            }
        } else {
            if (Yii::$app->user->isGuest) {
            } else {
                $c = new Carrito;
                $carrito = $c->find()->where(["user" => Yii::$app->user->identity->id])->all();
                return $this->render("buy2", ["carrito" => $carrito]);
            }
        }
    }
    public function actionBuy2()
    {
        $c = new Carrito;
        $carrito = $c->find()->where(["user" => Yii::$app->user->identity->id])->all();
        return $this->render("buy2", ["carrito" => $carrito]);
    }
    public function actionPay2()
    {
        $monto = Yii::$app->request->post('total');

        $buyOrder = strval(rand(10000, 9999999));
        $v = new Venta;
        $nombre = Yii::$app->request->post('nombre');
        $apellidos =  Yii::$app->request->post('apellidos');
        $comuna = Yii::$app->request->post('comuna');
        $numeracion = Yii::$app->request->post('numeracion');
        $calle_principal = Yii::$app->request->post('calle_principal');
        $telefono = Yii::$app->request->post('telefono');
        $email = Yii::$app->request->post('email');
        $informacion = Yii::$app->request->post('informacion');
        if ($informacion == "") {
            $informacion = "sin mensaje";
        }
        $v->nombre = $nombre . " " . $apellidos;
        $v->direccion = $calle_principal . ", " . $numeracion . ", " . $comuna;
        $v->email = $email;
        $v->telefono = $telefono;
        $v->informacion = $informacion;
        $v->estado = 0;
        $v->orden_compra = $buyOrder;
        $v->total = $monto;
        $v->entrega = Yii::$app->request->post('fecha');



        $v->insert();
        $l = new Vendidos;
        $c = Carrito::find()->where(["user" => Yii::$app->user->identity->id])->all();

        foreach ($c as $row) {

            $l->producto_id = $row->producto_id;
            $l->cantidad = $row->cantidad;
            $l->codigo = $buyOrder;
            $l->insert();
            $l->codigo = $buyOrder;
            $l->update();
        }
        // ajuste temporal aqui es con usuario
        //   return $this->render("pagado");





        return $this->redirect(["site/trsctn", "or" => $buyOrder, "amo" => $monto]);
        // return $this->render('pay', ['buyOrder' => $buyOrder, 'amount' => $monto]);
    }
    public function actionTrsctn()
    {
        $buyOrder = Yii::$app->request->get('or');
        $amount = Yii::$app->request->get('amo');
        $returnUrl = 'https://locosxchiloe.cl/site/pagado';
        $finalUrl = 'https://locosxchiloe.cl/site/cancelado';
        $sessionId = $buyOrder;

        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
            ->getNormalTransaction();

        $initResult = $transaction->initTransaction(
            $amount,
            $buyOrder,
            $sessionId,
            $returnUrl,
            $finalUrl
        );
        $formAction = $initResult->url;
        $tokenWs = $initResult->token;
        if($tokenWs==""){
        return '<pre>'.var_dump($initResult).'</pre>';
        }
        return $this->render('pay', ['buyOrder' => $buyOrder, 'amount' => $amount, 'formAction' => $formAction, 'token' => $tokenWs]);

    }
    public function actionPay()
    {
        $monto = "";
        $venta = Yii::$app->request->get('id');

        if (Yii::$app->request->get('total')) {
            $monto = Yii::$app->request->get('total');
        }
        if (Yii::$app->request->post('total')) {
            $monto = Yii::$app->request->post('total');
        }
        $buyOrder = strval(rand(10000, 9999999));
        $returnUrl = 'https://locosxchiloe.cl/site/pagado';
        $finalUrl = 'https://locosxchiloe.cl/site/cancelado';
        $sessionId = $buyOrder;

        //meter orden de compra
        $v = new Venta;
        $orden = $v->findOne($venta);
        $orden->orden_compra = $buyOrder;
        $orden->update();
        //lista de compra
        $l = new Vendidos;
        $lista = $l->findOne(Yii::$app->request->get('l'));
        $lista->codigo = $buyOrder;
        $lista->update();
        //transaccion en productivo
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
            ->getNormalTransaction();
        $amount = $monto;
        $initResult = $transaction->initTransaction(
            $amount,
            $sessionId,
            $buyOrder,
            $returnUrl,
            $finalUrl
        );
        $formAction = $initResult->url;
        $tokenWs = $initResult->token;
        return $this->render('pay', ['buyOrder' => $buyOrder, 'amount' => $amount, 'formAction' => $formAction, 'token' => $tokenWs]);
    }
    public function actionRegister()
    {
        return $this->render('register');
    }

    public function actionRegistrar()
    {


        if (Yii::$app->request->post('nombre')) {
            $correo = Yii::$app->request->post('email');
            if (Yii::$app->request->post('password') != "") {
                $confirmar = Users::find()->where(["email" => $correo])->one();
                if ($confirmar->email == $correo) {
                    return $this->goHome();
                }
                //Preparamos la consulta para guardar el usuario
                $table = new Users;

                $table->nombre =  Yii::$app->request->post('nombre');
                $table->role = 1;
                $table->apellidos = Yii::$app->request->post('apellidos');
                $table->rut = Yii::$app->request->post('rut');
                $table->comuna = Yii::$app->request->post('comuna');
                $table->calle_principal = Yii::$app->request->post('calle_principal');
                $table->numeracion = Yii::$app->request->post('numeracion');
                $table->telefono = Yii::$app->request->post('telefono');
                $table->email = Yii::$app->request->post('email');
                $table->activate = 0;
                //Encriptamos el password
                $table->password = crypt(Yii::$app->request->post('password'), Yii::$app->params["salt"]);
                //Creamos una cookie para autenticar al usuario cuando decida recordar la sesión, esta misma
                //clave será utilizada para activar el usuario
                $table->authKey = $this->randKey("abcdef0123456789", 200);
                //Creamos un token de acceso único para el usuario
                $table->accessToken = $this->randKey("abcdef0123456789", 200);

                //Si el registro es guardado correctamente
                if ($table->insert()) {


                    Yii::$app->mailer->compose()
                        ->setFrom('no-reply@locosxchiloe.cl')
                        ->setTo($correo)
                        ->setSubject('Continuar su Registro de LocosxChiloé')
                        ->setTextBody('Continuar su Registro de LocosxChiloé')
                        ->setHtmlBody('<p>Bienvenido a LocosxChiloé, gracias por
                     unirte y ser parte de nuestra comunidad.
                     Para poder activar tu cuenta y comprar en
                     nuestro sitio web, haz click en el siguiente
                     enlace: <a href="https://locosxchiloe.cl/site/activar&key=' . $table->authKey . '">Click Aquí</a><p>
                     <b>Equipo LocosxChiloé</b>')->send();

                    if (Yii::$app->request->post('total') != "") {
                        //registrar venta
                        $v = new Venta;
                        $v->nombre = Yii::$app->request->post('nombre') . " " . Yii::$app->request->post('apellidos');
                        $v->direccion = Yii::$app->request->post('calle_principal') . " " . Yii::$app->request->post('numeracion') . " " . Yii::$app->request->post('comuna');
                        $v->email = Yii::$app->request->post('email');
                        $v->telefono = Yii::$app->request->post('telefono');
                        $v->informacion = Yii::$app->request->post('informacion');
                        $v->estado = 0;
                        $v->total = Yii::$app->request->post('total');
                        $v->entrega = Yii::$app->request->post('fecha');

                        $v->insert();
                        //lista de compra
                        $l = new Vendidos;
                        $l->producto_id = Yii::$app->request->post('productos');
                        $l->cantidad = 1;
                        $l->insert();


                        return $this->redirect(["site/pay", "total" => Yii::$app->request->post('total'), "id" => $v->id, "l" => $l->id]);
                    }

                    return $this->redirect(["site/register", "al" => "rs"]);
                }
            } else {
                //registrar venta
                $v = new Venta;
                $v->nombre = Yii::$app->request->post('nombre') . " " . Yii::$app->request->post('apellidos');
                $v->direccion = Yii::$app->request->post('calle_principal') . " " . Yii::$app->request->post('numeracion') . " " . Yii::$app->request->post('comuna');
                $v->email = Yii::$app->request->post('email');
                $v->telefono = Yii::$app->request->post('telefono');
                $v->informacion = Yii::$app->request->post('informacion');
                $v->estado = 0;
                $v->total = Yii::$app->request->post('total');
                $v->entrega = Yii::$app->request->post("fecha");

                $v->productos = Yii::$app->request->post('productos');

                $v->insert();
                $l = new Vendidos;
                $l->producto_id = Yii::$app->request->post('productos');
                $l->cantidad = 1;
                $l->insert();
                return $this->redirect(["site/pay", "total" => Yii::$app->request->post('total'), "id" => $v->id, "l" => $l->id]);
            }
        }
        return $this->redirect(["site/index"]);
    }
    public function actionRemovep()
    {
        $id = Yii::$app->request->get('id');
        $c = Carrito::find()->where(["producto_id" => $id])->andWhere(["user" => Yii::$app->user->identity->id])->one();
        if ($c->delete()) {
            return $this->redirect(['site/cart']);
        }
    }
    public function actionPagado()
    {
        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
            ->getNormalTransaction();
        $tokenWs = filter_input(INPUT_POST, 'token_ws');
        $result = $transaction->getTransactionResult($tokenWs);
        $output = $result->detailOutput;
        if ($output->responseCode == 0) {
            $v = new Venta;
            $orden = $result->sessionId;
            $venta = $v->find()->where(["orden_compra" => $orden])->one();
            $venta->estado = 1;
            $venta->update();
            //reducir stock
            $pv = new Vendidos;
            $p = new Product;
            $cuenta = $pv->find()->where(["codigo" => $orden])->all();
            foreach ($cuenta as $row) {
                $producto = $p->findOne($row->producto_id);
                $producto->stock = $producto->stock - $row->cantidad;
                $producto->update();
            }
            //venta realizada exitosamente

            //debe mandar detalle de compra al correo
            $htmlBody = $this->renderPartial("email",["cuenta"=>$cuenta,"orden"=>$orden]);
           
            
            Yii::$app->mailer->compose()
                ->setFrom('no-reply@locosxchiloe.cl')
                ->setTo($venta->email)
                ->setSubject('Comprobante de Pago| Locosxchiloe')
                ->setHtmlBody($htmlBody)
                ->send();
            if (!Yii::$app->user->isGuest) {
                Carrito::deleteAll("user=" . Yii::$app->user->identity->id);
            }else{
                unset($_COOKIE ["carrito"]);          
              }
            return $this->render("pagado");
        } 
            return $this->render("rechazado");
        
    }
    public function actionProductos()
    {
        $p = new Product;
        if (isset($_GET['order'])) {
            $order = Yii::$app->request->get('order');
            $p = new Product;
            switch ($order) {
                case 'date':
                    $productos = $p->find()->where(['padre' => 0])->andWhere(["active" => 1])->orderBy(['fecha' => SORT_DESC])->all();
                    return $this->render("productos", ["productos" => $productos]);
                    break;
                case 'alphabetic':
                    $productos = $p->find()->where(['padre' => 0])->andWhere(["active" => 1])->orderBy(['nombre' => SORT_ASC])->all();
                    return $this->render("productos", ["productos" => $productos]);

                    break;
                case 'price-desc':
                    $productos = $p->find()->where(['padre' => 0])->andWhere(["active" => 1])->orderBy(['precio' => SORT_DESC])->all();
                    return $this->render("productos", ["productos" => $productos]);

                    break;
                case 'price':
                    $productos = $p->find()->where(['padre' => 0])->andWhere(["active" => 1])->orderBy(['precio' => SORT_ASC])->all();
                    return $this->render("productos", ["productos" => $productos]);

                    break;
            }
        }
        $productos = $p->find()->where(['padre' => 0])->andWhere(["active" => 1])->all();

        return $this->render("productos", ["productos" => $productos]);
    }
    public function actionNosotros()
    {
        return $this->render("nosotros");
    }
    public function actionPromociones()
    {
        $p = new Product;
        if (isset($_GET['order'])) {
            $order = Yii::$app->request->get('order');
            $p = new Product;
            switch ($order) {
                case 'date':
                    $productos = $p->find()->where(['like', 'padre', 0])->andWhere(["active" => 1])->andWhere(["categoria" => "promociones"])->orderBy(['fecha' => SORT_DESC])->all();
                    return $this->render("promociones", ["productos" => $productos]);
                    break;
                case 'alphabetic':
                    $productos = $p->find()->where(['like', 'padre', 0])->andWhere(["active" => 1])->andWhere(["categoria" => "promociones"])->orderBy(['nombre' => SORT_ASC])->all();
                    return $this->render("promociones", ["productos" => $productos]);

                    break;
                case 'price-desc':
                    $productos = $p->find()->where(['like', 'padre', 0])->andWhere(["active" => 1])->andWhere(["categoria" => "promociones"])->orderBy(['precio' => SORT_DESC])->all();
                    return $this->render("promociones", ["productos" => $productos]);

                    break;
                case 'price':
                    $productos = $p->find()->where(['like', 'padre', 0])->andWhere(["active" => 1])->andWhere(["categoria" => "promociones"])->orderBy(['precio' => SORT_ASC])->all();
                    return $this->render("promociones", ["productos" => $productos]);

                    break;
            }
        }
        $productos = $p->find()->where(['like', 'padre', 0])->andWhere(["active" => 1])->andWhere(["categoria" => "promociones"])->all();

        return $this->render("promociones", ["productos" => $productos]);
    }
    public function actionGestion()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (User::isUserSimple(Yii::$app->user->identity->id)) {
            return $this->goHome();
        }
        $p = new Product;
        $prod = $p->find()->where(["active" => 1])->andWhere(["padre" => 0])->all();
        return $this->render("gestion", ["productos" => $prod]);
    }
    public function actionCreateprod()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (User::isUserSimple(Yii::$app->user->identity->id)) {
            return $this->goHome();
        }
        return $this->render("createprod");
    }
    public function actionDelprod()
    {
        $id = Yii::$app->request->get('id');
        $p = new Product;
        $prod = $p->findOne($id);
        $prod->active = 0;
        $prod->update();
        //variaciones
        if ($prod->padre == 0) {
            $v = $p->find()->where(["padre" => $id])->all();
            foreach ($v as $row) {
                $row->active = 0;
                $row->update();
            }
        }
        $c = new Carrito;
        $c->find()->all();
        $c->deleteAll("producto_id=" . $id);
        return $this->redirect(["site/gestion"]);
    }
    public function actionDelcat()
    {
        $id = Yii::$app->request->get('id');
        $c = new Categorias;
        $cat = $c->findOne($id);
        $cat->delete();

        return $this->redirect(["site/gestion"]);
    }
    public function actionCc()
    {
        $c = new Categorias;
        $c->categoria = Yii::$app->request->post('categoria');
        $c->insert();
        return $this->redirect(["site/gestion"]);
    }
    public function actionCp()
    {
        $url = "";
        if (isset($_SERVER['HTTPS'])) {
            $url = "https://" . $_SERVER['SERVER_NAME'];
        } else {
            $url = "http://" . $_SERVER['SERVER_NAME'];
        }
        $p = new Product;
        $p->nombre = Yii::$app->request->post('nombre');
        $p->precio = Yii::$app->request->post('precio');
        $p->stock = Yii::$app->request->post('stock');

        $p->categoria = Yii::$app->request->post('categoria');
        $p->descripcion = Yii::$app->request->post('descripcion');
        $p->active = 1;

        $p->insert();

        if ($_FILES["imagen"]['name'] != null) {

            $id = $p->id;
            $nombre = "principal";
            $carpetaDestino = "assets/images/product/" . $id . "/";
            mkdir($carpetaDestino, 0777);
            $origen = $_FILES["imagen"]["tmp_name"];
            $destino = $carpetaDestino . $nombre . ".jpg";
            @move_uploaded_file($origen, $destino);
            $p->foto_principal = $url . "/" . $carpetaDestino . $nombre . ".jpg";
            $p->update();
        }
        return $this->redirect(["site/gestion"]);
    }
    public function actionCat()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (User::isUserSimple(Yii::$app->user->identity->id)) {
            return $this->goHome();
        }
        $c = new Categorias;
        $cat = $c->find()->all();
        return $this->render("cat", ["categorias" => $cat]);
    }

    public function actionEstadisticas()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (User::isUserSimple(Yii::$app->user->identity->id)) {
            return $this->goHome();
        }
        $v = new Venta;
        $ventas = $v->find()->orderBy(['fecha' => SORT_DESC])->all();
        return $this->render("estadisticas", ["ventas" => $ventas]);
    }
    public function actionEditprod()
    {
        $id = Yii::$app->request->get('id');
        $p = Product::findOne($id);
        return $this->render("editprod", ["producto" => $p]);
    }

    public function actionUp()
    {
        $url = "";
        if (isset($_SERVER['HTTPS'])) {
            $url = "https://" . $_SERVER['SERVER_NAME'];
        } else {
            $url = "http://" . $_SERVER['SERVER_NAME'];
        }
        $p = new Product;
        $id = Yii::$app->request->post('id');
        $up = $p->findOne($id);
        $up->nombre = Yii::$app->request->post('nombre');
        $up->precio = Yii::$app->request->post('precio');
        $up->stock = Yii::$app->request->post('stock');

        $up->categoria = Yii::$app->request->post('categoria');
        $up->descripcion = Yii::$app->request->post('descripcion');
        $up->update();

        if ($_FILES["imagen"]['name'] != null) {

            $id = $up->id;
            $nombre = "principal";
            $carpetaDestino = "assets/images/product/" . $id . "/";
            mkdir($carpetaDestino, 0777);
            $origen = $_FILES["imagen"]["tmp_name"];
            $destino = $carpetaDestino . $nombre . ".jpg";
            @move_uploaded_file($origen, $destino);
            $up->foto_principal = $url . "/" . $carpetaDestino . $nombre . ".jpg";
            $up->update();
        }
        return $this->redirect(["site/gestion"]);
    }
    public function actionVariante()
    {
        $id = Yii::$app->request->post('padre');
        $nombre = Yii::$app->request->post('nombre');

        $precio = Yii::$app->request->post('precio');
        $v = new Product;
        $p = $v->find()->where(["id" => $id])->one();

        $v->nombre = $nombre;
        $v->precio = $precio;
        $v->foto_principal = $p->foto_principal;
        $v->descripcion = $p->descripcion;
        $v->galeria = $p->galeria;
        $v->categoria = $p->categoria;
        $v->padre = $id;
        $v->active = 1;
        $v->insert();
        return $this->redirect(["site/gestion"]);
    }
    public function actionCbuy()
    {
        $cart = unserialize($_COOKIE["carrito"], ["allowed_classes" => false]);
        $c = json_decode(json_encode(array_unique($cart, SORT_REGULAR)));
        return $this->render("cbuy", ["carrito" => $c]);
    }
    public function actionCpay()
    {
        $v = new Venta;
        $nombre = Yii::$app->request->post('nombre');
        $apellidos =  Yii::$app->request->post('apellidos');
        $comuna = Yii::$app->request->post('comuna');
        $numeracion = Yii::$app->request->post('numeracion');
        $calle_principal = Yii::$app->request->post('calle_principal');
        $telefono = Yii::$app->request->post('telefono');
        $email = Yii::$app->request->post('email');
        $informacion = Yii::$app->request->post('informacion');
        $buyOrder = strval(rand(10000, 9999999));
        $v->nombre = $nombre . " " . $apellidos;
        $v->direccion = $calle_principal . " " . $numeracion . ". " . $comuna;
        $v->email = $email;
        $v->telefono = $telefono;
        $v->informacion = $informacion;
        $v->estado = 0;
        $v->orden_compra = $buyOrder;
        $v->total = Yii::$app->request->post('total');
        $v->entrega = Yii::$app->request->post('fecha');

        $v->insert();
        $l = new Vendidos;
        $cart = unserialize($_COOKIE["carrito"], ["allowed_classes" => false]);
        $c = json_decode(json_encode(array_unique($cart, SORT_REGULAR)));
        foreach ($c as $row) {
            $l->producto_id = $row->producto_id;
            $l->cantidad = $row->cantidad;
            $l->codigo = $buyOrder;
            $l->insert();
            $l->codigo = $buyOrder;
            $l->update();
        }

        //realizar transaccion
        $monto = Yii::$app->request->post('total');
        $returnUrl = 'https://locosxchiloe.cl/site/pagado';
        $finalUrl = 'https://locosxchiloe.cl/site/cancelado';
        $sessionId = $buyOrder;

        $transaction = (new Webpay(Configuration::forTestingWebpayPlusNormal()))
            ->getNormalTransaction();
        $amount = $monto;
        $initResult = $transaction->initTransaction(
            $amount,
            $sessionId,
            $buyOrder,
            $returnUrl,
            $finalUrl
        );
        $formAction = $initResult->url;
        $tokenWs = $initResult->token;

        return $this->render('pay', ['buyOrder' => $buyOrder, 'amount' => $amount, 'formAction' => $formAction, 'token' => $tokenWs]);
    }
    public function actionActivar()
    {
        $u = new Users;
        $key = Yii::$app->request->get('key');
        $f = $u->find()->where(["authKey" => $key])->one();
        if ($f->activate == 0) {
            $f->activate = 1;
            $f->update();
            return $this->redirect(["site/index", "al" => "as"]);
        } else {
            return $this->redirect(["site/index", "al" => "f"]);
        }


        return $this->goHome();
    }



    public function actionTerminos()
    {
        return $this->renderPartial("terminos");
    }
    public function actionFilter()
    {
        $p = new Product;
        $categoria = Yii::$app->request->get('categoria');

        if (isset($_GET['order'])) {
            $order = Yii::$app->request->get('order');

            $p = new Product;
            switch ($order) {
                case 'date':
                    $productos = $p->find()->where(['padre' => 0])->andWhere(["active" => 1])->andWhere(["categoria" => $categoria])->orderBy(['fecha' => SORT_DESC])->all();
                    return $this->render("filter", ["productos" => $productos, "categoria" => $categoria]);
                    break;
                case 'alphabetic':
                    $productos = $p->find()->where(['padre' => 0])->andWhere(["active" => 1])->andWhere(["categoria" => $categoria])->orderBy(['nombre' => SORT_ASC])->all();
                    return $this->render("filter", ["productos" => $productos, "categoria" => $categoria]);

                    break;
                case 'price-desc':
                    $productos = $p->find()->where(['padre' => 0])->andWhere(["active" => 1])->andWhere(["categoria" => $categoria])->orderBy(['precio' => SORT_DESC])->all();
                    return $this->render("filter", ["productos" => $productos, "categoria" => $categoria]);

                    break;
                case 'price':
                    $productos = $p->find()->where(['padre' => 0])->andWhere(["active" => 1])->andWhere(["categoria" => $categoria])->orderBy(['precio' => SORT_ASC])->all();
                    return $this->render("filter", ["productos" => $productos, "categoria" => $categoria]);

                    break;
            }
        }
        $productos = $p->find()->where(['padre' => 0])->andWhere(["active" => 1])->andWhere(["categoria" => $categoria])->all();

        return $this->render("filter", ["productos" => $productos, "categoria" => $categoria]);
    }
    public function actionSuscribir()
    {
        Yii::$app->mailer->compose()
            ->setFrom('no-reply@locosxchiloe.cl')
            ->setTo('ventas@locosxchiloe.cl')
            ->setSubject('Nueva Suscripción')
            ->setTextBody('Nueva Suscripción')
            ->setHtmlBody('<table>
    <tr>
    <td>CORREO ELECTRONICO :</td>
    <td>' . Yii::$app->request->post('correo') . '</td>
    </tr>
   
    </table>')->send();
        return $this->redirect(["site/index", "al" => "su"]);
    }
    public function actionVariantes()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (User::isUserSimple(Yii::$app->user->identity->id)) {
            return $this->goHome();
        }
        $p = new Product;
        $prod = $p->find()->where(["active" => 1])->andWhere("padre!=0")->all();
        return $this->render("variantes", ["productos" => $prod]);
    }

    public function actionSlider()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (User::isUserSimple(Yii::$app->user->identity->id)) {
            return $this->goHome();
        }
        return $this->render("slider");
    }
    public function actionUpslider()
    {
        $p = new Slider;
        $p->foto = "-";
        $p->texto1 = Yii::$app->request->post('texto1');
        $p->texto2 = Yii::$app->request->post('texto2');
        $p->texto3 = Yii::$app->request->post('texto3');
        $p->insert();
        $url = "";
        if (isset($_SERVER['HTTPS'])) {
            $url = "https://" . $_SERVER['SERVER_NAME'];
        } else {
            $url = "http://" . $_SERVER['SERVER_NAME'];
        }
        if ($_FILES["imagen"]['name'] != null) {


            $nombre = "banner";
            $carpetaDestino = "assets/images/slider/" . $p->id . "/";
            mkdir($carpetaDestino, 0777, true);
            $origen = $_FILES["imagen"]["tmp_name"];
            $destino = $carpetaDestino . $nombre . ".jpg";
            @move_uploaded_file($origen, $destino);
            $p->foto = $url . "/" . $carpetaDestino . $nombre . ".jpg";
            $p->update();
            return $this->redirect(["site/slider"]);
        }
    }
    public function actionRemovsl()
    {
        $id = Yii::$app->request->get('id');
        $s = new Slider;
        $s->findOne($id);
        $s->deleteAll("id=" . $id);
        return $this->redirect(["site/slider"]);
    }
    public function actionCancelado()
    {
        return $this->render("cancelado");
    }
    public function actionRender(){
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (User::isUserSimple(Yii::$app->user->identity->id)) {
            return $this->goHome();
        }
        $orden="8053671";
        $cuenta = Vendidos::find()->where(["codigo" => $orden])->all();
       return $this->renderPartial("email",["cuenta"=>$cuenta,"orden"=>$orden]);
       // return $this->render("pay",["formAction"=>"", "token"=>""]);
    }
    public function actionTrash(){
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (User::isUserSimple(Yii::$app->user->identity->id)) {
            return $this->goHome();
        }

        Venta::deleteAll("id > 0");
        Vendidos::deleteAll("id > 0");
return $this->redirect(["site/estadisticas"]);
    }
}
