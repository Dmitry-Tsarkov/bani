<?php

use yii\db\Migration;

/**
 * Class m211017_083125_portfolios
 */
class m211017_083125_portfolios extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('portfolios', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'alias' => $this->string()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'image' => $this->string(255)->defaultValue(null),
            'image_hash' => $this->string(255)->defaultValue(null),
            'description' => $this->text()->defaultValue(null),
            'meta_t' => $this->string()->defaultValue(null),
            'meta_d' => $this->string()->defaultValue(null),
            'meta_k' => $this->string()->defaultValue(null),
            'h1' => $this->string()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('portfolios');
    }

}
