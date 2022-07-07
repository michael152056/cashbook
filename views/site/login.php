<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = ['label' => "Home", 'url' => '/'];
$this->params['breadcrumbs'][] = ['label' => "Module", 'url' => '/site'];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'active' => true];
app\assets\AppAsset::register($this);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <link rel="icon" type="image/x-icon" href="/images/logos/logo_ico.ico">
</head>

<body>
    <div class="card text-center p-4 p-sm-0" style="background-color: #f2f2f2;">
        <div class="row vh-100 g-0" id="sideImage">
            <div class="col col-md-6 d-none d-md-flex ">
                <div class="img-login">
                    <span class="slogans">
                         <img src="/images/svg/check-circle-solid.svg" class="mb-4" alt=""> Sumando inteligentemente <br>
                         <img src="/images/svg/check-circle-solid.svg" class="mb-4" alt=""> Calculando las mejores oportunidades para ti <br>
                         <img src="/images/svg/check-circle-solid.svg" alt=""> Trabajo de calidad en contabilidad
                    </span>
                </div>
            </div>
            <div class="col-md-6 align-self-center login_form">
                
                <div class="card-body mx-4 rounded-3  p-md-0" id="login-form">
                    <h2 class="card-title link-primary fw-bold mb-4">
                        <img src="<?= Yii::getAlias('@web') . "/images/logos/logocc_azul.svg" ?>" width=50% height=50%>
                    </h2>

                    <p class="slogan text-center mb-5 mt-5"><b>Inicia sesión</b> en tu  cuenta</p>
                    <?php if (Yii::$app->session->hasFlash('complete')) : ?>
                        <div class="alert alert-success"><?= Yii::$app->session->getFlash('complete'); ?></div>
                    <?php endif ?>
                    <center class="formulario-login">
                        <?php $form = ActiveForm::begin([]); ?>

                        <div class="col col-md-10 user-form">
                            <?= $form
                            ->field($model, 'username')
                            ->textInput(['autofocus' => true])
                            ->input('username', ['placeholder' => "Ingresa el nombre de usuario  Ej. micasita"])
                            ->label('<div class="label-login-user"><img src="/images/svg/user-solid.svg"></img> Usuario</div>') ?>
                        </div>
                        <div class="col col-md-10">
                            <?= $form
                            ->field($model, 'password')
                            ->passwordInput( ['placeholder' => "Ingresa la contraseña"])
                            ->label('<div class="label-login-pass"><img src="/images/svg/lock-solid.svg"></img> Contraseña</div>') ?>

                            <?= Html::submitButton('Ingresar', ['class' => 'btn  btn-login', 'name' => 'login-button']) ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="col col-12 col-md-6 justify-content-end m-auto text-end w-auto">
                            <br>
                            <a href='<?= Url::to("/web/site/changepassword") ?>' style="text-decoration:none;text-color:blue" class="float-right apass mt-3 me-5">Olvidaste tú <b> contraseña?</b></a>

                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</body>

</html>