<?php

use yii\db\Migration;

/**
 * Class m211011_163347_actions
 */
class m211011_163347_actions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('actions', [
            'id' => $this->primaryKey(),
            'position' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'active_from' => $this->integer()->defaultValue(null),
            'active_to' => $this->integer()->defaultValue(null),
            'image' => $this->string()->defaultValue(null),
            'image_hash' => $this->string()->defaultValue(null),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->defaultValue(null),
            'preview_title' => $this->string()->defaultValue(null),
            'preview_description' => $this->string()->defaultValue(null),
            'alias' => $this->string()->defaultValue(null),
            'activity_period' => $this->string()->defaultValue(null),
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
        $this->dropTable('actions');
    }

}
