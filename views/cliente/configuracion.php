<?php
?>
<div class="card">

    <div class="card-header bg-blue">
        <h4>Configuracion Factura</h4>
    </div>

    <div class="card-body">
        <?php
        use yii\helpers\Html;
        use yii\widgets\ActiveForm;

        $form = ActiveForm::begin(); ?>
        <?=$form->field($head,"n_documentos")->textarea() ?>
        <?=Html::submitButton('Guardar', ['class' => 'btn btn-success float-right ','id'=>"buttonsubmit"]) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
