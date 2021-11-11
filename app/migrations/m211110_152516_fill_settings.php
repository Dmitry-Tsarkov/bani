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
                ('advantages', 'string', NULL, 'Примеущества', NULL, '', '', 3),
                ('phone', 'text', NULL, 'Телефон(ы)', NULL, '', 'Каждый номер с новой строчки', 4),
                ('email', 'text', NULL, 'E-mail', NULL, '', 'Каждый e-mail с новой строчки', 5),
                ('skype', 'text', NULL, 'Skype', NULL, '', 'Каждый аккаунт с новой строчки', 6),
                ('viber', 'text', NULL, 'Viber', NULL, '', 'Каждый номер с новой строчки', 7),
                ('whatsapp', 'text', NULL, 'WhatsApp', NULL, '', 'Каждый номер с новой строчки', 8),
                ('map', 'map', NULL, 'Месторасположение', NULL, '', '', 9),
                ('facebook', 'string', NULL, 'Facebook', NULL, '', '', 10),
                ('telegram', 'string', NULL, 'Telegram', NULL, '', '', 11),
                ('instagram', 'string', NULL, 'Instagram', NULL, '', '', 12);"
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
