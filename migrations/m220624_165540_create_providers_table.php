<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%providers}}`.
 */
class m220624_165540_create_providers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%providers}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),

            'status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $this->insert('providers', [
                'title' => 'Provider' . $i,
                'slug' => 'slug-provider-' . $i,
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%providers}}');
    }
}
