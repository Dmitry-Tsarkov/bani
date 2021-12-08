<?php

use yii\db\Migration;

/**
 * Class m211208_191109_change_prices
 */
class m211208_191109_change_prices extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('products', 'price', $this->decimal(11, 2)->unsigned()->defaultValue(null));
        $this->alterColumn('services', 'price', $this->decimal(11, 2)->unsigned()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('services', 'price', $this->decimal()->notNull());
        $this->alterColumn('products', 'price', $this->decimal()->notNull());
    }
}
