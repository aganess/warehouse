<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%measurement}}`.
 */
class m220614_203149_create_measurement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%measurement}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
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
        $this->dropTable('{{%measurement}}');
    }
}
