<?php

use yii\db\Migration;

/**
 * Class m211111_102958_faq
 */
class m211111_102958_faq extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('faq', [
            'id' => $this->primaryKey(),
            'question' => $this->string()->notNull(),
            'answer' => $this->text(),
            'position' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('faq_question');
    }
}
