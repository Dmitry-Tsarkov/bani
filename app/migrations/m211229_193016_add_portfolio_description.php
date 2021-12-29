<?php

use yii\db\Migration;

/**
 * Class m211229_193016_add_product_price
 */
class m211229_193016_add_portfolio_description extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->getDb()->createCommand(
            "INSERT INTO `setting` (`id`, `type`, `value`, `title`, `hash`, `description`, `hint`, `position`) VALUES
                ('portfolio_description', 'text', '', 'Текст портфолио', NULL, '', '', 24);"
        )->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211229_193016_add_portfolio_description cannot be reverted.\n";

        return false;
    }
}
