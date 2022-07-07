<?php
use yii\helpers\Url;
?>
<!-- Left navbar links -->
<ul class="navbar-nav pushmenu">
    <li class="nav-item">
        <svg fill="rgb(5, 30, 52)" width="18" data-widget="pushmenu" data-enable-remember="true" 	 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
    </li>
</ul>



<!-- Right navbar links -->
<ul class="navbar-nav ml-auto mr-2">
    
   
   
    <li class="nav-item dropdown">
        <a data-toggle="dropdown" href="#">
            <img src="<?= Yii::getAlias('@web') . "/images/iconlogo.png"; ?>" width="35" class="img-circle elevation-2" alt="User Image">
        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <?php use yii\helpers\Html;

            if ( Yii::$app->user->isGuest): ?>
                <a href="<?= Url::to(['site/login'])?>" class="dropdown-item">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
            <?php else: ?>
               
                <div class="dropdown-item">
                    <?php echo Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            '<i class="fas fa-sign-out-alt mr-2"></i> Salir ' . Yii::$app->user->identity->username . '',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm();
                    ?>
                    <?php echo Html::beginForm(['/site/perfil'], 'post')
                        . Html::submitButton(
                            '<i class="fas fa-sign-out-alt mr-2"></i> Perfil ',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm();
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </li>
</ul>