<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%warehouse_entities}}`.
 */
class m220624_172430_create_warehouse_entities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%warehouse_entities}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->null(),
            'slug' => $this->string()->null(),

            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        $arrays = [
            1 => 'users',
            2 => 'objects',
            3 => 'providers',
            4 => 'warehouses',
        ];

        for ($i = 1; $i <= count($arrays); $i++) {
            $this->insert('warehouse_entities', [
                'title' => $arrays[$i],
                'slug' => 'entities-' . $arrays[$i],
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%warehouse_entities}}');
    }
}
