<?php

use yii\db\Migration;

/**
 * Class m211128_154624_change_service_price
 */
class m211128_154624_change_service_price extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('services', 'price', $this->decimal()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211128_154624_change_service_price cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211128_154624_change_service_price cannot be reverted.\n";

        return false;
    }
    */
}
