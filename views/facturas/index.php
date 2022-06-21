<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FacturaBodySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Factura Bodies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="factura-body-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Factura Body', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cant',
            'precio_u',
            'precio_total',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
