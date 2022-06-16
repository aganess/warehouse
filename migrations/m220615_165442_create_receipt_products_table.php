<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%receipt_products}}`.
 */
class m220615_165442_create_receipt_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%receipt_products}}', [
            'id' => $this->primaryKey(),
            'date' => $this->string()->notNull(),
            'from' => $this->string()->notNull(),
            'to' => $this->string()->notNull(),
            'documents' => $this->string()->defaultValue(null),
            'documents_comment' => $this->text()->defaultValue(null),
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
