<?php

use yii\db\Migration;

/**
 * Class m211128_162515_change_service_description
 */
class m211128_162515_change_service_category_description extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('services', 'description', $this->text()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211128_162515_change_service_description cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211128_162515_change_service_description cannot be reverted.\n";

        return false;
    }
    */
}
