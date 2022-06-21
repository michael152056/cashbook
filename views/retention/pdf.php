<?php

use app\models\Product;
use app\models\Retention;

$producto=New Product;
$get=$_GET["ischair"];
$sum=0;
foreach ($model2 as $mbody){
    if(!is_null($mbody->retencion_imp)){
        $retencion=Retention::findOne($mbody->retencion_imp);
        $base=$mbody->precio_total;
        $porcentaje=$retencion->percentage;
        $sum+=$base*$porcentaje/100;
    }
    if(!is_null($mbody->retencion_iva)){
        $retencion=Retention::findOne($mbody->retencion_iva);
        $base=($mbody->precio_total*12)/100;
        $porcentaje=$retencion->percentage;
        $sum+=$base*$porcentaje/100;
    }

}
?>

<table border="0" cellpadding="1" cellspacing="3" style="width:100%;font-family: Arial;font-size:9pt;padding-left: 70px">

    <tr>
        <td><?=  Yii::$app->formatter->asDatetime($model->f_timestamp,"yyyy")."    ".Yii::$app->formatter->asDatetime($model->f_timestamp,"MM")."     ". Yii::$app->formatter->asDatetime($model->f_timestamp,"dd")?></td>
        <td style="padding-left: 230px">Factura de Compra </td>
    <tr>
        <td><?=$personam->name?></td>
        <td style="padding-left: 230px"><?=$personam->cedula?></td>
    </tr>
    <tr>
        <td> <?= $personam->ruc ?></td>
        <td style="padding-left: 230px"> <p>2022</p></td>
    </tr>
</table>

<br><br><br>
<div class="container">
    <table border="0" cellpadding="4" cellspacing="0" style="width:100%;font-family: Arial;font-size:9pt ;padding-left: 59px">
        <tbody>
        <?php foreach($model2 as $mbody): ?>
            <?php if(!is_null($mbody->retencion_imp)):?>
                <?php
                $retencion=Retention::findOne($mbody->retencion_imp);
                $tipo="Impuesto";
                $codesri=$retencion->codesri;
                $base=$mbody->precio_total;
                $porcentaje=$retencion->percentage;
                $tipo=($retencion->type==1)?"RENTA":"IVA";
                $total=$base*$porcentaje/100;
                ?>
                <tr>
                    <td><?=sprintf('%.2f',$base)?></td>
                    <td><?=sprintf('%.2f',$porcentaje)?></td>
                    <td><?=sprintf('%.2f',$total)?></td>
                    <td><?=$codesri?></td>
                    <td><?=$tipo?></td>
                </tr>
            <?php endif?>
            <?php if(!is_null($mbody->retencion_iva)):?>
                <?php
                $retencion=Retention::findOne($mbody->retencion_iva);
                $tipo="Iva";
                $codesri=$retencion->codesri." ".$retencion->slug;
                $base=($mbody->precio_total*12)/100;
                $porcentaje=$retencion->percentage;
                $total=$base*$porcentaje/100;
                ?>
                <tr>
                    <td><?=$codesri?></td>
                    <td><?=$tipo?></td>
                    <td><?=$base?></td>
                    <td><?=$porcentaje?></td>
                    <td><?=$total?></td>
                </tr>
            <?php endif?>
        <?php endforeach ?>

        </tbody>
    </table>
    
</div>
<div class="col-3">


</div>
<?php if($get==1) : ?>
    <?php $i=0; ?>
    <?php foreach($modelas as $modelo):?>
        <?= (Yii::debug($modelo))?>
        <?php
        $ifex=\app\models\ChargesDetail::find()->where(["id_asiento"=>$modelo->id])->exists()
        ?>
        <?php if(!$ifex):?>
            <?php if($i==0){?>
                <h5 class="text-center"><b>Asiento Contable</b></h5>
            <?php }else{?>
                <h5 class="text-center"><b>Asiento Inventario</b></h5>
            <?php }?>
            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;font-family: Arial;font-size:9pt">
                <tr>
                    <td style="width:35%"><b>Fecha:</b></td>
                    <td><?= $modelo->date?></td>
                </tr>
                <tr>
                    <td><b>Código:</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>Glosa:</b></td>
                    <td><?= $modelo->description?></td>
                </tr>
                <tr>
                    <td><b>Gasto No Deducible:</td>
                    <td><?= $modelo->nodeductible?'Si':'No'?></td>
                </tr>
            </table>
            <br>
            <b><u><i> Detalle del Asiento</i><u></b>
            <table border="1" cellpadding="0" cellspacing="0" style="width:100%;font-family: Arial;font-size:10pt">
                <thead>
                <tr>
                    <th class="text-center" style="width:100%">Cuenta</th>
                    <th class="text-right" style="width:100px;text-align: center;">Debe</th>
                    <th class="text-right" style="width:100px;text-align: center;">Haber</th>
                    <th class="text-center" style="width:200px">Centro de Costo</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $debit = 0;
                $credit = 0;
                //debe
                $list = AccountingSeatsDetails::find()->where(['accounting_seat_id' => $modelo->id])->andWhere(['>', 'debit', 0])->all();
                foreach ($list as $detail) {
                    $debit += $detail->debit;
                    ?>
                    <tr>
                        <td><?= $detail->chartAccount->code . ' ' . $detail->chartAccount->slug ?></td>
                        <td style="text-align:right;">$<?= sprintf('%.2f', $detail->debit) ?></td>
                        <td style="text-align:right;"></td>


                        <td style="text-align:left;"><?= $detail->costCenter ? $detail->costCenter->name : '' ?></td>
                    </tr>
                    <?php
                }
                //haber
                $list = AccountingSeatsDetails::find()->where(['accounting_seat_id' => $modelo->id])->andWhere(['>', 'credit', 0])->all();
                foreach ($list as $detail) {
                    $credit += $detail->credit;
                    ?>
                    <tr>
                        <td style="padding-left:60px;"><?= $detail->chartAccount->code . ' ' . $detail->chartAccount->slug ?></td>
                        <td style="text-align:right;"></td>
                        <td style="text-align:right;">$<?= sprintf('%.2f', $detail->credit) ?></td>

                        <td style="text-align:left;"><?= $detail->costCenter ? $detail->costCenter->name : '' ?></td>

                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td style="text-align: right;">
                        <b>Total</b>
                    </td>
                    <td class="text-right">$<?= sprintf('%.2f', $debit) ?></td>
                    <td class="text-right">$<?= sprintf('%.2f', $credit) ?></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <br>
            <br>
            <?php $i=$i+1; ?>
        <?php endif?>
    <?php endforeach?>

<?php endif; ?>
<div style = " position:absolute; z-index: 99999; bottom:0; margin:40px;margin-right:59px">
    <table style="text-align: center; width:100%;font-family: Arial;font-size:9pt">
        <tr>
            <td class="fin">
                <?=sprintf('%.2f',$sum)?>
            </td>
        </tr>
    </table>

</div>
