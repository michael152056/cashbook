<?php
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Users;
use app\models\User;
use app\models\Modulo;
use app\models\Menus;
use yii\db\Query;
use yii\db\Connection;
$query = new yii\db\Query();

?>
<link rel="stylesheet" type="text/css" href="/css/sidebar.css">

<!-- Sidebar -->
<div class="sidebar" >
    <!-- Brand Logo -->
<a href="<?= Url::to(['site/index']) ?>" class="brand-link text-center">
    <img src="<?= Yii::getAlias('@web') . "/images/logos/logotglabs.svg"; ?>" class="brand-image2" alt="Cashbook Logo">
    <img src="<?= Yii::getAlias('@web') . "/images/logos/logo-mini.svg"; ?>" class="brand-image-mini d-none" alt="Cashbook Logo">
</a>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <?php if(!Yii::$app->user->isGuest) { ?> 
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent"  data-accordion="true" data-expand-sidebar="true"  data-widget="treeview"  role="menu" >
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-item">
                <a href="<?= Url::to(['site/index']) ?>" class="nav-link">
                <svg width="23" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"/></svg>
                    <p>
                        Inicio
                    </p>
                </a>
            </li>


            <?php if(Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 4) { ?> 
            <!--Empresas-->
            <li class="nav-item">
            <a href="#" class="nav-link">
            <svg  width="18" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M448 360V24c0-13.3-10.7-24-24-24H96C43 0 0 43 0 96v320c0 53 43 96 96 96h328c13.3 0 24-10.7 24-24v-16c0-7.5-3.5-14.3-8.9-18.7-4.2-15.4-4.2-59.3 0-74.7 5.4-4.3 8.9-11.1 8.9-18.6zM128 134c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm0 64c0-3.3 2.7-6 6-6h212c3.3 0 6 2.7 6 6v20c0 3.3-2.7 6-6 6H134c-3.3 0-6-2.7-6-6v-20zm253.4 250H96c-17.7 0-32-14.3-32-32 0-17.6 14.4-32 32-32h285.4c-1.9 17.1-1.9 46.9 0 64z"/></svg>
                <p>             
                    <?php
                        $query = new yii\db\Query();
                        $data = $query->select(['nombre'])->from('modulo')->where('id = 1')->distinct()->all();
                        if ($data) 
                        {
                            foreach ($data as $row) {
                                echo $row['nombre'];
                             
                            }
                        }
                    ?>
                    <svg width="13" class="right"  fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg>
                </p>
 
            </a>
                <ul class="nav nav-treeview"  data-enable-remember="true">
				
				 <?php if(Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 4) { ?> 
                    <li class="nav-item">
                        <a href="<?= Url::to(['institution/index']) ?>" class="nav-link">
                        <svg width="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M616 192H480V24c0-13.26-10.74-24-24-24H312c-13.26 0-24 10.74-24 24v72h-64V16c0-8.84-7.16-16-16-16h-16c-8.84 0-16 7.16-16 16v80h-64V16c0-8.84-7.16-16-16-16H80c-8.84 0-16 7.16-16 16v80H24c-13.26 0-24 10.74-24 24v360c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V216c0-13.26-10.75-24-24-24zM128 404c0 6.63-5.37 12-12 12H76c-6.63 0-12-5.37-12-12v-40c0-6.63 5.37-12 12-12h40c6.63 0 12 5.37 12 12v40zm0-96c0 6.63-5.37 12-12 12H76c-6.63 0-12-5.37-12-12v-40c0-6.63 5.37-12 12-12h40c6.63 0 12 5.37 12 12v40zm0-96c0 6.63-5.37 12-12 12H76c-6.63 0-12-5.37-12-12v-40c0-6.63 5.37-12 12-12h40c6.63 0 12 5.37 12 12v40zm128 192c0 6.63-5.37 12-12 12h-40c-6.63 0-12-5.37-12-12v-40c0-6.63 5.37-12 12-12h40c6.63 0 12 5.37 12 12v40zm0-96c0 6.63-5.37 12-12 12h-40c-6.63 0-12-5.37-12-12v-40c0-6.63 5.37-12 12-12h40c6.63 0 12 5.37 12 12v40zm0-96c0 6.63-5.37 12-12 12h-40c-6.63 0-12-5.37-12-12v-40c0-6.63 5.37-12 12-12h40c6.63 0 12 5.37 12 12v40zm160 96c0 6.63-5.37 12-12 12h-40c-6.63 0-12-5.37-12-12v-40c0-6.63 5.37-12 12-12h40c6.63 0 12 5.37 12 12v40zm0-96c0 6.63-5.37 12-12 12h-40c-6.63 0-12-5.37-12-12v-40c0-6.63 5.37-12 12-12h40c6.63 0 12 5.37 12 12v40zm0-96c0 6.63-5.37 12-12 12h-40c-6.63 0-12-5.37-12-12V76c0-6.63 5.37-12 12-12h40c6.63 0 12 5.37 12 12v40zm160 288c0 6.63-5.37 12-12 12h-40c-6.63 0-12-5.37-12-12v-40c0-6.63 5.37-12 12-12h40c6.63 0 12 5.37 12 12v40zm0-96c0 6.63-5.37 12-12 12h-40c-6.63 0-12-5.37-12-12v-40c0-6.63 5.37-12 12-12h40c6.63 0 12 5.37 12 12v40z"/></svg>

                            <p>Empresas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['users/index']) ?>" class="nav-link">
                        <svg width="23" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z"/></svg>
                            <p>Usuarios</p>
                        </a>
                    </li>
					<li class="nav-item">
                        <a href="<?= Url::to(['modulo/index'], $schema = true) ?>" class="nav-link">
                        <svg width="23" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M427.84 380.67l-196.5 97.82a18.6 18.6 0 0 1-14.67 0L20.16 380.67c-4-2-4-5.28 0-7.29L67.22 350a18.65 18.65 0 0 1 14.69 0l134.76 67a18.51 18.51 0 0 0 14.67 0l134.76-67a18.62 18.62 0 0 1 14.68 0l47.06 23.43c4.05 1.96 4.05 5.24 0 7.24zm0-136.53l-47.06-23.43a18.62 18.62 0 0 0-14.68 0l-134.76 67.08a18.68 18.68 0 0 1-14.67 0L81.91 220.71a18.65 18.65 0 0 0-14.69 0l-47.06 23.43c-4 2-4 5.29 0 7.31l196.51 97.8a18.6 18.6 0 0 0 14.67 0l196.5-97.8c4.05-2.02 4.05-5.3 0-7.31zM20.16 130.42l196.5 90.29a20.08 20.08 0 0 0 14.67 0l196.51-90.29c4-1.86 4-4.89 0-6.74L231.33 33.4a19.88 19.88 0 0 0-14.67 0l-196.5 90.28c-4.05 1.85-4.05 4.88 0 6.74z" class="a"/></svg>
                            <p>Módulos</p>
                        </a>
                    </li>
				 <?php } ?>
					
					 <?php if(Yii::$app->user->identity->role_id == 1 ) { ?> 
                    <li class="nav-item">
                        <a href="<?= Url::to(['role/index'], $schema = true) ?>" class="nav-link">
                        <svg width="23" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M630.6 364.9l-90.3-90.2c-12-12-28.3-18.7-45.3-18.7h-79.3c-17.7 0-32 14.3-32 32v79.2c0 17 6.7 33.2 18.7 45.2l90.3 90.2c12.5 12.5 32.8 12.5 45.3 0l92.5-92.5c12.6-12.5 12.6-32.7.1-45.2zm-182.8-21c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24c0 13.2-10.7 24-24 24zm-223.8-88c70.7 0 128-57.3 128-128C352 57.3 294.7 0 224 0S96 57.3 96 128c0 70.6 57.3 127.9 128 127.9zm127.8 111.2V294c-12.2-3.6-24.9-6.2-38.2-6.2h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 287.9 0 348.1 0 422.3v41.6c0 26.5 21.5 48 48 48h352c15.5 0 29.1-7.5 37.9-18.9l-58-58c-18.1-18.1-28.1-42.2-28.1-67.9z"/></svg>
                            <p>Roles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['bank/index'], $schema = true) ?>" class="nav-link">
                        <svg width="23" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M496 128v16a8 8 0 0 1-8 8h-24v12c0 6.627-5.373 12-12 12H60c-6.627 0-12-5.373-12-12v-12H24a8 8 0 0 1-8-8v-16a8 8 0 0 1 4.941-7.392l232-88a7.996 7.996 0 0 1 6.118 0l232 88A8 8 0 0 1 496 128zm-24 304H40c-13.255 0-24 10.745-24 24v16a8 8 0 0 0 8 8h464a8 8 0 0 0 8-8v-16c0-13.255-10.745-24-24-24zM96 192v192H60c-6.627 0-12 5.373-12 12v20h416v-20c0-6.627-5.373-12-12-12h-36V192h-64v192h-64V192h-64v192h-64V192H96z"/></svg>
                            <p>Bancos</p>
                        </a>
                    </li>
                    
                   
                    <li class="nav-item has-treeview menu-closed">
                        <a href="#" class="nav-link">
                        <svg width="23"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M288 0c-69.59 0-126 56.41-126 126 0 56.26 82.35 158.8 113.9 196.02 6.39 7.54 17.82 7.54 24.2 0C331.65 284.8 414 182.26 414 126 414 56.41 357.59 0 288 0zm0 168c-23.2 0-42-18.8-42-42s18.8-42 42-42 42 18.8 42 42-18.8 42-42 42zM20.12 215.95A32.006 32.006 0 0 0 0 245.66v250.32c0 11.32 11.43 19.06 21.94 14.86L160 448V214.92c-8.84-15.98-16.07-31.54-21.25-46.42L20.12 215.95zM288 359.67c-14.07 0-27.38-6.18-36.51-16.96-19.66-23.2-40.57-49.62-59.49-76.72v182l192 64V266c-18.92 27.09-39.82 53.52-59.49 76.72-9.13 10.77-22.44 16.95-36.51 16.95zm266.06-198.51L416 224v288l139.88-55.95A31.996 31.996 0 0 0 576 426.34V176.02c0-11.32-11.43-19.06-21.94-14.86z"/></svg>
                            <p>Localidades</p>
                            <svg width="13" class="right"  fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg>
                        </a>
                        <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= Url::to(['country/index']) ?>" class="nav-link">
                            <p>Países</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['region/index']) ?>" class="nav-link">
                            <p>Regiones</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['province/index']) ?>" class="nav-link">
                            <p>Provincias</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['city/index']) ?>" class="nav-link">
                            <p>Cuidades</p>
                        </a>
                    </li>
                    </ul>
                    </li>
					 <?php } ?>
                </ul>
            </li>
            <?php } ?>


             <?php 
             $agregar=0;
             $consultar=0;
             $_SESSION["user"] = Yii::$app->user->identity->id;
             
             $data = $query->select(['id','agregar','consultar'])->from('permission_usuario')->where('id_users ='.$_SESSION["user"].'and id_modulo = 2 and (agregar = true or consultar = true)')->orderby('id DESC')->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $agregar = $row['agregar'];    
                     $consultar = $row['consultar'];  
                 }
             }
             if($agregar == 1 || $consultar == 1 || Yii::$app->user->identity->role_id == 1)
             { 
                 ?> 
				 
				 <?php 
             $estado=0;
             $data = $query->select(['id','status'])->from('modulo')->where('id = 2')->distinct()->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $estado = $row['status'];    
                 }
             }
             if($estado == 1)
             { 
                 ?> 
            <!--Contabilidad-->
            <li class="nav-item has-treeview menu-closed">
                <a href="#" class="nav-link">
                <svg fill="white" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M400 0H48C22.4 0 0 22.4 0 48v416c0 25.6 22.4 48 48 48h352c25.6 0 48-22.4 48-48V48c0-25.6-22.4-48-48-48zM128 435.2c0 6.4-6.4 12.8-12.8 12.8H76.8c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm0-128c0 6.4-6.4 12.8-12.8 12.8H76.8c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm128 128c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm0-128c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm128 128c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8V268.8c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v166.4zm0-256c0 6.4-6.4 12.8-12.8 12.8H76.8c-6.4 0-12.8-6.4-12.8-12.8V76.8C64 70.4 70.4 64 76.8 64h294.4c6.4 0 12.8 6.4 12.8 12.8v102.4z"/></svg>
                    <p>
                    <?php
                     
                        $data = $query->select(['id','nombre'])->from('modulo')->where('id = 2')->distinct()->all();
                        if ($data) 
                        {
                            foreach ($data as $row) {
                                echo $row['nombre'];
                        
                            }
                        }
                    ?>
                        <svg width="13" class="right"  fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                <?php 
              
               
                $data = $query->select(['id','agregar','consultar'])->from('permission_usuario')->where('id_users ='.$_SESSION["user"].'and id_modulo = 2 and id_submodulos = 1')->orderby('id DESC')->all();
                if ($data) {
                     foreach ($data as $row) 
                    { 
                        $agregar = $row['agregar'];    
                        $consultar = $row['consultar'];  
                    }
                }
                if($agregar == 1 || $consultar == 1 || Yii::$app->user->identity->role_id == 1 )
                { ?>
                    
                    <li class="nav-item">
                        <a href="<?= Url::to(['accountingseats/index?AccountingSeats%5Baccount%5D=&AccountingSeats%5Bdatefrom%5D=2022-01-01&AccountingSeats%5Bdateto%5D=2022-12-31&AccountingSeats%5Bcost_center%5D=']) ?>" class="nav-link">
                        <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M288 256H96v64h192v-64zm89-151L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-153 31V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zM64 72c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8H72c-4.42 0-8-3.58-8-8V72zm0 64c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8H72c-4.42 0-8-3.58-8-8v-16zm256 304c0 4.42-3.58 8-8 8h-80c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16zm0-200v96c0 8.84-7.16 16-16 16H80c-8.84 0-16-7.16-16-16v-96c0-8.84 7.16-16 16-16h224c8.84 0 16 7.16 16 16z"/></svg>    
                        <p>Asientos
                            </p>
                        </a>
                    </li>
                <?php }?>
                <?php 
               
                $data = $query->select(['id','agregar','consultar'])->from('permission_usuario')->where('id_users ='.$_SESSION["user"].'and id_modulo = 2 and id_submodulos = 2')->orderby('id DESC')->all();
                if ($data) {
                     foreach ($data as $row) 
                    { 
                        $agregar = $row['agregar'];    
                        $consultar = $row['consultar'];  
                    }
                }
                if($agregar == 1 || $consultar == 1 || Yii::$app->user->identity->role_id == 1)
                { ?>
                
                
                    <li class="nav-item">
                        <a href="<?= Url::to(['accountingexercises/index']) ?>" class="nav-link">
                        <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm60.1 106.5L224 336l60.1 93.5c5.1 8-.6 18.5-10.1 18.5h-34.9c-4.4 0-8.5-2.4-10.6-6.3C208.9 405.5 192 373 192 373c-6.4 14.8-10 20-36.6 68.8-2.1 3.9-6.1 6.3-10.5 6.3H110c-9.5 0-15.2-10.5-10.1-18.5l60.3-93.5-60.3-93.5c-5.2-8 .6-18.5 10.1-18.5h34.8c4.4 0 8.5 2.4 10.6 6.3 26.1 48.8 20 33.6 36.6 68.5 0 0 6.1-11.7 36.6-68.5 2.1-3.9 6.2-6.3 10.6-6.3H274c9.5-.1 15.2 10.4 10.1 18.4zM384 121.9v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z"/></svg>
                            <p>Ejercicios Contables</p>
                        </a>
                    </li>
                <?php } ?>
                <?php 
              
                $data = $query->select(['id','agregar','consultar'])->from('permission_usuario')->where('id_users ='.$_SESSION["user"].' and id_modulo = 2 and id_submodulos = 4')->orderby('id DESC')->all();
                if ($data) {
                     foreach ($data as $row) 
                    { 
                        $agregar = $row['agregar'];    
                        $consultar = $row['consultar'];  
                    }
                }
                if($agregar == 1 || $consultar == 1 || Yii::$app->user->identity->role_id == 1)
                { ?>
                    
                    <li class="nav-item">
                        <a href="<?= Url::to(['chartaccounts/index'], $schema = true) ?>" class="nav-link">
                        <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-153 31V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zM64 72c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8H72c-4.42 0-8-3.58-8-8V72zm0 80v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8H72c-4.42 0-8-3.58-8-8zm144 263.88V440c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-24.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V232c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v24.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07z"/></svg>

                            <p>Plan de Cuentas</p>
                        </a>
                    </li>

                    <?php } ?>
                <?php 
              
                $data = $query->select(['id','agregar','consultar'])->from('permission_usuario')->where('id_users ='.$_SESSION["user"].'and id_modulo = 2 and id_submodulos = 5')->orderby('id DESC')->all();
                if ($data) {
                     foreach ($data as $row) 
                    { 
                        $agregar = $row['agregar'];    
                        $consultar = $row['consultar'];  
                    }
                }
                if($agregar == 1 || $consultar == 1 || Yii::$app->user->identity->role_id == 1)
                { ?>

                    <li class="nav-item">
                        <a href="<?= Url::to(['costcenter/index'], $schema = true) ?>" class="nav-link">
                        <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM96 424c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm96-192c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm128 368c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16z"/></svg>
                            <p>Centros de Costos</p>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
<?php } ?>

        <?php 
             
             $agregar=0;
             $consultar=0;
             $_SESSION["user"] = Yii::$app->user->identity->id;
             
             $data = $query->select(['id','agregar','consultar'])->from('permission_usuario')->where('id_users ='.$_SESSION["user"].'and id_modulo = 4 and (agregar = true or consultar = true)')->orderby('id DESC')->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $agregar = $row['agregar'];    
                     $consultar = $row['consultar'];  
                 }
             }
             if($agregar == 1 || $consultar == 1 || Yii::$app->user->identity->role_id == 1)
             
             { 

                 ?> 
				 <?php 
             $estado=0;
             $data = $query->select(['id','status'])->from('modulo')->where('id = 4')->distinct()->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $estado = $row['status'];    
                 }
             }
             if($estado == 1)
             { 
                 ?>
                <!--Personas-->
            <li class="nav-item has-treeview menu-closed">
                <a href="#" class="nav-link">
                <svg width="23" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"/></svg>
                    <p>
                    <?php
                        $query = new yii\db\Query();
                        $data = $query->select(['nombre'])->from('modulo')->where('id = 4')->distinct()->all();
                        if ($data) 
                        {
                            foreach ($data as $row) {
                                echo $row['nombre'];
                            }
                        }
                    ?>
                       <svg width="13" class="right"  fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= Url::to(['person/index'], $schema = true) ?>" class="nav-link">
                        <?php
                        $query = new yii\db\Query();
                        $data = $query->select(['nombre'])->from('modulo')->where('id = 4')->distinct()->all();
                        if ($data) 
                        {
                            foreach ($data as $row) {
                                echo $row['nombre'];
                            }
                        }
                        ?>
                        </a>
                    </li>
                </ul>
            </li>
			 <?php } } ?>



            <?php 
             
             $agregar=0;
             $consultar=0;
             $_SESSION["user"] = Yii::$app->user->identity->id;
             
             $data = $query->select(['id','agregar','consultar'])->from('permission_usuario')->where('id_users ='.$_SESSION["user"].'and id_modulo = 6 and id_submodulos = 60 and (agregar = true or consultar = true)')->orderby('id DESC')->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $agregar = $row['agregar'];    
                     $consultar = $row['consultar'];  
                 }
             }
             if($agregar == 1 || $consultar == 1 || Yii::$app->user->identity->role_id == 1)
             
             { 

                 ?> 
				 <?php 
             $estado=0;
             $data = $query->select(['id','status'])->from('modulo')->where('id = 6')->distinct()->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $estado = $row['status'];    
                 }
             }
             if($estado == 1)
             { 
                 ?>
                <!--Transacciones-->
            <li class="nav-item has-treeview menu-closed">
                <a href="#" class="nav-link">
                <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M377 105L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-153 31V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zM64 72c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8H72c-4.42 0-8-3.58-8-8V72zm0 80v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8H72c-4.42 0-8-3.58-8-8zm144 263.88V440c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-24.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V232c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v24.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07z"/></svg>
                    <p>
                    <?php
                        $query = new yii\db\Query();
                        $data = $query->select(['nombre'])->from('modulo')->where('id = 6')->distinct()->all();
                        if ($data) 
                        {
                            foreach ($data as $row) {
                                echo $row['nombre'];
                            }
                        }
                    ?>
                       <svg width="13" class="right"  fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg>
                    </p>
                </a>

                <ul class="nav nav-treeview">
					<li class="nav-item">
                               <a href="<?= Url::to(['cliente/index?tipos=All']) ?>" class="nav-link">
                               <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M464 480H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v352c0 26.51-21.49 48-48 48zM128 120c-22.091 0-40 17.909-40 40s17.909 40 40 40 40-17.909 40-40-17.909-40-40-40zm0 96c-22.091 0-40 17.909-40 40s17.909 40 40 40 40-17.909 40-40-17.909-40-40-40zm0 96c-22.091 0-40 17.909-40 40s17.909 40 40 40 40-17.909 40-40-17.909-40-40-40zm288-136v-32c0-6.627-5.373-12-12-12H204c-6.627 0-12 5.373-12 12v32c0 6.627 5.373 12 12 12h200c6.627 0 12-5.373 12-12zm0 96v-32c0-6.627-5.373-12-12-12H204c-6.627 0-12 5.373-12 12v32c0 6.627 5.373 12 12 12h200c6.627 0 12-5.373 12-12zm0 96v-32c0-6.627-5.373-12-12-12H204c-6.627 0-12 5.373-12 12v32c0 6.627 5.373 12 12 12h200c6.627 0 12-5.373 12-12z"/></svg>
                                    <p>Todo</p>
                                </a>
                    </li>
					<li class="nav-item">
                                
                                <a href="<?= Url::to(['cliente/index?tipos=Cliente']) ?>" class="nav-link">
                                <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M352 288h-16v-88c0-4.42-3.58-8-8-8h-13.58c-4.74 0-9.37 1.4-13.31 4.03l-15.33 10.22a7.994 7.994 0 0 0-2.22 11.09l8.88 13.31a7.994 7.994 0 0 0 11.09 2.22l.47-.31V288h-16c-4.42 0-8 3.58-8 8v16c0 4.42 3.58 8 8 8h64c4.42 0 8-3.58 8-8v-16c0-4.42-3.58-8-8-8zM608 64H32C14.33 64 0 78.33 0 96v320c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V96c0-17.67-14.33-32-32-32zM48 400v-64c35.35 0 64 28.65 64 64H48zm0-224v-64h64c0 35.35-28.65 64-64 64zm272 192c-53.02 0-96-50.15-96-112 0-61.86 42.98-112 96-112s96 50.14 96 112c0 61.87-43 112-96 112zm272 32h-64c0-35.35 28.65-64 64-64v64zm0-224c-35.35 0-64-28.65-64-64h64v64z"/></svg>
                                    <p>Venta</p>
                                </a>
                            </li>
                   <li class="nav-item">
                                <a href="<?= Url::to(['cliente/index?tipos=Proveedor']) ?>" class="nav-link">
                                <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"/></svg>

                                    <p>Compra</p>
                                </a>

                   </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['/cobros/view']) ?>" class="nav-link">
                        <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M511.1 378.8l-26.7-160c-2.6-15.4-15.9-26.7-31.6-26.7H208v-64h96c8.8 0 16-7.2 16-16V16c0-8.8-7.2-16-16-16H48c-8.8 0-16 7.2-16 16v96c0 8.8 7.2 16 16 16h96v64H59.1c-15.6 0-29 11.3-31.6 26.7L.8 378.7c-.6 3.5-.9 7-.9 10.5V480c0 17.7 14.3 32 32 32h448c17.7 0 32-14.3 32-32v-90.7c.1-3.5-.2-7-.8-10.5zM280 248c0-8.8 7.2-16 16-16h16c8.8 0 16 7.2 16 16v16c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16v-16zm-32 64h16c8.8 0 16 7.2 16 16v16c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16v-16c0-8.8 7.2-16 16-16zm-32-80c8.8 0 16 7.2 16 16v16c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16v-16c0-8.8 7.2-16 16-16h16zM80 80V48h192v32H80zm40 200h-16c-8.8 0-16-7.2-16-16v-16c0-8.8 7.2-16 16-16h16c8.8 0 16 7.2 16 16v16c0 8.8-7.2 16-16 16zm16 64v-16c0-8.8 7.2-16 16-16h16c8.8 0 16 7.2 16 16v16c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16zm216 112c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h176c4.4 0 8 3.6 8 8v16zm24-112c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16v-16c0-8.8 7.2-16 16-16h16c8.8 0 16 7.2 16 16v16zm48-80c0 8.8-7.2 16-16 16h-16c-8.8 0-16-7.2-16-16v-16c0-8.8 7.2-16 16-16h16c8.8 0 16 7.2 16 16v16z"/></svg>
                            <p>Cobros/Pagos</p>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['/anullments/index']) ?>" class="nav-link">
                        <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M464 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm-83.6 290.5c4.8 4.8 4.8 12.6 0 17.4l-40.5 40.5c-4.8 4.8-12.6 4.8-17.4 0L256 313.3l-66.5 67.1c-4.8 4.8-12.6 4.8-17.4 0l-40.5-40.5c-4.8-4.8-4.8-12.6 0-17.4l67.1-66.5-67.1-66.5c-4.8-4.8-4.8-12.6 0-17.4l40.5-40.5c4.8-4.8 12.6-4.8 17.4 0l66.5 67.1 66.5-67.1c4.8-4.8 12.6-4.8 17.4 0l40.5 40.5c4.8 4.8 4.8 12.6 0 17.4L313.3 256l67.1 66.5z"/></svg>

                            <p>Anulaciones</p>
                        </a>

                    </li>

                </ul>
            </li>
			 <?php } } ?>
           <?php 
             $estado=0;
             $data = $query->select(['id','status'])->from('modulo')->where('id = 7')->distinct()->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $estado = $row['status'];    
                 }
             }
             if($estado == 1)
             { 
                 ?>
            <!--Producto/Servicio-->
            <li class="nav-item has-treeview menu-closed">
                <a href="#" class="nav-link">
                   <svg width="22"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M425.7 256c-16.9 0-32.8-9-41.4-23.4L320 126l-64.2 106.6c-8.7 14.5-24.6 23.5-41.5 23.5-4.5 0-9-.6-13.3-1.9L64 215v178c0 14.7 10 27.5 24.2 31l216.2 54.1c10.2 2.5 20.9 2.5 31 0L551.8 424c14.2-3.6 24.2-16.4 24.2-31V215l-137 39.1c-4.3 1.3-8.8 1.9-13.3 1.9zm212.6-112.2L586.8 41c-3.1-6.2-9.8-9.8-16.7-8.9L320 64l91.7 152.1c3.8 6.3 11.4 9.3 18.5 7.3l197.9-56.5c9.9-2.9 14.7-13.9 10.2-23.1zM53.2 41L1.7 143.8c-4.6 9.2.3 20.2 10.1 23l197.9 56.5c7.1 2 14.7-1 18.5-7.3L320 64 69.8 32.1c-6.9-.8-13.5 2.7-16.6 8.9z"/></svg>
                    <p>
                    <?php
                        $query = new yii\db\Query();
                        $data = $query->select(['nombre'])->from('modulo')->where('id = 7')->distinct()->all();
                        if ($data) 
                        {
                            foreach ($data as $row) {
                                echo $row['nombre'];
                            }
                        }
                    ?>
                       <svg width="13" class="right"  fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">

                        <a href="<?= Url::to(['product/index']) ?>" class="nav-link">
                            <p>Servicios/Productos</p>
                        </a>
                    </li>
                </ul>
             
            </li>
           
            <?php 
             }
             $agregar=0;
             $consultar=0;
             $_SESSION["user"] = Yii::$app->user->identity->id;
             
             $data = $query->select(['id','agregar','consultar'])->from('permission_usuario')->where('id_users ='.$_SESSION["user"].'and id_modulo = 3 and (agregar = true or consultar = true)')->orderby('id DESC')->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $agregar = $row['agregar'];    
                     $consultar = $row['consultar'];  
                 }
             }
             if($agregar == 1 || $consultar == 1 || Yii::$app->user->identity->role_id == 1)
             
             { 

                 ?> 
				 <?php 
             $estado=0;
             $data = $query->select(['id','status'])->from('modulo')->where('id = 3')->distinct()->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $estado = $row['status'];    
                 }
             }
             if($estado == 1)
             { 
                 ?>
                <!--Bancos-->
            <li class="nav-item has-treeview menu-closed">
                <a href="#" class="nav-link">
                   <svg width="23" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M496 128v16a8 8 0 0 1-8 8h-24v12c0 6.627-5.373 12-12 12H60c-6.627 0-12-5.373-12-12v-12H24a8 8 0 0 1-8-8v-16a8 8 0 0 1 4.941-7.392l232-88a7.996 7.996 0 0 1 6.118 0l232 88A8 8 0 0 1 496 128zm-24 304H40c-13.255 0-24 10.745-24 24v16a8 8 0 0 0 8 8h464a8 8 0 0 0 8-8v-16c0-13.255-10.745-24-24-24zM96 192v192H60c-6.627 0-12 5.373-12 12v20h416v-20c0-6.627-5.373-12-12-12h-36V192h-64v192h-64V192h-64v192h-64V192H96z"/></svg>
                    <p>
                    <?php
                        $query = new yii\db\Query();
                        $data = $query->select(['nombre'])->from('modulo')->where('id = 3')->distinct()->all();
                        if ($data) 
                        {
                            foreach ($data as $row) {
                                echo $row['nombre'];
                            }
                        }
                    ?>
                        <svg width="13" class="right"  fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg>
                    </p>
                </a>
				<ul class="nav nav-treeview">
                    <li class="nav-item">
                                <a href="<?= Url::to(['bankdetails/index']) ?>" class="nav-link">
                                <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M16 128h416c8.84 0 16-7.16 16-16V48c0-8.84-7.16-16-16-16H16C7.16 32 0 39.16 0 48v64c0 8.84 7.16 16 16 16zm480 80H80c-8.84 0-16 7.16-16 16v64c0 8.84 7.16 16 16 16h416c8.84 0 16-7.16 16-16v-64c0-8.84-7.16-16-16-16zm-64 176H16c-8.84 0-16 7.16-16 16v64c0 8.84 7.16 16 16 16h416c8.84 0 16-7.16 16-16v-64c0-8.84-7.16-16-16-16z"/></svg>
                                    <p>Ver Todos</p>
                                </a>
                            </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                                <a href="<?= Url::to(['bankdetails/transaction']) ?>" class="nav-link">
                                <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"/></svg>
                                    <p>Movimientos Bancarios</p>
                                </a>
                            </li>
                </ul>
				<ul class="nav nav-treeview">
                    <li class="nav-item">
                                <a href="<?= Url::to(['bankdetails/create']) ?>" class="nav-link">
                                <svg width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"/></svg>
                                    <p>Crear Nuevo</p>
                                </a>
                            </li>
                </ul>
				
              
            </li>
			 <?php }} ?>
            <?php 
             
             $agregar=0;
             $consultar=0;
             $_SESSION["user"] = Yii::$app->user->identity->id;
             
             $data = $query->select(['id','agregar','consultar'])->from('permission_usuario')->where('id_users ='.$_SESSION["user"].'and id_modulo = 5 and (agregar = true or consultar = true)')->orderby('id DESC')->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $agregar = $row['agregar'];    
                     $consultar = $row['consultar'];  
                 }
             }
             if($agregar == 1 || $consultar == 1 || Yii::$app->user->identity->role_id == 1)
             
             { 
                 ?>
				 <?php 
             $estado=0;
             $data = $query->select(['id','status'])->from('modulo')->where('id = 5')->distinct()->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $estado = $row['status'];    
                 }
             }
             if($estado == 1)
             { 
                 ?>
             <!--Inventario-->
             <li class="nav-item has-treeview menu-closed">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-clipboard"></i>
                    <p>
                    <?php
                        $query = new yii\db\Query();
                        $data = $query->select(['nombre'])->from('modulo')->where('id = 5')->distinct()->all();
                        if ($data) 
                        {
                            foreach ($data as $row) {
                                echo $row['nombre'];
                            }
                        }
                    ?>
                       <svg width="13" class="right"  fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>Inventarios</p>
                        </a>
                    </li>
                </ul>
            
            </li>
			 <?php } }?>



            <?php 
             
             $agregar=0;
             $consultar=0;
             $_SESSION["user"] = Yii::$app->user->identity->id;
             
             $data = $query->select(['id','agregar','consultar'])->from('permission_usuario')->where('id_users ='.$_SESSION["user"].'and id_modulo = 11 and (agregar = true or consultar = true)')->orderby('id DESC')->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $agregar = $row['agregar'];    
                     $consultar = $row['consultar'];  
                 }
             }
             if($agregar == 1 || $consultar == 1 || Yii::$app->user->identity->role_id == 1)
             
             { 
                 ?>
				 <?php 
             $estado=0;
             $data = $query->select(['id','status'])->from('modulo')->where('id = 11')->distinct()->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $estado = $row['status'];    
                 }
             }
             if($estado == 1)
             { 
                 ?>
                <!--RRHH-->
            <li class="nav-item has-treeview menu-closed">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-clipboard"></i>
                    <p>
                    <?php
                        $query = new yii\db\Query();
                        $data = $query->select(['nombre'])->from('modulo')->where('id = 11')->distinct()->all();
                        if ($data) 
                        {
                            foreach ($data as $row) {
                                echo $row['nombre'];
                            }
                        }
                    ?>
                       <svg width="13" class="right"  fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>Recursos Humanos</p>
                        </a>
                    </li>
                </ul>
              
            </li>
			 <?php } } ?>



            <?php 
             
             $agregar=0;
             $consultar=0;
             $_SESSION["user"] = Yii::$app->user->identity->id;
             
             $data = $query->select(['id','agregar','consultar'])->from('permission_usuario')->where('id_users ='.$_SESSION["user"].'and id_modulo = 13 and (agregar = true or consultar = true)')->orderby('id DESC')->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $agregar = $row['agregar'];    
                     $consultar = $row['consultar'];  
                 }
             }
             if($agregar == 1 || $consultar == 1 || Yii::$app->user->identity->role_id == 1)
             
             { 
                 ?>
				 
				 <?php 
             $estado=0;
             $data = $query->select(['id','status'])->from('modulo')->where('id = 13')->distinct()->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $estado = $row['status'];    
                 }
             }
             if($estado == 1)
             { 
                 ?>
                <!--CRM-->
            <li class="nav-item has-treeview menu-closed">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-clipboard"></i>
                    <p>
                    <?php
                        $query = new yii\db\Query();
                        $data = $query->select(['nombre'])->from('modulo')->where('id = 13')->distinct()->all();
                        if ($data) 
                        {
                            foreach ($data as $row) {
                                echo $row['nombre'];
                            }
                        }
                    ?>
                        <svg width="13" class="right"  fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>CRM</p>
                        </a>
                    </li>
                </ul>
              
            </li>
			 <?php } } ?>


            <?php 
             
             $acceder=0;
             
             $_SESSION["user"] = Yii::$app->user->identity->id;
             
             $data = $query->select(['id','acceder'])->from('permission_usuario')->where('id_users ='.$_SESSION["user"].'and id_modulo = 8 and acceder = true')->orderby('id DESC')->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $acceder = $row['acceder'];    
                     
                 }
             }
             if($acceder == 1 || Yii::$app->user->identity->role_id == 1)
             
             { 

                 ?> 
				 <?php 
             $estado=0;
             $data = $query->select(['id','status'])->from('modulo')->where('id = 8')->distinct()->all();
             if ($data) {
                  foreach ($data as $row) 
                 { 
                     $estado = $row['status'];    
                 }
             }
             if($estado == 1)
             { 
                 ?>
             <!--Reportes-->
             <li class="nav-item has-treeview menu-closed">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-clipboard"></i>
                    <p>
                    <?php
                        $query = new yii\db\Query();
                        $data = $query->select(['nombre'])->from('modulo')->where('id = 8')->distinct()->all();
                        if ($data) 
                        {
                            foreach ($data as $row) {
                                echo $row['nombre'];
                            }
                        }
                    ?>
                       <svg width="13" class="right"  fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>Reportes</p>
                        </a>
                    </li>
                </ul>
              
            </li>
			 <?php } } ?>
            
        </ul>
        <?php } ?>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
