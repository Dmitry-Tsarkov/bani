<?php

use yii\db\Migration;

/**
 * Class m210218_144615_categories
 */
class m210218_144615_categories extends Migration
{
    public function safeUp()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
            'image' => $this->string(255)->defaultValue(null),
            'image_hash' => $this->string(255)->defaultValue(null),
            'meta_t' => $this->string()->defaultValue(null),
            'meta_d' => $this->string()->defaultValue(null),
            'meta_k' => $this->string()->defaultValue(null),
            'h1' => $this->string()->defaultValue(null),
        ]);

        $this->insert('categories',
            [
                'created_at' => time(),
                'updated_at' => time(),
                'title' => 'Без категории',
                'alias' => '',
                'lft' => 1,
                'rgt' => 2,
                'depth' => 0,
            ]);

    }

    public function safeDown()
    {
        $this->dropTable('categories');
    }
}
