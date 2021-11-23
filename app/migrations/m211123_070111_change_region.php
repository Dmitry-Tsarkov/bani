<?php

use yii\db\Migration;

/**
 * Class m211123_070111_change_region
 */
class m211123_070111_change_region extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('regions', 'region');
        $this->dropColumn('regions', 'region_alias');
        $this->addColumn('regions', 'district', $this->string()->notNull());
        $this->addColumn('regions', 'district_alias', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211123_070111_change_region cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211123_070111_change_region cannot be reverted.\n";

        return false;
    }
    */
}
