<?php
    use app\models\Product;
    $producto=New Product;
    $get=$_GET["ischair"];
    $models=$_GET["id"];
    $isc=\app\models\Charges::find()->where(["n_document"=>$models])->exists();
    if($isc) {
        $chart = \app\models\Charges::findOne(["n_document" => $models]);
        $charta = \app\models\ChargesDetail::findOne(["id_charge" => $chart->id]);
    }
    else{
        $charta=False;
    }
?>
    <div style="position: absolute; top: 90px; left: 110px; font-family: Arial;font-size:9pt;" >
        Quito,&nbsp;&nbsp;<?=Yii::$app->formatter->asDatetime($model->f_timestamp,"yyyy-MM-dd")?>
    </div>
    <div style="position: absolute; top: 115px; left: 110px; font-family: Arial;font-size:9pt;">
        <?=$personam->name?>
    </div>
    <div style="position: absolute; top: 115px; left: 570px; font-family: Arial;font-size:9pt;">
        <?=$personam->cedula?>
    </div>
    <div style="position: absolute; top: 135px; left: 110px; font-family: Arial;font-size:9pt;">
        LOTE: <?= ($model->casas)?:($personam->address)?>
    </div>
    <div style="position: absolute; top: 135px; left: 570px; font-family: Arial;font-size:9pt;">
        <?=$personam->phones?>
    </div>
    <div class="container" style="position: absolute; top: 190px; left: 5px;">
        <table border="0" cellpadding="2" cellspacing="0" style=";font-family: Arial;font-size:7pt ;padding-left: 53px;border-spacing:-4px">
            <tbody>
                <?php foreach($model2 as $mbody): ?>
                    <?php $pro=$producto::findOne($mbody->id_producto)?>
                        <tr style="line-height : 25px">
                            <td width ="75"align="left" ><?=sprintf('%.2f',$mbody->cant)?></td>
                            <td width ="71" align="left"></td>
                            <td width ="200" align="left">
                           

                            <?php
                        if($mbody->descripcion == null )
                        {
                            ?><?=
                            $pro->name
                            ?>
                            <?php
                        }
                        else{
                            ?>
                            <?=
                                $mbody->descripcion
                            ?>
                            <?php
                        }
                ?>


                           </td>
                            <td width ="225" align="right"><?=sprintf('%.2f',$mbody->precio_u)?></td>
                            <td width ="125" align="right"><?=sprintf('%.2f',$mbody->precio_total)?></td>
                        </tr>

                        <tr>
                        </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <div style = "position:absolute; z-index: 99999; bottom:0;margin-top:10px; margin-left:150px;">
        <table>
            <tr style="margin-left:150px ;font-size:3pt">
                <td style="margin:150px">
                    <p style="margin-left:150px ;font-size:7pt"><?= $modelfin->description?></p>
                    <p style="margin-left:150px;font-size:7pt;margin-top: 100px"><?= ($charta && $charta->combancario!=="efectivo")?"TRANS ".$charta->combancario:"efectivo"?></p>
                </td>
            </tr>
        </table>
    </div>
</div>
<div style="position: absolute; top: 390px; right: 65px; font-family: Arial;font-size:9pt;" >
    <?=sprintf('%.2f',$modelfin->subtotal12?:0 + $modelfin->subtotal0?:0) ?>
</div>
<div style="position: absolute; top: 415px; left: 705px; font-family: Arial;font-size:9pt;" >
    <?=sprintf('%.2f',$modelfin->iva)?>
</div>
<div style="position: absolute; top: 440px; left: 705px; font-family: Arial;font-size:9pt;" >
    <?=sprintf('%.2f',!is_null($modelfin->descuento)?$modelfin->descuento:0)?>
</div>
<div style="position: absolute; top: 465px; right: 65px; font-family: Arial;font-size:9pt;" >
    <?=sprintf('%.2f',$modelfin->total)?>
</div>
