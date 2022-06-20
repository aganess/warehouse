<?php

use yii\db\Migration;

/**
 * Class m220618_162201_update_product_modifications
 */
class m220618_162201_update_product_modifications extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_modifications','slug', $this->string()->after('title')->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product_modifications','slug');
    }

}
