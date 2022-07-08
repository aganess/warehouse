<?php

namespace app\modules\warehouse\models\products\search;

use app\config\components\Common;
use app\modules\warehouse\models\WarehouseEntities;
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
            [['id', 'action_type', 'status'], 'integer'],
            [['date', 'phone', 'entity_from', 'from', 'entity_to', 'to', 'documents', 'documents_comment', 'created_at', 'updated_at', 'who'], 'safe'],
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
     * @param $params
     * @param $action_type
     * @param $entity
     * @param bool $app_type
     * @return ActiveDataProvider
     */
    public function search($params, $action_type = null, $entity = null, bool $app_type = false): ActiveDataProvider
    {
        $query = ProductsActions::find()->with('productsData.extData');

        if ($app_type) {
            $query->andWhere(['action_type' => $action_type])->andWhere(['entity_to' => $entity]);
        } elseif ($entity) {
            $query->andWhere(['action_type' => $action_type])->andWhere(['entity_to' => $entity])->andWhere(['to' => $params['id']])->andWhere(['status' => 1]);
        } else {
            $query->where(['status' => 1])->andWhere(['!=', 'action_type', 5]);
        }

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
            'action_type' => $this->action_type,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'entity_from', $this->entity_from])
            ->andFilterWhere(['like', 'from', $this->from])
            ->andFilterWhere(['like', 'entity_to', $this->entity_to])
            ->andFilterWhere(['like', 'to', $this->to])
            ->andFilterWhere(['like', 'documents', $this->documents])
            ->andFilterWhere(['like', 'documents_comment', $this->documents_comment]);

        return $dataProvider;
    }

    /**
     * @param $id
     * @return ProductsActions[]|array
     */
    public function searchBySend($id): array
    {
        return ProductsActions::find()->where(['status' => 1])
            ->with('productsData.extData')
            ->andWhere(['action_type' => ProductsActions::RECEIPT_GOODS_WAREHOUSE])
            ->andWhere(['entity_from' => WarehouseEntities::getUserEvent()])
            ->andWhere(['from' => $id])
            ->all();
    }


    /**
     * @param $id
     * @return array
     */
    public function searchBySendАpp($id): array
    {
        return ProductsActions::find()->where(['status' => 1])
            ->with('productsData.extData')
            ->andWhere(['action_type' => 6])
            //->andWhere(['entity_to' => WarehouseEntities::getUserEvent()])
            ->andWhere(['to' => $id])
            ->all();
    }

    /**
     * @param $id
     * @return ProductsActions[]|array
     */
    public function searchBySendWarehouse($id): array
    {
        return ProductsActions::find()->where(['status' => 1])
            ->with('productsData.extData')
            ->andWhere(['action_type' => ProductsActions::TRANSFER_OBJECT_EMPLOYEE])
            ->andWhere(['entity_from' => WarehouseEntities::getWarehouseEvent()])
            ->andWhere(['from' => $id])
            ->all();
    }
}
