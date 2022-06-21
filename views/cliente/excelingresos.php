<html>
    <?php
        use yii\helpers\Url;
        use yii\helpers\Html;
        use kartik\grid\GridView;
        use hoaaah\ajaxcrud\CrudAsset; 
        use hoaaah\ajaxcrud\BulkButtonWidget;
        $query = new yii\db\Query();
        header("Content-Type: application/vnd.ms-excel;  charset=ISO-8859-1");
        header("Content-Disposition: attachment; filename=Ingresos.xls");
            $colums = ['Fecha','Comprobante','N Factura','Descripción','Usuario','Cedula','Casa','Valor'];
      
            $data = $query->select(['*'])->from('ingresos')
            ->all();
    ?> 
    <table class="table" border=1>
        <thead class="thead-dark">
            <?php foreach($colums as $fila): ?>
                <th><?=$fila?></th>   
            <?php endforeach ?>
        </thead>
        <tbody>
            <?php foreach($data as $row): ?>
                <tr>
                    <td><?=$row['fecha'];?></td>
                    <td><?=$row['comprobante'];?></td>
                    <td><?=$row['factura'];?></td>
                    <td><?=$row['descripcion'];?></td>
                    <td><?=$row['nombre'];?></td>
                    <td><?=$row['cedula'];?></td>
                    <td><?php
                        if($row['casapagada']==''){
                            ?>
                            <?=$row['casa'];?>
                            <?php
                        }else{
                        ?><?=$row['casapagada'];?>
                    <?php    
                    }
                    ?></td>
                    <td><?=$row['total'];?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</html>