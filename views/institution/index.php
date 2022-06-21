<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\bootstrap4\Modal;
    use kartik\grid\GridView;
    use hoaaah\ajaxcrud\CrudAsset; 
    use hoaaah\ajaxcrud\BulkButtonWidget;
    $query = new yii\db\Query();
    $this->title = 'Empresas';
    CrudAsset::register($this);
?>
<div class="institution-index">
    <div id="ajaxCrudDatatable">
        <?= Html::a('Crear Empresa', ['create'],
            ['role'=>'modal-remote','title'=> 'Crer nueva Empresa','class'=>'btn btn-primary btn-lg'])?>
        <br><br>
        <form method="get" action="index">
            <div  class="container">
                <div class="row">
                    <div class="col">
                        <input type="text" name="filtro" class="form-control">
                    </div>
                    <div class="col">
                        <input type="submit" name="enviar" value="buscar" class="btn btn-primary">
                    </div>
                    <div class="col">
                        <a href="excel"> <img src="<?= Yii::getAlias('@web') . "/images/excel.png" ?>" width=10% height=100%></a>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <?php
            $colums = ['Ruc','Razon Social','Nombre Comercial', 'Acciones'];
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
        <table class="table">
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
                        <td>
                            <?= Html::a('1', ['view?id='.$row['id']], ['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'])?>
                            <?= Html::a('2', ['update?id='.$row['id']], ['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'])?>
                            <?= Html::a('3', ['delete?id='.$row['id']], ['role'=>'modal-remote','title'=>'Delete', 
                            'data-confirm'=>false, 'data-method'=>false,
                            'data-request-method'=>'post',
                            'data-toggle'=>'tooltip',
                            'data-confirm-title'=>'Are you sure?',
                            'data-confirm-message'=>'Are you sure want to delete this item'])?>
                        </td>
                    </tr>
                    <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",
])?>
<?php Modal::end(); ?>
