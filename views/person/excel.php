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
        header("Content-Disposition: attachment; filename=Personas.xls");
        $colums = ['Ruc','Razon Social','Nombre Comercial'];
        $data = $query->select(['*'])->from('person,clients')
                ->where('person.institution_id ='. $institution.' and person.id = clients.person_id order by address')
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
                
                    <td><?=$row['cedula'];?></td>
                        <td><?=$row['name'];?></td>
                        <td><?=$row['address'];?></td>
                       
                    </tr>
                    <?php endforeach ?>
            </tbody>
        </table>
</html>