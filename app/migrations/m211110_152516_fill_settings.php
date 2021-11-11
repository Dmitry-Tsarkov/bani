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
                ('phone', 'text', '+7 (958) 111-02-43', 'Телефон(ы)', NULL, '', 'Каждый номер с новой строчки', 4),
                ('email', 'text', NULL, 'E-mail', NULL, '', 'Каждый e-mail с новой строчки', 5),
                ('skype', 'text', NULL, 'Skype', NULL, '', 'Каждый аккаунт с новой строчки', 6),
                ('viber', 'text', NULL, 'Viber', NULL, '', 'Каждый номер с новой строчки', 7),
                ('whatsapp', 'text', NULL, 'WhatsApp', NULL, '', 'Каждый номер с новой строчки', 8),
                ('map', 'map', NULL, 'Месторасположение', NULL, '', '', 9),
                ('facebook', 'string', NULL, 'Facebook', NULL, '', '', 10),
                ('telegram', 'string', NULL, 'Telegram', NULL, '', '', 11),
                ('instagram', 'string', NULL, 'Instagram', NULL, '', '', 12),
                ('company_name', 'string', '«Срубимбаню»', 'Назвыние компании', NULL, '', '', 14),
                ('operator_working_hours', 'text', 'Телефоны доступны для связи ежедневно с 8:00 до 22:00. Если номер находится вне зоны действия сети - оставьте нам сообщение и мы свяжемся с вами в ближайшее время.', 'Режим работы оператора', NULL, '', '', 15),
                ('office_working_hours', 'text', 'ПН - ПТ, с 10:00 до 20:00 по предварительной договоренности, т.к. менеджер может находиться на выезде', 'Режим работы офисов', NULL, '', '', 16),
                ('denomination', 'text', 'Общество с ограниченной ответственностью \"ПРОГРЕСС 2009\"', 'Наименование', NULL, '', '', 17),
                ('tin', 'string', 6701005784, 'ИНН', NULL, '', '', 18),
                ('checkpoint', 'string', 670101001, 'КПП', NULL, '', '', 19),
                ('psrn', 'string', 1096713000273, 'ОГРН', NULL, '', '', 20),
                ('rcbo', 'string', 72858987, 'ОКПО', NULL, '', '', 21),
                ('legal_address', 'text', '216291, Смоленская область, Велижский район, гор. Велиж, улица Куриленко, д. 11-А', 'Юридический адрес', NULL, '', '', 22),
                ('office_address', 'text', '119027, г. Москва, Киевское шоссе, строение 2, корп. «Г», каб. № 308-Г (БП «Румянцево»), 197348, г. Санкт-Петербург, Коломяжский проспект, д. 10-Д, 3-й этаж', 'Адрес офиса', NULL, '', '', 22);"
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
