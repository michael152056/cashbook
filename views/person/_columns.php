<?php

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

return [
    ['class' => 'yii\grid\SerialColumn'
],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'cedula',
        'width'=>'180px',
        'filterInputOptions' => [
            'class'       => 'form-control',
            'placeholder' => 'Filtrar cédula...'
        ],
        'headerOptions' => ['style' => 'width:20%'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'name',
        'width' => '300px',
        'filterInputOptions' => [
            'class'       => 'form-control',
            'placeholder' => 'Filtrar nombre...'
         ]
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'address',
        'width' => '200px',
        'filterInputOptions' => [
            'class'       => 'form-control',
            'placeholder' => 'Filtrar dirección...'
         ]
    ]/* ,
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'cedula',
        'width' => '150px',
    ], */,
     [
        'attribute' => 'rol',
        
        'vAlign' => 'middle',
        'value' => function ($model, $key, $index, $widget) {
            $rol = [];
            if ($model->clients) {
                $rol[]='Cliente';
                
            };
            if ($model->providers) {
                $rol[]='Proveedor';  
            };
            if ($model->employees) {
                $rol[]='Empleado';
                
            };
            if ($model->shareholders) {
                $rol[]='Accionista';
                
            };
            if ($model->salesmen) {
                $rol[]='Vendedor';
                
            };

            return implode(' | ',$rol);
        },
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => ['client' => 'Cliente', 'provider' => 'Proveedor', 'employee' => 'Empleado', 'shareholder' => 'Accionista', 'salesman' => 'Vendedor'],
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['multiple' => true], // allows multiple authors to be chosen
        'format' => 'raw',
        'width'=>'170px',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'phones',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'address',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'foreigner',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'category',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'emails',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'associated_person',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'status',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'created_at',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'updated_at',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'deleted_at',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'institution_id',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'template' => '<img class="mr-2" src="/images/svg/icons/view-icon.svg"></img> <img  class="mr-2" src="/images/svg/icons/edit-icon.svg"></img> <img  class="mr-2" src="/images/svg/icons/delete-icon.svg"></img> ',
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
        'deleteOptions' => [
            'role' => 'modal-remote', 'title' => 'Delete',
            'data-confirm' => false, 'data-method' => false, // for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Are you sure?',
            'data-confirm-message' => 'Are you sure want to delete this item'
        ],
        'width'=>'180px',
        
    ],

];
