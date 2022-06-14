<?php

namespace app\modules\warehouse\models\products\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\warehouse\models\products\Products;

/**
 * ProductsSearch represents the model behind the search form of `app\modules\warehouse\models\products\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'measurement_id', 'status'], 'integer'],
            [['title', 'slug', 'description', 'manufacturer', 'article', 'inventory_number', 'expiration_date', 'img', 'created_at', 'updated_at'], 'safe'],
            [['quantity'], 'number'],
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
        $query = Products::find();

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
            'group_id' => $this->group_id,
            'measurement_id' => $this->measurement_id,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'manufacturer', $this->manufacturer])
            ->andFilterWhere(['like', 'article', $this->article])
            ->andFilterWhere(['like', 'inventory_number', $this->inventory_number])
            ->andFilterWhere(['like', 'expiration_date', $this->expiration_date])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
