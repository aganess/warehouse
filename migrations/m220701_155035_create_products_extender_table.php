<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products_extender}}`.
 */
class m220701_155035_create_products_extender_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products_extender}}', [
            'id' => $this->primaryKey(),
            'product_action_data_id' => $this->integer(),
            'key' => $this->integer(),
            'value' => $this->integer(),

            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products_extender}}');
    }
}
