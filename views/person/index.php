<script>
    function search(word) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                var temp = document.createElement('div');
                temp.innerHTML = this.responseText;
                var table = temp.querySelector('#table');
                document.getElementById('table').innerHTML = table.outerHTML;

            }

        }
        xmlhttp.open("GET", "index?filtro=" + word, true);
        xmlhttp.send();
    }
</script>

<?php

use app\models\Person;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use hoaaah\ajaxcrud\CrudAsset;
use hoaaah\ajaxcrud\BulkButtonWidget;
use yii\data\Pagination;
use yii\data\Paginator;
use yii\widgets\LinkPager;

$query = new yii\db\Query();
$sql = new yii\db\Query();

$this->title = 'Personas' ?>


<?php
CrudAsset::register($this);


$person = Yii::$app->user->identity->person_id;
$result = $sql->select(['*'])->from('person')->where(['id' => $person])->all();
$institution = $result[0]['institution_id'];
$results_per_page = 10;
?>


<link rel="stylesheet" type="text/css" href="/css/persona.css">

<div class="institution-index">
    <div id="ajaxCrudDatatable">

        <form method="get" action="index">
            <div class="container container_tools">
                <div class="row mb-4">

                    <div class="col  search_bar">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><svg fill="#051E34" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                                    <path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" />
                                </svg></span>
                            <input type="text" class="form-control filter" placeholder="Buscar..." name="filtro" onchange="return search(this.value);" aria-label="Username" aria-describedby="addon-wrapping">
                        </div>

                    </div>

                    <div class="col justify-content-end d-flex m-4">
                        <a href="person/excel"><button class="btn btn-pdf  mr-4"><img src="/images/svg/pdf_icon.svg" alt=""></button> </a>
                        <a href="person/excel"><button class="btn btn-excel  mr-4"><img src="/images/svg/excel_icon.svg" alt=""></button> </a>

                        <?= Html::a(
                            '<svg width="18" fill="white" style="margin: 5px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M624 208h-64v-64c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v64h-64c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h64v64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-64h64c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>Agregar Persona',
                            ['create', 'id' => $searchModel->institution_id],
                            ['role' => 'modal-remote', 'title' => 'Crear una nueva Persona', 'class' => 'btn btn-success btn-add']
                        ) ?>
                    </div>




                </div>

                <div class="row">
                    <div class="col  search_bar">


                    </div>
                    <!--                     <div class="col">
                        <input type="submit" name="enviar" value="buscar" class="btn btn-primary">
                    </div> -->
                </div>
            </div>
        </form>
        <br>

        <?php
        $colums = ['DNI', 'Nombre', 'Casa', 'Rol', 'Acciones'];

        if (isset($_GET["filtro"])) {

            $filtro = $_GET["filtro"];
            $data = Person::find()
                ->where(['institution_id' => $institution])
                ->andwhere(['like', 'cedula', $filtro . '%', false])
                ->orWhere(['like', 'name', $filtro . '%', false])
                ->orwhere(['like', 'address', $filtro . '%', false]);
            $count = clone $data;
            $pages = new Pagination([
                "pageSize" => 10,
                "totalCount" => $count->count()
            ]);
            $model = $data
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        } else {
            $data = Person::find();
            $count = clone $data;
            $pages = new Pagination([
                "pageSize" => 10,
                "totalCount" => $count->count()
            ]);
            $model = $data->offset($pages->offset)->limit($pages->limit)->all();
        }
        ?>

        <table class="table  table-blue" id="table">
            <thead class="thead-dark" style=" border-top-right-radius: 15px !important;
            border-top-left-radius: 15px !important;">

                <?php
                foreach ($colums as $fila) : ?>
                    <th><?= $fila ?></th>
                <?php endforeach ?>
            </thead>
            <tbody>


                <?php
                foreach ($model as $row) : ?>
                    <tr>
                        <td width="20%"><?= $row->cedula ?></td>
                        <td width="30%"><?= $row->name ?></td>
                        <td width="15%"><?= $row->address; ?></td>
                        <td width="15%">Cliente</td>
                        <td width="10%">
                            <?= Html::a('<svg style="margin-right: 1em" fill="#051E34" width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M279.6 160.4C282.4 160.1 285.2 160 288 160C341 160 384 202.1 384 256C384 309 341 352 288 352C234.1 352 192 309 192 256C192 253.2 192.1 250.4 192.4 247.6C201.7 252.1 212.5 256 224 256C259.3 256 288 227.3 288 192C288 180.5 284.1 169.7 279.6 160.4zM480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6V112.6zM288 112C208.5 112 144 176.5 144 256C144 335.5 208.5 400 288 400C367.5 400 432 335.5 432 256C432 176.5 367.5 112 288 112z"/></svg>', ['view?id=' . $row['id']], ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip']) ?>
                            <?= Html::a('<svg style="margin-right: 1em" fill="#051E34" width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z"/></svg>', ['update?id=' . $row['id']], ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip']) ?>
                            <?= Html::a('<svg  fill="#051E34" width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z"/></svg>', ['delete?id=' . $row['id']], [
                                'role' => 'modal-remote', 'title' => 'Delete',
                                'data-confirm' => false, 'data-method' => false,
                                'data-request-method' => 'post',
                                'data-toggle' => 'tooltip',
                                'data-confirm-title' => 'Are you sure?',
                                'data-confirm-message' => 'Are you sure want to delete this item'
                            ]) ?>
                        </td>
                    </tr>

                <?php endforeach ?>




            </tbody>
        </table>
        <div class="row resultados">
           <!--  <div class="col justify-content-end d-flex p-4">
                <h5 class="d-flex"> <?= $count->count() ?> Resultados</h5>
            </div> -->
            <div class="col">
                <?= LinkPager::widget([
                    "pagination" => $pages,
                    'prevPageLabel' => '<div><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5303 18.5303C14.2374 18.8232 13.7626 18.8232 13.4697 18.5303L7.46967 12.5303C7.17678 12.2374 7.17678 11.7626 7.46967 11.4697L13.4697 5.46967C13.7626 5.17678 14.2374 5.17678 14.5303 5.46967C14.8232 5.76256 14.8232 6.23744 14.5303 6.53033L9.06066 12L14.5303 17.4697C14.8232 17.7626 14.8232 18.2374 14.5303 18.5303Z" fill="#030D45"/>
            </svg></div>
            ',
                    'nextPageLabel' => '<div><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.46967 5.46967C9.76256 5.17678 10.2374 5.17678 10.5303 5.46967L16.5303 11.4697C16.8232 11.7626 16.8232 12.2374 16.5303 12.5303L10.5303 18.5303C10.2374 18.8232 9.76256 18.8232 9.46967 18.5303C9.17678 18.2374 9.17678 17.7626 9.46967 17.4697L14.9393 12L9.46967 6.53033C9.17678 6.23744 9.17678 5.76256 9.46967 5.46967Z" fill="#030D45"/>
            </svg></div>
            ',
                ])  ?>
            </div>

        </div>





    </div>
</div>

<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "",
    "size" => "modal-xl",
    'clientOptions' => [
        'backdrop' => 'static',
        'keyboard' => false,
    ],
]) ?>
<?php Modal::end(); ?>