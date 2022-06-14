<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m220614_201808_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'measurement_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string(64)->notNull(),
            'description' => $this->text()->defaultValue(null),
            'manufacturer' => $this->string()->defaultValue(null),
            'article' => $this->string()->defaultValue(null),
            'quantity' => $this->decimal('10,2')->defaultValue(null),
            'inventory_number' => $this->string()->defaultValue(null),
            'expiration_date' => $this->string()->defaultValue(null),
            'img'=> $this->string()->defaultValue(null),
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
        $this->dropTable('{{%products}}');
    }
}
