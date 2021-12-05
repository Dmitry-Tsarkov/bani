<?php

use yii\db\Migration;

/**
 * Class m211205_184012_add_setting_calculators_description
 */
class m211205_184012_add_setting_calculators_description extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->getDb()->createCommand(
            "INSERT INTO `setting` (`id`, `type`, `value`, `title`, `hash`, `description`, `hint`, `position`) VALUES           
                ('calculator_description', 'text', 'Описание под калькуляторами', 'Описание под калькуляторами', NULL, '', '', 24);"
        )->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211205_184012_add_setting_calculators_description cannot be reverted.\n";

        return false;
    }
}
