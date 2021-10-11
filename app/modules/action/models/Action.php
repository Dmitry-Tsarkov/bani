<?php

namespace app\modules\action\models;

use app\modules\admin\behaviors\ImageBehavior;
use app\modules\admin\behaviors\SlugBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\seo\behaviors\SeoBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii2tech\ar\position\PositionBehavior;

/**
 * @mixin PositionBehavior
 * @mixin ImageBehavior
 * @mixin SlugBehavior
 * @mixin SeoBehavior
 *
 * @property int $id [int(11)]
 * @property int $position [int(11)]
 * @property int $status [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property int $active_from [int(11)]
 * @property int $active_to [int(11)]
 * @property string $image [varchar(255)]
 * @property string $image_hash [varchar(255)]
 * @property string $title [varchar(255)]
 * @property string $preview_description [varchar(255)]
 * @property string $preview_title [varchar(255)]
 * @property string $description [varchar(255)]
 * @property string $alias [varchar(255)]
 * @property string $activity_period [varchar(255)]
 * @property string $meta_t [varchar(255)]
 * @property string $meta_d [varchar(255)]
 * @property string $meta_k [varchar(255)]
 * @property string $h1 [varchar(255)]
 */
class Action extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
        return 'actions';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SeoBehavior::class,
            PositionBehavior::class,
            SlugBehavior::class,
            [
                'class' => ImageBehavior::class,
                'folder' => 'actions',
                'thumbs' => [
                    'thumb' => ['width' => 499, 'height' => 231],
                ],
            ],
        ];
    }

    public static function create($preview_description, $preview_title, $title, $description, $active_from, $active_to, $activity_period, UploadedFile $image)
    {
        $self = new self();
        $self->preview_title = $preview_title;
        $self->preview_description = $preview_description;
        $self->title = $title;
        $self->description = $description;
        $self->image = $image;
        $self->active_from = $active_from;
        $self->active_to = $active_to;
        $self->activity_period = $activity_period;
        $self->status = self::STATUS_ACTIVE;

        return $self;
    }

    public function getThumbSrc()
    {
        return $this->hasImage() ? $this->getThumbFileUrl('image') : null;
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            ['status', 'integer'],
            [['title', 'description', 'activity_period', 'preview_description', 'preview_title'], 'string'],
            [['active_from'], 'date', 'format' => 'php:d.m.Y H:i', 'timestampAttribute' => 'active_from'],
            [['active_to'], 'date', 'format' => 'php:d.m.Y H:i', 'timestampAttribute' => 'active_to'],
            ['image', 'image', 'extensions' => ['png', 'jpeg', 'jpg']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'status' => 'Статус',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'image' => 'Картинка',
            'alias' => 'Алиас',
            'active_from' => 'Начало активности',
            'active_to' => 'Окончаие активности',
            'activity_period' => 'Период действия скидки/акции',
            'preview_title' => 'Превью заголовок',
            'preview_description' => 'Превью подзаголовок'
        ];
    }

    public function getImageSrc()
    {
        return $this->hasImage() ? Url::to($this->getUploadedFileUrl('image'), true) : '';
    }

    public static function find(): ActionQuery
    {
        return new ActionQuery(self::class);
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE && $this->isInActivityPeriod();
    }

    public function isInActivityPeriod()
    {
        return $this->isRelevantActiveFrom() && $this->isRelevantActiveTo();
    }

    public function isRelevantActiveFrom()
    {
        return $this->active_from < time() || $this->active_from == null;
    }

    public function isRelevantActiveTo()
    {
        return $this->active_to > time() || $this->active_to == null;
    }
}