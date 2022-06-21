<?php

use app\models\Institution;
use yii\helpers\Url;
use yii\db\Query;
return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
      

     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'name',
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'number_account',
     ],
     [
        'attribute' => 'chart_account_id',
        'label'=>'Cuenta Contable Bancaria',
        'value' => function ($data){
            $sql = new Query;
            $person = Yii::$app->user->identity->person_id;
            $result = $sql->select(['*'])->from('person')->where(['id' => $person])->all();
            $institution = $result[0]['institution_id'];
           $var=\app\models\ChartAccountsSearch::find()->where(["id" => $data->chart_account_id])->andwhere(["institution_id" => $institution])->one();
            yii::debug($var);
           return $var->slug ;
        }
    ],
    [
        'attribute' => 'city_id',
        'label'=>'Ciudad',
        'value' => function ($data){
            $var=\app\models\City::findOne(["id" => $data->city_id]);
            return $var->cityname ;
        }
    ], 
    [ 'class'=>'kartik\grid\ActionColumn',],

];   