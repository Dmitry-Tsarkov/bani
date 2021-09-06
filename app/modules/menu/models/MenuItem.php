<?php

namespace app\modules\menu\models;

use app\modules\admin\traits\QueryExceptions;
use app\modules\menu\enums\StatusEnum;
use yii\db\ActiveRecord;
use yii2tech\ar\position\PositionBehavior;

/**
 * @property int $id [int(11)]
 * @property int $position [int(11)]
 * @property int $status [int(11)]
 * @property string $text [varchar(255)]
 * @property string $link [varchar(255)]
 *
 * @mixin PositionBehavior
 */
class MenuItem extends ActiveRecord
{
    use QueryExceptions;

    public static function tableName()
    {
        return 'menu_items';
    }

    public function attributeLabels()
    {
        return [
            'status' => 'Статус',
            'text' => 'Текст заголовка',
            'link' => 'Ссылка на страницу',
        ];
    }

    public function rules()
    {
        return [
            [['text', 'link', 'status'], 'required'],
            ['status', 'in', 'range' => array_keys(StatusEnum::list())],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => PositionBehavior::class,
            ],
        ];
    }
}