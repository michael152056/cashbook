<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\bootstrap4\Modal;
    use kartik\grid\GridView;
    use hoaaah\ajaxcrud\CrudAsset; 
    use hoaaah\ajaxcrud\BulkButtonWidget;
    use yii\data\Paginator;

    $query = new yii\db\Query();
    $sql = new yii\db\Query();
    $this->title = 'Personas';
    CrudAsset::register($this);
    use yii\widgets\LinkPager;
    $person = Yii::$app->user->identity->person_id;
    $result = $sql->select(['*'])->from('person')->where(['id' => $person])->all();
    $institution = $result[0]['institution_id'];
?>
<link rel="stylesheet" type="text/css" href="/css/persona.css">

<div class="institution-index">
    <div id="ajaxCrudDatatable">
        <?=Html::a('Agregar Persona', ['create','id'=>$searchModel->institution_id],
            ['role'=>'modal-remote','title'=> 'Crear una nueva Persona','class'=>'btn btn-primary btn-lg'])?>
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
                        <a href="person/excel"> <img src="<?= Yii::getAlias('@web') . "/images/excel.png" ?>" width=10% height=100%></a>
                    </div>
                </div>
            </div>
        </form>
        <br>
      
        <?php
            $colums = ['DNI','Nombre','Casa','Rol', 'Acciones'];
            if(isset($_GET["filtro"])){
                $filtro = $_GET["filtro"];
                $data = $query->select(['*'])->from('person')
                ->where(['institution_id' => $institution])
                ->andwhere(['like', 'cedula', $filtro.'%', false])
                ->orWhere(['like', 'name', $filtro.'%', false])
                ->orwhere(['like', 'address', $filtro.'%', false])
                ->all();
            }else{
                $data = $query->select(['*'])->from('person,clients')
                ->where('person.institution_id ='. $institution.' and person.id = clients.person_id order by address')
                ->all();
            } 
        ?> 

        
        <table class="table  table-blue">
                    <thead class="thead-dark" style=" border-top-right-radius: 15px !important;
            border-top-left-radius: 15px !important;">

                        <?php 
                        foreach($colums as $fila): ?>
                            <th><?=$fila?></th>   
                        <?php endforeach ?>
                    </thead>
                    <tbody>
                            <?php foreach($data as $row): ?>
                            <tr>
                                <td><?=$row['cedula'];?></td>
                                <td><?=$row['name'];?></td>
                                <td><?=$row['address'];?></td>
                                <td>Cliente</td>
                                <td>
                                    <?= Html::a('<svg style="margin-right: 1em" fill="gray" width="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M279.6 160.4C282.4 160.1 285.2 160 288 160C341 160 384 202.1 384 256C384 309 341 352 288 352C234.1 352 192 309 192 256C192 253.2 192.1 250.4 192.4 247.6C201.7 252.1 212.5 256 224 256C259.3 256 288 227.3 288 192C288 180.5 284.1 169.7 279.6 160.4zM480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6V112.6zM288 112C208.5 112 144 176.5 144 256C144 335.5 208.5 400 288 400C367.5 400 432 335.5 432 256C432 176.5 367.5 112 288 112z"/></svg>', ['view?id='.$row['id']], ['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'])?>
                                    <?= Html::a('<svg style="margin-right: 1em" fill="gray" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z"/></svg>', ['update?id='.$row['id']], ['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'])?>
                                    <?= Html::a('<svg  fill="gray" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z"/></svg>', ['delete?id='.$row['id']], ['role'=>'modal-remote','title'=>'Delete', 
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
    "size" => "modal-xl",
    'clientOptions' => [
        'backdrop' => 'static',
        'keyboard' => false,
    ],
])?>
<?php Modal::end(); ?>
