<html>
    <?php
        use yii\helpers\Url;
        use yii\helpers\Html;
        use kartik\grid\GridView;
        use hoaaah\ajaxcrud\CrudAsset; 
        use hoaaah\ajaxcrud\BulkButtonWidget;
        $query = new yii\db\Query();
        header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
        header("Content-Disposition: attachment; filename=Empresas.xls");
            $colums = ['Ruc','Razon Social','Nombre Comercial'];
        if(isset($_GET["filtro"])){
            $filtro = $_GET["filtro"];
            $data = $query->select(['*'])->from('institution')
            ->where(['like', 'ruc', $filtro.'%', false])
            ->orWhere(['like', 'razon_social', $filtro.'%', false])
            ->orwhere(['like', 'nombre_comercial', $filtro.'%', false])
            ->all();
        }else{
            $data = $query->select(['*'])->from('institution')
            ->all();
        }
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
                    <td><?=$row['ruc'];?></td>
                    <td><?=$row['razon_social'];?></td>
                    <td><?=$row['nombre_comercial'];?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</html>
