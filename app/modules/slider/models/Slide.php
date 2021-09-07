<?php

namespace app\modules\slider\models;

use app\modules\admin\behaviors\ImageBehavior;
use app\modules\admin\traits\QueryExceptions;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii2tech\ar\position\PositionBehavior;

/**
 * @mixin ImageBehavior
 * @mixin PositionBehavior
 *
 * @property int $id [int(11)]
 * @property int $status [int(11)]
 * @property int $position [int(11)]
 * @property string $title [varchar(255)]
 * @property string $description [varchar(255)]
 * @property string $image [varchar(255)]
 * @property string $image_hash [varchar(255)]
 *
 */
class Slide extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public function behaviors()
    {
        return [
            PositionBehavior::class,
            TimestampBehavior::class,
            'image' => [
                'class' => ImageBehavior::class,
                'attribute' => 'image',
                'thumbs' => [
                    'thumb' => ['width' => 50, 'height' => 50],
                    'preview' => ['width' => 370, 'height' => 370],
                    'view' => ['width' => 1170, 'height' => 400],
                ],
                'folder' => 'slider'
            ],
        ];
    }

    public static function create($title, $description, $status, ?UploadedFile $image): self
    {
        $self = new self();

        $self->title = $title;
        $self->description = $description;
        $self->status = $status;
        $self->image = $image;

        return $self;
    }

    public static function tableName()
    {
        return 'slides';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status'], 'boolean'],
            ['image', 'image', 'extensions' => 'jpeg, png, jpg'],
            [['description'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'status' => 'Активность',
            'image' => 'Картинка',
        ];
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }
}
