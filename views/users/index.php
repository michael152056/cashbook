<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\bootstrap4\Modal;
    use kartik\grid\GridView;
    use hoaaah\ajaxcrud\CrudAsset; 
    use hoaaah\ajaxcrud\BulkButtonWidget;
    $query = new yii\db\Query();
    $sql = new yii\db\Query();
    $this->title = 'Usuarios';
    CrudAsset::register($this);
    use yii\widgets\LinkPager;
    $person = Yii::$app->user->identity->person_id;
    $result = $sql->select(['*'])->from('person')->where(['id' => $person])->all();
    $institution = $result[0]['institution_id'];
?>
<div class="institution-index">
    <div id="ajaxCrudDatatable">
        <?= Html::a('Nuevo Usuario', ['create'],
            ['role'=>'modal-remote','title'=> 'Crear nuevo Usuario','class'=>'btn btn-primary btn-lg'])?>
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
            $colums = ['Permisos','Usuario','Email','Persona', 'Acciones'];
            if(isset($_GET["filtro"])){
                $filtro = $_GET["filtro"];
                $data = $query->select(['*'])->from('users')
                ->where(['person.institution_id' => $institution])
                ->andwhere(['like', 'username', $filtro.'%', false])
                ->orWhere(['like', 'email', $filtro.'%', false])
                ->all();
            }else{
                $data = $query->select(['users.id AS usuario', 'users.username', 'users.email', 'users.person_id', 'person.id', 'person.institution_id','person.name'])->from('users, person')
                ->where(['person.institution_id' => $institution])
                ->andwhere('users.person_id = person.id')
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
                        <td> <a href="/permissionusuario?id=<?php echo $row['usuario']?>"> Permisos</a></td>
                        <td><?=$row['username'];?></td>
                        <td><?=$row['email'];?></td>
                        <td><?=$row['name'];?></td>
                        <td>
                            <?= Html::a('1', ['view?id='.$row['usuario']], ['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'])?>
                            <?= Html::a('2', ['update?id='.$row['usuario']], ['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'])?>
                            <?= Html::a('3', ['delete?id='.$row['usuario']], ['role'=>'modal-remote','title'=>'Delete', 
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