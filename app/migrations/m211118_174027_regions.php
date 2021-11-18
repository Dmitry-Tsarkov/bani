<?php

use yii\db\Migration;

/**
 * Class m211118_174027_regions
 */
class m211118_174027_regions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('regions', [
            'id' => $this->primaryKey(),
            'position' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'city' => $this->string()->notNull(),
            'region' => $this->string()->notNull(),
            'alias' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
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
        $this->dropTable('regions');
    }
}
