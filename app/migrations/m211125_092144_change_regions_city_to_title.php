<?php

use yii\db\Migration;

/**
 * Class m211125_092144_change_regions_city_to_title
 */
class m211125_092144_change_regions_city_to_title extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('regions', 'city');
        $this->dropColumn('regions', 'city_alias');
        $this->addColumn('regions', 'title', $this->string()->notNull()->comment('Город'));
        $this->addColumn('regions', 'title_alias', $this->string()->notNull()->comment('Алиас города'));
        $this->alterColumn('regions', 'district', $this->string()->defaultValue(null));
        $this->alterColumn('regions', 'district_alias', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211125_092144_change_regions_city_to_title cannot be reverted.\n";

        return false;
    }
}
