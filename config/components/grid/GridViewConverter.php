<?php

namespace app\config\components\grid;

use yii\base\Component;

/**
 *
 * @property-read array $status
 */
class GridViewConverter extends Component
{
    /**
     * @return array
     */
    public function getStatus(): array
    {

        return [
            'attribute' => 'status',
            'value' => function ($model) {
                if ($model['status'] === 1) {
                    return '<span style="color:green">Активен</span>';
                }
                return '<span style="color:red">Не активен</span>';
            },
            'format' => 'raw'
        ];
    }

    /**
     * @param $form
     * @param $model
     * @return mixed
     */
    public function setStatus($form, $model)
    {
        return $form->field($model, 'status')->dropDownList([1 => 'Активен', 0 => 'Не активен']);
    }
}