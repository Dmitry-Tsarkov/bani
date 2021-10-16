<?php

use yii\db\Migration;

/**
 * Class m211016_202126_reviews
 */
class m211016_202126_reviews extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reviews', [
            'id' => $this->primaryKey(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'name' => $this->string()->notNull()->comment('Имя и отчество'),
            'email' => $this->string()->notNull(),
            'city' => $this->string()->notNull(),
            'description' => $this->text()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('reveiws');
    }
}
