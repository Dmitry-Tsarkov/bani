<?php

use yii\db\Migration;

/**
 * Class m211128_144926_change_catgeory_description
 */
class m211128_144926_change_catgeory_description extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('categories', 'description', $this->text()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211128_144926_change_catgeory_description cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211128_144926_change_catgeory_description cannot be reverted.\n";

        return false;
    }
    */
}
