<?php

namespace app\modules\warehouse\models\services;

use Yii;
use app\config\components\Common;
use app\modules\warehouse\models\products\ProductsActions;
use app\modules\warehouse\models\products\ProductsActionsData;
use app\modules\warehouse\models\products\ProductsExtender;
use app\modules\warehouse\models\WarehouseEntities;
use yii\db\Exception;
use yii\db\Query;

class ActionsService
{
    public $data;

    /** @var ProductsActions $action */
    public $action;

    public $flag;

    /**
     * @var array
     */
    public $type;
    public $action_ids;


    /**
     * @param $data
     * @param bool $updateFlag
     * @param $action_id
     * @param $type
     */
    public function __construct($data, bool $updateFlag = false, $action_id = null, $type = null)
    {
        $this->data = $data;
        $this->flag = $updateFlag;
        $this->action_ids = $action_id;

        $this->action = new ProductsActions();

        if ($type) {
            $this->type = $type;
        }
        if ($updateFlag) {
            $this->action = ProductsActions::findOne(['id' => $action_id]);
        }
    }


    /**
     * @return void
     * @throws Exception
     */
    public function createTypeOne()
    {
        $this->action->date = $this->data['date'];
        $this->action->action_type = !empty($this->type) ? (string)$this->type : (string)$this->data['type'];
        $this->action->to = $this->data['to'];
        $this->action->entity_to = WarehouseEntities::getWarehouseEvent();
        $this->action->from = $this->data['from'];
        $this->action->entity_from = WarehouseEntities::getUserEvent();
        $this->action->phone = $this->data['phone'];

        $this->action->documents_comment = $this->data['documents_comment'];

        if ($this->action->save()) {
            if ($this->flag) {
                $this->updateExtenderProducts($this->action->id);
            } else {
                $this->saveExtenderProducts($this->action->id);
            }
        }
    }


    /**
     * @return void
     * @throws Exception
     */
    public function createTypeTwo()
    {
        $this->action->date = $this->data['date'];
        $this->action->action_type = !empty($this->type) ? (string)$this->type : (string)$this->data['type'];
        $this->action->to = null;
        $this->action->entity_to = null;
        $this->action->from = $this->data['from'];
        $this->action->entity_from = WarehouseEntities::getUserEvent();
        $this->action->phone = $this->data['phone'];
        $this->action->documents_comment = $this->data['documents_comment'];

        if ($this->action->save()) {
            if ($this->flag) {
                $this->updateExtenderProducts($this->action->id);
            } else {
                $this->saveExtenderProducts($this->action->id);
            }
        }
    }


    /**
     * @return void
     * @throws Exception
     */
    public function createTypeThree()
    {
        $checkType = $this->action->getUserIdByUsername($this->data['from']);

        $this->action->date = $this->data['date'];
        $this->action->action_type = !empty($this->type) ? (string)$this->type : (string)$this->data['type'];
        $this->action->to = (string)$this->data['to'];
        $this->action->entity_to = WarehouseEntities::getWarehouseEvent();
        $this->action->from = empty($checkType) ? (string)$this->data['from'] : (string)$checkType;
        $this->action->entity_from = empty($checkType) ? WarehouseEntities::getProviderEvent() : WarehouseEntities::getUserEvent();
        $this->action->documents_comment = $this->data['documents_comment'];

        if ($this->action->save()) {
            if ($this->flag) {
                $this->updateExtenderProducts($this->action->id);
            } else {
                $this->saveExtenderProducts($this->action->id);
            }
        }
    }


    /**
     * @return void
     * @throws Exception
     */
    public function createFour()
    {
        $checkType = $this->action->getUserIdByUsername($this->data['to']);

        $this->action->action_type = !empty($this->type) ? (string)$this->type : (string)$this->data['type'];
        $this->action->date = $this->data['date'];
        $this->action->from = $this->data['from'];
        $this->action->entity_from = WarehouseEntities::getWarehouseEvent();
        $this->action->to = empty($checkType) ? (string)$this->data['to'] : (string)$checkType;
        $this->action->entity_to = empty($checkType) ? WarehouseEntities::getObjectEvent() : WarehouseEntities::getUserEvent();
        $this->action->documents_comment = $this->data['documents_comment'];

        if ($this->action->save()) {
            if ($this->flag) {
                $this->updateExtenderProducts($this->action->id);
            } else {
                $this->saveExtenderProducts($this->action->id);
            }
        }
    }

