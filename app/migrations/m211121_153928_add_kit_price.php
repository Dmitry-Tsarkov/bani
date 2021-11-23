<?php

use yii\db\Migration;

/**
 * Class m211121_153928_add_kit_price
 */
class m211121_153928_add_kit_price extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('kit', 'price_type', $this->integer()->notNull());
        $this->addColumn('kit', 'price', $this->decimal()->notNull());
        $this->addColumn('kit', 'bottom_text', $this->text()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211121_153928_add_kit_price cannot be reverted.\n";

        return false;
    }
}
