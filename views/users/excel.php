<html>
    <?php
        use yii\helpers\Url;
        use yii\helpers\Html;
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
        header("Content-Type: application/vnd.ms-excel;  charset=ISO-8859-1");
        header("Content-Disposition: attachment; filename=Usuarios.xls");
        $colums = ['Usuario','Email', 'Persona'];
      
            $data = $query->select(['users.id AS usuario', 'users.username', 'users.email', 'users.person_id', 'person.id', 'person.institution_id','person.name'])->from('users, person')
                ->where(['person.institution_id' => $institution])
                ->andwhere('users.person_id = person.id')
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
                
                        <td><?=$row['username'];?></td>
                        <td><?=$row['email'];?></td>
                        <td><?=$row['name'];?></td>
                       
                    </tr>
                    <?php endforeach ?>
            </tbody>
        </table>
</html>