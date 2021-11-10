<?php

use yii\db\Migration;

/**
 * Class m211110_141251_add_feedbacks_description
 */
class m211110_141251_add_feedbacks_description extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('feedbacks', 'description', $this->text()->defaultValue(null));
        $this->addColumn('feedbacks', 'email', $this->text()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211110_141251_add_feedbacks_description cannot be reverted.\n";

        return false;
    }
}
