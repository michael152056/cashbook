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
    
    <style>
        @media (max-width: 768px) {
    #login-img {
        position: absolute;
        top:0;
        left: 0;
        opacity: 0.1;
    }
    #login-form{
        z-index: 1;
       
        border-radius: 20px;
        margin-left: 1rem !important;
        margin-right: 1rem !important;
    }
}
    </style>
</head>
<body>
    <div class="card text-center" style="background-color: #f2f2f2;">
        <div class="row vh-100 g-0" id="sideImage">
            <div class="col col-md-7">
                <img src="<?= Yii::getAlias('@web') . "/images/12345.jpg" ?>" id="login-img" class="img-fluid h-100" alt="login">
            </div>
            <div class="col-md-5 align-self-center">
                <div class="card-body border mx-4 rounded-3 " id="login-form">
                    <h2 class="card-title link-primary fw-bold">
                    <img src="<?= Yii::getAlias('@web') . "/images/logo.jpeg" ?>" width=80% height=80%>
                    </h2>
                    <?php if (Yii::$app->session->hasFlash('complete')): ?>
                        <div class="alert alert-success"><?= Yii::$app->session->getFlash('complete');?></div>
                    <?php endif?>
                    <center>
                    <?php $form = ActiveForm::begin([]); ?>
                    
                        <div class="col col-md-10">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Usuario') ?>
                        </div>
                        <div class="col col-md-10">
                            <?= $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>
                            <?= Html::submitButton('Ingresar', ['class' => 'btn btn-outline-primary', 'name' => 'login-button']) ?>
                    <?php ActiveForm::end(); ?>
                        </div>
                        <div class="d-grid col-6 mx-auto">
                            <br>
                        <a href='<?=Url::to("/web/site/changepassword")?>' style="text-decoration:none;text-color:blue" class="float-center">Olvide mi contraseña</a>
                          
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</body>
</html>