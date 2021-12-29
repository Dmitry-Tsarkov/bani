<?php

use yii\db\Migration;

/**
 * Class m211229_121959_fill_settings
 */
class m211229_121959_fill_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->getDb()->createCommand(
            "INSERT INTO `setting` (`id`, `type`, `value`, `title`, `hash`, `description`, `hint`, `position`) VALUES
                ('catalog_text', 'text', '', 'Текст каталога', NULL, '', '', 23);"
        )->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211229_121959_fill_settings cannot be reverted.\n";

        return false;
    }
}
