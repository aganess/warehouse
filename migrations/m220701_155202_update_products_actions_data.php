<?php

use yii\db\Migration;

/**
 * Class m220701_155202_update_products_actions_data
 */
class m220701_155202_update_products_actions_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('products_actions_data','data');

        $this->addColumn('products_actions_data','product_id', $this->integer()->after('actions_type'));
        $this->addColumn('products_actions_data','quantity', $this->integer()->after('product_id'));
        $this->addColumn('products_actions_data','measurement', $this->integer()->after('product_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('products_actions_data','data', $this->text());

        $this->dropColumn('products_actions_data','product_id');
        $this->dropColumn('products_actions_data','quantity');
        $this->dropColumn('products_actions_data','measurement');
    }


}
