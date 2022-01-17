<?php

use yii\db\Migration;

/**
 * Class m220117_164326_add_product_price_unit
 */
class m220117_164326_add_product_price_unit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'unit', $this->string()->notNull()->defaultValue('руб.'));
        $this->addColumn('categories', 'status', $this->boolean()->defaultValue(true));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('categories', 'status');
        $this->dropColumn('products', 'unit');
    }
}
