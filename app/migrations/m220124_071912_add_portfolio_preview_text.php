<?php

use yii\db\Migration;

/**
 * Class m220124_071912_add_portfolio_preview_text
 */
class m220124_071912_add_portfolio_preview_text extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('portfolios', 'preview_text', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('portfolios', 'preview_text');
    }
}
