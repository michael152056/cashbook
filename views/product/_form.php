<?php

use app\models\Institution;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\db\Query;
$sql = new Query;
$person = Yii::$app->user->identity->person_id;
$result = $sql->select(['*'])->from('person')->where(['id' => $person])->all();
$institution = $result[0]['institution_id'];

$accountdata = ArrayHelper::map(\app\models\ChartAccounts::find()
    ->Select(["id,concat(code,' ',slug) as name"])
    ->alias('t')
    ->where(['(select count(*) from chart_accounts t2 where t2.parent_id=t.id)'=>0])->andWhere(['institution_id'=>$institution])->asArray()->all(),'id', 'name');

$accountdataingresos = ArrayHelper::map(\app\models\ChartAccounts::find()
    ->Select(["id,concat(code,' ',slug) as name"])
    ->alias('t')
    ->where(['(select count(*) from chart_accounts t2 where t2.parent_id=t.id)'=>0])->andWhere(['parent_id'=>13364])->andWhere(['institution_id'=>$institution])->asArray()->all(),'id', 'name');

Yii::debug($accountdataingresos);
$listpr=ArrayHelper::map($model2,"name","name");
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

        <div class="card">
            <div class="card-header bg-primary">
                Productos y Servicios
            </div>
            <div class="card-body">
                <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-12 ">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status')->checkbox() ?>
                <?=$form->field($model2[0],"name")->dropDownList($listpr,['prompt'=>'Select...','readonly'=>false,'id'=>'listpr'])->label("Tipo");?>
                <?=$form->field($model,"type_fact")->dropDownList(["Cliente"=>"Cliente","egresos"=>"Proveedor"],['prompt'=>'Select...','readonly'=>false,'id'=>'opt']);?>

                <?= $form->field($model, 'category')->textInput(['maxlength' => true])->label() ?>

                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-12 ">
                <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'product_iva_id')->dropDownList(['12' => '12%', '0' => '0%'], ['prompt' => 'Seleccione una opción']); ?>

                <?= $form->field($model, 'precio')->textInput() ?>

                <?= $form->field($model, 'costo')->textInput(['id'=>'listpro','readonly' => false]) ?>

                    </div>
                </div>
                </div>
            </div>
    <div class="card">
        <div class="card-header bg-primary">
            Contabilidad
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-12 ">
                    <div class="ingresos">
                    <?=HTML::tag("label","Ingresos")?>
                    <?=
                    Select2::widget([
                        'model' => $model,
                        'attribute' => 'charingresos',
                        'id' => 'accountingresos',
                        'name' => 'accountingresos',
                        'data' => $accountdataingresos ,
                        'options' => [
                            'placeholder' => 'Seleccione una cuenta contable',
                            'id'=>"ingres"
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]);
                    ?>
                    </div>


                    <br>
                    <br>
                    <?=HTML::tag("label","Activos",["id"=>"activos"])?>
                    <?=
                    Select2::widget([
                        'model' => $model,
                        'attribute' => 'chairaccount_id',
                        'id' => 'accountd',
                        'name' => 'account_data',
                        'data' => $accountdata,
                        'options' => [
                            'placeholder' => 'Seleccione una cuenta contable',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]);
                    ?>
                    <br>
                    <br>
                    <div class="inve">
                    <?=HTML::tag("label","Inventarios",["id"=>"linventario"])?>
                    <?=

                    Select2::widget([
                        'model' => $model,
                        'attribute' => 'Chairinve',
                        'name' => 'accountive',
                        'data' => $accountdata,
                        'options' => [
                            'placeholder' => 'Seleccione una cuenta contable',
                            'id' => 'account'
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]);
                    ?>
                    </div>
                </div>
                </div>
            </div>
</div>
        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>



                <?php ActiveForm::end(); ?>
            </div>
        </div>


</div>
<?php
$js= <<< JS
               $('#listpr').change(function(){
                      c=$(this).val();
                      if(c=='servicio'){
                      $('#account').parent().hide();
                      $('#listpro').val('0');
                      }
                      if(c=='producto'){
                       $('#account').parent().show();
                       $('#ingres').parent().show();
                       $('#activos').text("Inventario");
                            $('#linventario').text("Egresos");
                       $('#account').show();
                      $('#listpro').attr({
                      
                      });
                      }
                     });
                    $('#opt').change(function(){
                        fa=$('#listpr').val();
                        ha=$(this).val();
                        if(fa=="servicio" && ha=="egresos"){
                            $('#ingres').parent().hide();
                            $('#activos').text("Pasivos");
                            $('#linventario').text("Egresos");
                            $('#account').parent().show();
                        }
                    })
JS;
$this->registerJs($js, View::POS_READY);
?>
