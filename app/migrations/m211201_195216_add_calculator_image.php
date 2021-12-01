<?php

use yii\db\Migration;

/**
 * Class m211201_195216_add_calculator_image
 */
class m211201_195216_add_calculator_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('calculators', 'image', $this->string(255)->defaultValue(null));
        $this->addColumn('calculators', 'image_hash', $this->string(255)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211201_195216_add_calculator_image cannot be reverted.\n";

        return false;
    }
}
