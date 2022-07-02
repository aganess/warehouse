<?php

namespace app\config\components;

use app\modules\warehouse\models\products\ProductModifications;
use Yii;
use yii\base\Component;


class Getter extends Component
{
    /**
     * @param $slug
     * @return int|null
     */
    public function getModificationIdBySlug($slug): ?int
    {
        if ($slug) {
           return $this->getModificationById($slug);
        }

        return null;
    }

    /**
     * @param $slug
     * @return int
     */
    protected function getModificationById($slug): int
    {
        return ProductModifications::findOne(['slug' => $slug])->id;
    }
}