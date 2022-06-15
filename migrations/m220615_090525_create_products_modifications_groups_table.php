<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products_modifications_groups}}`.
 */
class m220615_090525_create_products_modifications_groups_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products_modifications_groups}}', [
            'id' => $this->primaryKey(),
            'modification_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull(),
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
        $this->dropTable('{{%products_modifications_groups}}');
    }
}
