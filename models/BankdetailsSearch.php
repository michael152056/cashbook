<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BankDetails;
use yii\db\Query;

/**
 * BankdetailsSearch represents the model behind the search form of `app\models\BankDetails`.
 */
class BankdetailsSearch extends BankDetails
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'number_account', 'chart_account_id', 'bank_type_id'], 'integer'],
            [['city_id'], 'safe'],
            [['status'], 'boolean'],
            [['name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $sql = new Query;
        $person = Yii::$app->user->identity->person_id;
        $result = $sql->select(['*'])->from('person')->where(['id' => $person])->all();
        $institution = $result[0]['institution_id'];
        $query = BankDetails::find()->innerJoin("chart_accounts","chart_accounts.id=bank_details.chart_account_id")->where(["institution_id"=>$institution]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
            'number_account' => $this->number_account,
            'chart_account_id' => $this->chart_account_id,
            'status' => $this->status,
            'bank_type_id' => $this->bank_type_id,
        ]);

        $query->andFilterWhere(['ilike', 'city_id', $this->city_id]);

        return $dataProvider;
    }
}
