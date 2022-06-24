<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%objects}}`.
 */
class m220624_165529_create_objects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%objects}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),

            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $this->insert('objects', [
                'title' => 'Object' . $i,
                'slug' => 'slug-object-' . $i,
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%objects}}');
    }
}
