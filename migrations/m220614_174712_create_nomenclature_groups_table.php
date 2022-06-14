<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%nomenclature_groups}}`.
 */
class m220614_174712_create_nomenclature_groups_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%nomenclature_groups}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull(),
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
        $this->dropTable('{{%nomenclature_groups}}');
    }
}
