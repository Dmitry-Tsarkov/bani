<?php

use yii\db\Migration;

/**
 * Class m211110_152516_fill_settings
 */
class m211110_152516_fill_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->getDb()->createCommand(
            "INSERT INTO `setting` (`id`, `type`, `value`, `title`, `hash`, `description`, `hint`, `position`) VALUES
                ('about', 'string', NULL, 'О компании', NULL, '', '', 1),
                ('about_image', 'file', NULL, 'Картинка (О компании)', NULL, '', '', 2),
                ('advantages', 'string', NULL, 'Примеущества', NULL, '', '', 3);"
        )->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211110_152516_fill_settings cannot be reverted.\n";

        return false;
    }
}
