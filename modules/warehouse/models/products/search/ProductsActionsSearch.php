<?php

namespace app\modules\warehouse\models\products\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\warehouse\models\products\ProductsActions;

/**
 * ProductsActionsSearch represents the model behind the search form of `app\modules\warehouse\models\products\ProductsActions`.
 */
class ProductsActionsSearch extends ProductsActions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'object_id', 'status'], 'integer'],
            [['date', 'who', 'phone', 'from', 'to', 'documents', 'documents_comment', 'created_at', 'updated_at'], 'safe'],
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
        $query = ProductsActions::find();

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
            'object_id' => $this->object_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'who', $this->who])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'from', $this->from])
            ->andFilterWhere(['like', 'to', $this->to])
            ->andFilterWhere(['like', 'documents', $this->documents])
            ->andFilterWhere(['like', 'documents_comment', $this->documents_comment]);

        return $dataProvider;
    }
}
