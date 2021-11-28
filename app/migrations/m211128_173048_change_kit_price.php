<?php

use yii\db\Migration;

/**
 * Class m211128_173048_change_kit_price
 */
class m211128_173048_change_kit_price extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('kit', 'price', $this->decimal()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211128_173048_change_kit_price cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211128_173048_change_kit_price cannot be reverted.\n";

        return false;
    }
    */
}
