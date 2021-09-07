<?php

use yii\db\Migration;

/**
 * Class m210906_205823_slider
 */
class m210906_205823_slider extends Migration
{
    public function safeUp()
    {
        $this->createTable('slides', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'image' => $this->string()->defaultValue(null),
            'image_hash' => $this->string()->defaultValue(null),
            'status' => $this->boolean()->defaultValue(false),
            'position' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('slides');
    }
}
