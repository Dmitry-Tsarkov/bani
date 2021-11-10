<?php

use yii\db\Migration;

/**
 * Class m211110_145920_add_portfolio_show_hide_on_main
 */
class m211110_145920_add_portfolio_is_preview extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('portfolios', 'is_preview', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211110_145920_add_portfolio_show_hide_on_main cannot be reverted.\n";

        return false;
    }
}
