<?php

use yii\db\Migration;

/**
 * Class m211229_134413_add_category_bottom_description
 */
class m211229_134413_add_category_bottom_description extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('categories', 'bottom_description', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('categories', 'bottom_description');
    }

}
