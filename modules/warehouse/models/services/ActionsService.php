<?php

namespace app\modules\warehouse\models\services;

use app\config\components\Common;
use app\modules\warehouse\models\products\ProductsActions;
use app\modules\warehouse\models\WarehouseEntities;

class ActionsService
{
    public $data;

    /** @var ProductsActions $action */
    public $action;
    /**
     * @var array
     */


    /**
     * @param $data
     * @param bool $updateFlag
     * @param $action_id
     */
    public function __construct($data, bool $updateFlag = false, $action_id = null)
    {
        $this->data = $data;
        $this->action = new ProductsActions();

        if ($updateFlag) {
            $this->action = ProductsActions::findOne(['id' => $action_id]);
        }
    }

    /**
     * @return array
     */
    public function createTypeOne(): array
    {
        $this->action->date = $this->data['date'];
        $this->action->action_type = $this->data['type'];
        $this->action->to = $this->data['to'];
        $this->action->entity_to = WarehouseEntities::getUserEvent();
        $this->action->from = $this->data['from'];
        $this->action->entity_from = WarehouseEntities::getWarehouseEvent();;
        $this->action->phone = $this->data['phone'];

        $this->action->documents_comment = $this->data['documents_comment'];

        if ($this->action->save()) {
            return [
                'createdId' => $this->action->id
            ];
        } else {
            return [
                'createdErrors' => $this->action->getErrors()
            ];
        }
    }

    /**
     * @return array
     */
    public function createTypeTwo(): array
    {
        $this->action->date = $this->data['date'];
        $this->action->action_type = $this->data['type'];
        $this->action->to = $this->data['to'];
        $this->action->entity_to = WarehouseEntities::getUserEvent();
        $this->action->from = null;
        $this->action->entity_from = null;
        $this->action->phone = $this->data['phone'];
        $this->action->documents_comment = $this->data['documents_comment'];

        if ($this->action->save()) {
            return [
                'createdId' => $this->action->id
            ];
        } else {
            return [
                'createdErrors' => $this->action->getErrors()
            ];
        }
    }

    /**
     * @return array
     */
    public function createTypeThree(): array
    {
        $checkType = $this->action->getUserIdByUsername($this->data['to']);

        $this->action->date = $this->data['date'];
        $this->action->action_type = $this->data['type'];
        $this->action->to = empty($checkType) ? (string)$this->data['to'] : (string)$checkType;
        $this->action->entity_to = empty($checkType) ? WarehouseEntities::getProviderEvent() : WarehouseEntities::getUserEvent();
        $this->action->from = $this->data['from'];
        $this->action->entity_from = WarehouseEntities::getWarehouseEvent();
        $this->action->documents_comment = $this->data['documents_comment'];

        if ($this->action->save()) {
            return [
                'createdId' => $this->action->id
            ];
        } else {
            return [
                'createdErrors' => $this->action->getErrors()
            ];
        }
    }

    /**
     * @return array
     */
    public function createFour(): array
    {
        $checkType = $this->action->getUserIdByUsername($this->data['from']);

        $this->action->action_type = $this->data['type'];
        $this->action->date = $this->data['date'];
        $this->action->to = $this->data['to'];
        $this->action->entity_to = WarehouseEntities::getWarehouseEvent();
        $this->action->from = empty($checkType) ? (string)$this->data['from'] : (string)$checkType;
        $this->action->entity_from = empty($checkType) ? WarehouseEntities::getObjectEvent() : WarehouseEntities::getUserEvent();
        $this->action->documents_comment = $this->data['documents_comment'];

        if ($this->action->save()) {
            return [
                'createdId' => $this->action->id
            ];
        } else {
            return [
                'createdErrors' => $this->action->getErrors()
            ];
        }
    }

}