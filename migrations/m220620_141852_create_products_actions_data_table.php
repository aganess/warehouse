<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products_actions_data}}`.
 */
class m220620_141852_create_products_actions_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products_actions_data}}', [
            'id' => $this->primaryKey(),
            'actions_id' => $this->integer()->notNull(),
            'actions_type' => $this->string()->notNull(),
            'data' => $this->text()->notNull(),

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
        $this->dropTable('{{%products_actions_data}}');
    }
}
