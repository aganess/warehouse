<?php

use yii\db\Migration;

/**
 * Class m220624_170602_update_products_actions_data
 */
class m220624_170602_update_products_actions_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->truncateTable('products_actions_data');

        $this->dropColumn('products_actions', 'who');
        $this->dropColumn('products_actions', 'object_id');
        $this->dropColumn('products_actions', 'from');
        $this->dropColumn('products_actions', 'to');

        $this->addColumn('products_actions','action_type', $this->smallInteger()->after('phone')->null());
        $this->addColumn('products_actions','entity_from', $this->string()->after('action_type')->null());
        $this->addColumn('products_actions','from', $this->string()->after('entity_from')->null());
        $this->addColumn('products_actions','entity_to', $this->string()->after('from')->null());
        $this->addColumn('products_actions','to', $this->string()->after('entity_to')->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('products_actions', 'who', $this->string()->null());
        $this->addColumn('products_actions', 'from', $this->string()->null());
        $this->addColumn('products_actions', 'to', $this->string()->null());

        $this->dropColumn('products_actions','action_type');
        $this->dropColumn('products_actions','entity_from');
        $this->dropColumn('products_actions','from');
        $this->dropColumn('products_actions','from');
        $this->dropColumn('products_actions','to');
    }

}
