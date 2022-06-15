<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_modifications}}`.
 */
class m220615_085307_create_product_modifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_modifications}}', [
            'id' => $this->primaryKey(),
            'title'=> $this->string()->notNull(),
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
        $this->dropTable('{{%product_modifications}}');
    }
}
