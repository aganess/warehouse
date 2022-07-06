<?php

use yii\db\Migration;

/**
 * Class m220705_190556_update_product_actions
 */
class m220705_190556_update_product_actions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products_actions', 'how_send', $this->string()->null()->after('to'));
        $this->addColumn('products_actions', 'address', $this->string()->null()->after('to'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products_actions', 'how_send');
        $this->dropColumn('products_actions', 'address');
    }
}