    /**
     * @return void
     * @throws Exception
     */
    public function createFive()
    {
        $this->action->action_type = !empty($this->type) ? (string)$this->type : (string)$this->data['type'];
        $checkType = $this->action->getUserIdByUsername($this->data['from']);

        $this->action->date = $this->data['date'];
        $this->action->from = $this->data['from'];
        $this->action->phone = $this->data['phone'];
        $this->action->address = $this->data['address'];
        $this->action->how_send = $this->data['how_send'];
        $this->action->entity_from = empty($checkType) ? WarehouseEntities::getWarehouseEvent() : WarehouseEntities::getUserEvent();;
        $this->action->from = $this->data['from'];
        $this->action->status = $this->flag ? 1 : 0;
        $this->action->entity_to = WarehouseEntities::getUserEvent();
        $this->action->to = $this->data['to'];
        $this->action->documents_comment = $this->data['documents_comment'];

        if ($this->action->save()) {
            if ($this->flag) {
                $this->updateExtenderProducts($this->action->id);
            } else {
                $this->saveExtenderProducts($this->action->id);
            }
        }
    }

    /**
     * @return void
     */
    public function createFiveForUpdate()
    {
        $this->action->action_type = 6;
        $checkType = $this->action->getUserIdByUsername($this->data['from']);

        $this->action->date = $this->data['date'];
        $this->action->parent_task = $this->action_ids;
        $this->action->phone = $this->data['phone'];
        $this->action->address = $this->data['address'];
        $this->action->how_send = $this->data['how_send'];
        $this->action->entity_from = empty($checkType) ? WarehouseEntities::getWarehouseEvent() : WarehouseEntities::getUserEvent();
        $this->action->from = $this->data['from'];
        $this->action->status = 1;
        $this->action->entity_to = WarehouseEntities::getUserEvent();
        $this->action->to = $this->data['to'];
        $this->action->documents_comment = $this->data['documents_comment'];

        if ($this->action->save()) {
            $this->saveExtenderProducts($this->action->id, true);
        }
    }

    /**
     * @param $action_id
     * @param bool $type_flag
     * @return void
     */
    protected function saveExtenderProducts($action_id, bool $type_flag = false)
    {
        if (!empty($this->data['products'])) {

            foreach ($this->data['products'] as $product) {
                $actions_data = new  ProductsActionsData();
                $actions_data->product_id = $product['product_id'];
                $actions_data->actions_id = $action_id;
                $actions_data->quantity = $product['quantity'];
                $actions_data->measurement = $product['measurement'];
                $actions_data->actions_type = $type_flag ? '6' : (string)$this->type;

                if ($actions_data->save()) {
                    unset($product['product_id']);
                    unset($product['quantity']);
                    unset($product['measurement']);

                    foreach ($product as $key => $value) {
                        $product_extender = new ProductsExtender();

                        $product_extender->key = Yii::$app->getter->getModificationIdBySlug($key);
                        $product_extender->product_action_data_id = $actions_data->id;
                        $product_extender->value = $value;


                        if ($product_extender->save()) {
                            Yii::$app->controller->redirect(['/warehouse/products-actions/index'], 302);
                        } else {
                            Common::debug($product_extender->getErrors());
                        }
                    }

                } else {
                    Common::debug($actions_data->getErrors());
                }
            }
        }
    }

    /**
     * @param $action_id
     * @return void
     * @throws Exception
     */
    protected function updateExtenderProducts($action_id)
    {
        $actions_data = ProductsActionsData::find()->where(['actions_id' => $action_id])->all();

        if (!empty($actions_data)) {
            foreach ($actions_data as $acd_Value) {
                (new Query())
                    ->createCommand()
                    ->delete('products_actions_data', ['id' => $acd_Value->id])->execute();

                (new Query())
                    ->createCommand()
                    ->delete('products_extender', ['product_action_data_id' => $acd_Value->id])->execute();
            }

            $this->saveExtenderProducts($action_id);
        }
    }

}