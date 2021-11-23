<?php

use yii\db\Migration;

/**
 * Class m211122_103725_change_regions
 */
class m211122_103725_change_regions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('regions', 'alias');
        $this->addColumn('regions', 'city_alias', $this->string()->notNull()->comment('Алиас города'));
        $this->addColumn('regions', 'region_alias', $this->string()->notNull()->comment('Алиас региона'));
        $this->alterColumn('regions', 'description', $this->text()->notNull()->comment('Контент страницы'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211122_103725_change_regions cannot be reverted.\n";

        return false;
    }
}
