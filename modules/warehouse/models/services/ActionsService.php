<?php

namespace app\modules\warehouse\models\services;

use app\config\components\Common;
use app\modules\warehouse\models\products\ProductsActions;

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
    public function createTypeOneAnsTwo(): array
    {
        $this->action->date = $this->data['date'];
        $this->action->who = $this->data['who'];
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
        $this->action->date = $this->data['date'];
        $this->action->from = $this->data['from'];
        $this->action->who = $this->data['to'];
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
        $this->action->date = $this->data['date'];
        $this->action->object_id = $this->data['object_id'];
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