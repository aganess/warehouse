<?php

namespace app\config\components\grid;

use yii\helpers\Html;

use yii\base\Component;

/**
 *
 * @property-read array $img
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

    /**
     * @param $form
     * @param $model
     * @return mixed
     */
    public function setImg($form, $model)
    {
        return $form->field($model, 'file')->widget(\kartik\file\FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
                'id' => 'file-input'
            ],
            'pluginOptions' => [
                'initialPreview' => !empty($model->getImageThumbs()) ? $model->getImageThumbs() : '',
                'initialPreviewAsData' => true,
                'allowedFileExtensions' => ['jpg', 'jpeg', 'png', 'svg'],
                'showCaption' => true,
                'showRemove' => false,
                'showUpload' => false,
            ],

        ]);
    }

    /**
     * @return array
     */
    public function getImg(): array
    {
        return [
            'attribute' => 'img',
            'value' => function ($model) {
                return Html::img($model->getImageThumbs());
            },
            'format' => 'raw'
        ];
    }

}