<?php

namespace app\config\components\grid;

use app\config\components\Common;
use app\modules\warehouse\models\products\ProductModifications;
use app\modules\warehouse\models\products\ProductsActionsData;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\Component;
use kartik\select2\Select2;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

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


    /**
     * @param $form
     * @param $model
     * @return array[]
     */
    public function setDynamicColumns($form, $model): array
    {
        $data = [
            [
                'name' => 'product_id',
                'type' => Select2::className(),
                'title' => 'Номеклатура',
                'options' => [
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 1,
                        'language' => 'ru',
                        'ajax' => [
                            'url' => \yii\helpers\Url::to(['/warehouse/ajax/get-products']),
                            'dataType' => 'json',
                            'data' => new \yii\web\JsExpression(
                                'function(params) { 
                                                        return {q:params.term} 
                                            }'
                            )
                        ],
                        'escapeMarkup' => new JsExpression(
                            'function (markup) {
                                                    console.log("escapeMarkup"); return markup; 
                                        }'
                        ),
                        'templateResult' => new JsExpression(
                            'function(data) {
                                                    console.log("templateResult"); 
                                                    console.log(data); return data.name;
                                         }'
                        ),
                        'templateSelection' => new JsExpression(
                            'function (data) {
                                                    console.log("templateSelection"); 
                                                    $("#discipline_text").val(data.name); 
                                                    console.log(data);
                                                    return data.name;
                                        }'
                        ),
                    ],
                ],
            ],
            [
                'name' => 'quantity',
                'title' => 'Количество',
                'defaultValue' => 1,
                'options' => [
                    'type' => 'number'
                ]
            ],
            [
                'name' => 'measurement',
                'title' => 'Единица измерения',
                'type' => 'dropDownList',
                'items' => $model->getAllMeasurement(),
                'options' => [
                    'type' => 'string'
                ]
            ],
        ];

        $modificationsData = ProductModifications::find()->where(['status' => 1])->all();
        $modData = [];

        foreach ($modificationsData as $key => $value) {
            $modData[] = [
                'name' => $value['slug'],
                'title' => $value['title'],
                'options' => [
                    'id' => $value['slug'],
                    'class' => 'mod-cls',
                    'data-id' => $value['id']
                ]
            ];
        }

        return array_merge($data, $modData);

    }

    /**
     * @param $action_id
     * @return array|void
     */
    public function getDynamicColumns($action_id)
    {
        $result = $this->getActionData($action_id);
        $data = [];

        if ($result) {
            foreach ($result as $value) {
                $data[] = $value;
            }
            return $data;
        }
    }

    /**
     * @param $action_id
     * @return mixed|null
     */
    protected function getActionData($action_id)
    {
        $product_action = ProductsActionsData::find()->where(['status' => 1])->andWhere(['actions_id' => $action_id])->one();

        return Json::decode($product_action->data);
    }
}