<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Dependent;

/**
 * DependentSearch represents the model behind the search form about `common\models\Dependent`.
 */
class DependentSearch extends Dependent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'member_id', 'relationship', 'status', 'created_at', 'updated_at'], 'integer'],
            [['f_name', 'l_name', 'm_name', 'dob', 'gender', 'ssn', 'address', 'address2', 'city', 'state', 'zip', 'email', 'phone'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Dependent::find();

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
            'member_id' => $this->member_id,
            'relationship' => $this->relationship,
            'dob' => $this->dob,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'f_name', $this->f_name])
            ->andFilterWhere(['like', 'l_name', $this->l_name])
            ->andFilterWhere(['like', 'm_name', $this->m_name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'ssn', $this->ssn])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
