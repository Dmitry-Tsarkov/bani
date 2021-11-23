<?php

use yii\db\Migration;

/**
 * Class m211123_083751_change_regions
 */
class m211123_083751_change_regions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('regions', 'parent_id', $this->integer()->defaultValue(null));
        $this->addColumn('regions', 'lft', $this->integer()->defaultValue(null));
        $this->addColumn('regions', 'rgt', $this->integer()->notNull());
        $this->addColumn('regions', 'depth', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211123_083751_change_regions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211123_083751_change_regions cannot be reverted.\n";

        return false;
    }
    */
}
