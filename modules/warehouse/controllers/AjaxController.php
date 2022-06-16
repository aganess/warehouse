<?php

namespace app\modules\warehouse\controllers;

use app\modules\warehouse\models\products\Products;
use yii\web\Controller;
use Yii;
class AjaxController extends Controller
{
    public function actionGetProducts()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'name' => '']];
        $q = Yii::$app->request->get('q');

        $products = Products::find()->where(['status' => 1])->andWhere(['like', 'title', $q . '%', false])->asArray()->all();

        foreach ($products as $key => $value) {
            $res[] = [
                'id' => $value['id'],
                'name' => $value['title']
            ];
        }

        $data = [];
        if (!empty($res)) {
            foreach ($res as $item) {
                $data[] = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                ];
            }
        }

        $out['results'] = $data;
        return $out;
    }

}