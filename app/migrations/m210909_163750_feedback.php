<?php

use yii\db\Migration;

/**
 * Class m210909_163750_feedback
 */
class m210909_163750_feedback extends Migration
{
    public function safeUp()
    {
        $this->createTable('feedbacks', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'name' => $this->string()->defaultValue(null),
            'phone' => $this->string()->defaultValue(null),
            'referer' => $this->string()->defaultValue(null),
            'type' => $this->string()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('feedbacks');
    }
}
