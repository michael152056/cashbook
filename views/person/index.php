<!-- 
<script>
    function search(word) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                var temp = document.createElement('div');
                temp.innerHTML = this.responseText;
                var table = temp.querySelector('#crud-datatable-container');
                document.getElementById('crud-datatable-container').innerHTML = table.outerHTML;

            }

        }
        xmlhttp.open("GET", "index?filtro=" + word, true);
        xmlhttp.send();
    }
</script>  -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- <script>
    var input;
    var submit_form = false;
    var filter_selector = '#formsearch-q';

    $(document).on('beforeFilter', "#crud-datatable" , function(event) {
        console.log('pass1');
        return submit_form;
    });

    $(document).on('afterFilter', "#crud-datatable" , function(event) {
        console.log('pass2');
        submit_form = false;
    });



    $(document)
    .off('keydown.yiiGridView change.yiiGridView', filter_selector)
    .on('keyup', filter_selector, function() {
            timer = 0;
            timerProcess = true;
            var thisElem = $(this);
            actionColunm = thisElem;

            submit_form = false;

            if (timerProcess) {
                var intervalThread = setInterval(function () {
                    if (timer > 3 && timerProcess) {

                        if (submit_form === false && timerProcess) {
                            submit_form = true;
                            setTimeout(function () {
                                $("#crud-datatable").yiiGridView("applyFilter");
                            }, 500);
                        }
                        timerProcess = false;
                        timer = 0;
                        clearInterval(intervalThread);
                    } else {
//                        console.log(timer > 3);
                        if (timer > 3) {
                            clearInterval(intervalThread);
                        }
                        timer++;

                    }
                }, 500);
            }
    })


</script>
 -->


<?php

use app\models\Person;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use hoaaah\ajaxcrud\CrudAsset;
use hoaaah\ajaxcrud\BulkButtonWidget;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

$query = new yii\db\Query();
$sql = new yii\db\Query();
?>


<?php
CrudAsset::register($this);


$person = Yii::$app->user->identity->person_id;
$result = $sql->select(['*'])->from('person')->where(['id' => $person])->all();
$institution = $result[0]['institution_id'];
$results_per_page = 10;
/* $user = $this->getUser();
echo $user */

?>


<link rel="stylesheet" type="text/css" href="/css/persona.css">
<?php Pjax::begin(); ?>


<?php $f = ActiveForm::begin([
    'options' => [
        'data-pjax' => true,
        'id' => 'formCrud'
    ],

    "method" => "get",
    "action" => Url::toRoute("person/index"),
    "enableClientValidation" => true

]); ?>

<div class="row w-100  m-0 p-0">
    <div class="col  col-md-6 col-12 d-flex align-items-center p-md-4 ps-4 pe-4 search_panel ">
        <span class="input-group-addon mb-5" id="basic-addon1"><svg fill="#051E34" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                <path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" />
        </svg></span>

   
        <?= $f->field($form, "q", ["inputOptions" => ['class' => "filter form-control  mb-4" , "placeholder" => "Buscar...."]])->input("search")->label(false) ?>

    </div>

    <div class="col col-md-6 col-12 order-first justify-content-end d-block d-md-flex p-4 order-md-last">
        <a class="mr-2 mb-2 mb-md-0"><button class="btn btn-pdf"><img src="/images/svg/pdf_icon.svg" alt=""></button> </a>
        <a class="mr-2 mb-2 mb-md-0"><button class="btn btn-excel "><img src="/images/svg/excel_icon.svg" alt=""></button> </a>
        <?=
        Html::a(
            '<img src="/images/svg/icons/sync-solid.svg"></img>',
            [''],
            ['data-pjax' => 1, 'class' => 'btn btn-reload mr-2 mb-2 mb-md-0', 'title' => 'Recargar']
        ),
        Html::a(
            '<svg width="18" fill="white" style="margin: 5px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M624 208h-64v-64c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v64h-64c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h64v64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-64h64c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>Agregar Persona',
            ['create', 'id' => $searchModel->institution_id],
            ['role' => 'modal-remote', 'title' => 'Crear una nueva Persona', 'class' => 'btn btn-success btn-add mb-2 mb-md-0']
        ) ?>

    </div>

</div>

<?php $f->end() ?>

<div class="institution-index pr-md-5 pl-md-5">


    <div id="ajaxCrudDatatable">

        <?= GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterUrl' => Url::to(['person/index']),
            'pjax' => true,
            'columns' => require(__DIR__ . '/_columns.php'),
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'hover' => true,
            'toolbar' => [
                [
                    'content' => '<div class="col justify-content-center d-flex m-auto">
                        <a href="person/excel"><button class="btn btn-pdf  mr-4"><img src="/images/svg/pdf_icon.svg" alt=""></button> </a>
                        <a href="person/excel"><button class="btn btn-excel "><img src="/images/svg/excel_icon.svg" alt=""></button> </a>
' .

                        Html::a(
                            '<img src="/images/svg/icons/sync-solid.svg"></img>',
                            [''],
                            ['data-pjax' => 1, 'class' => 'btn btn-reload ml-4 ', 'title' => 'Recargar']
                        ) .
                        '{toggleData}'   . Html::a(
                            '<svg width="18" fill="white" style="margin: 5px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M624 208h-64v-64c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v64h-64c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h64v64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-64h64c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>Agregar Persona',
                            ['create', 'id' => $searchModel->institution_id],
                            ['role' => 'modal-remote', 'title' => 'Crear una nueva Persona', 'class' => 'btn btn-success btn-add']
                        ) .  '</div>
'

                ],
            ],

            'panel' => [
                'type' => 'primary'
            ],

            'pager' => [
                'prevPageLabel' => '<div><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5303 18.5303C14.2374 18.8232 13.7626 18.8232 13.4697 18.5303L7.46967 12.5303C7.17678 12.2374 7.17678 11.7626 7.46967 11.4697L13.4697 5.46967C13.7626 5.17678 14.2374 5.17678 14.5303 5.46967C14.8232 5.76256 14.8232 6.23744 14.5303 6.53033L9.06066 12L14.5303 17.4697C14.8232 17.7626 14.8232 18.2374 14.5303 18.5303Z" fill="#030D45"/>
                </svg></div>
                ',
                'nextPageLabel' => '<div><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.46967 5.46967C9.76256 5.17678 10.2374 5.17678 10.5303 5.46967L16.5303 11.4697C16.8232 11.7626 16.8232 12.2374 16.5303 12.5303L10.5303 18.5303C10.2374 18.8232 9.76256 18.8232 9.46967 18.5303C9.17678 18.2374 9.17678 17.7626 9.46967 17.4697L14.9393 12L9.46967 6.53033C9.17678 6.23744 9.17678 5.76256 9.46967 5.46967Z" fill="#030D45"/>
                </svg></div>
                '
            ],
            'tableOptions' =>['style' => 'width: 1800px;'],
            'emptyText' => '<img src="/images/svg/not_found.svg"></img><br><br> No se encontraron resultados.',

        ])


        ?>

    </div>
    </form>



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
])
?>


<?php Modal::end(); ?>

<?php Pjax::end(); ?>