<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%receipt_products}}`.
 */
class m220615_165442_create_products_actions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products_actions}}', [
            'id' => $this->primaryKey(),
            'date' => $this->string()->notNull(),
            'who' => $this->string()->null(),
            'phone' => $this->string()->null(),
            'from' => $this->string()->null(),
            'to' => $this->string()->null(),
            'object_id' =>  $this->integer()->null(),
            'documents' => $this->string()->null(),
            'documents_comment' => $this->text()->null(),

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
        $this->dropTable('{{%receipt_products}}');
    }
}
