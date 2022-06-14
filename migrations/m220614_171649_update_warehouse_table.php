<?php

use yii\db\Migration;

/**
 * Class m220614_171649_update_warehouse_table
 */
class m220614_171649_update_warehouse_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('warehouses','slug', $this->string(64)->after('title'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('warehouse','slug');
    }

}
