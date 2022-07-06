<?php

use yii\db\Migration;

/**
 * Class m220706_164756_update_products_actions_data
 */
class m220706_164756_update_products_actions_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products_actions', 'parent_task', $this->integer()->null()->after('action_type'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products_actions', 'parent_task');
    }

}
