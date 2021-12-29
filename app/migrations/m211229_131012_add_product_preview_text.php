<?php

use yii\db\Migration;

/**
 * Class m211229_131012_add_product_preview_text
 */
class m211229_131012_add_product_preview_text extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'preview_description', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products', 'preview_description');
    }
}
