<?php

use yii\db\Migration;

/**
 * Class m220705_071622_update_warehouse_entities
 */
class m220705_071622_update_warehouse_entities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('warehouse_entities', [
            'title' => 'applications',
            'slug' => 'entities-applications'
        ]);
    }
}
