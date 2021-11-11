<?php

use yii\db\Migration;

/**
 * Class m211111_100719_add_review_is_preview
 */
class m211111_100719_add_review_is_preview extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('reviews', 'is_preview', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211111_100719_add_review_is_preview cannot be reverted.\n";

        return false;
    }
}
