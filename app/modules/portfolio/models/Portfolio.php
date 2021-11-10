<?php

namespace app\modules\portfolio\models;

use app\modules\admin\behaviors\ImageBehavior;
use app\modules\admin\behaviors\SlugBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\seo\behaviors\SeoBehavior;
use app\modules\seo\valueObjects\Seo;
use DomainException;
use PHPThumb\GD;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * @mixin SeoBehavior
 * @mixin ImageBehavior
 *
 * @property int $id [int(11)]
 * @property string $title [varchar(255)]
 * @property string $alias [varchar(255)]
 * @property int $status [int(11)]
 * @property string $description
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property string $meta_t [varchar(255)]
 * @property string $meta_d [varchar(255)]
 * @property string $meta_k [varchar(255)]
 * @property string $h1 [varchar(255)]
 * @property string $image [varchar(255)]
 * @property string $image_hash [varchar(255)]
 * @property bool $is_preview [tinyint(1)]
 */
class Portfolio extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    /**
     * @var Seo
     */
    private $seo;

    public static function tableName()
    {
        return '{{portfolios}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SlugBehavior::class,
            SeoBehavior::class,
            [
                'class' => ImageBehavior::class,
                'folder' => 'portfolios',
                'thumbs' => [
                    'thumb' => ['processor' => function (GD $thumb) {
                        $thumb->resize(357, 323)->pad(250, 250, [255, 255, 255]);
                    }],
                    'thumb_origin' => ['processor' => function (GD $thumb) {
                        $thumb->resize(1132, 566)->pad(1132, 566, [255, 255, 255]);
                    }]
                ],
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'alias' => 'Алиас',
            'description' => 'Описание в портфолио',
            'status' => 'Статус',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'is_preview' => 'Показывать на главной'
        ];
    }

    public static function create($title, $alias, $description, $is_preview, ?UploadedFile $image, Seo $seo): Portfolio
    {
        $self = new self();

        $self = new Portfolio();
        $self->title = $title;
        $self->alias = $alias;
        $self->is_preview = $is_preview;
        $self->image = $image;
        $self->description = $description;
        $self->status = self::STATUS_DRAFT;
        $self->seo = $seo;

        return $self;
    }

    public function edit($title, $alias, $description, $is_preview, ?UploadedFile $image, Seo $seo): void
    {
        $this->title = $title;
        $this->alias = $alias;
        $this->is_preview = $is_preview;
        $this->description = $description;
        $this->image = $image;
        $this->seo = $seo;
    }

    public function getSeo(): Seo
    {
        return $this->seo;
    }

    public function activate()
    {
        if ($this->status == self::STATUS_ACTIVE) {
            throw new DomainException('Портфолио уже активировано');
        }

        $this->status = Portfolio::STATUS_ACTIVE;
    }

    public function draft()
    {
        if ($this->status == self::STATUS_DRAFT) {
            throw new DomainException('Портфолио уже заблокирвоано');
        }
        $this->status = Portfolio::STATUS_DRAFT;
    }

    public function getHref()
    {
        return Url::to(['/portfolio/frontend/view', 'alias' => $this->alias, 'category' => $this->category->alias]);
    }

    public function beforeSave($insert)
    {
        $this->setAttribute('meta_t', $this->seo->getTitle());
        $this->setAttribute('meta_d', $this->seo->getDescription());
        $this->setAttribute('meta_k', $this->seo->getKeywords());
        $this->setAttribute('h1', $this->seo->getH1());
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->seo = new Seo(
            $this->getAttribute('meta_t'),
            $this->getAttribute('meta_d'),
            $this->getAttribute('meta_k'),
            $this->getAttribute('h1')
        );
        parent::afterFind();
    }

    public function getImageSrc()
    {
        return $this->hasImage() ? $this->getUploadedFileUrl('image') : '';
    }

    public function getThumbSrc()
    {
        return $this->hasImage() ? $this->getThumbFileUrl('image') : null;
    }

    public function show()
    {
        if ($this->is_preview == true) {
            throw new DomainException('Портфолио уже покаызвается на главной странице');
        }

        $this->is_preview = true;
    }

    public function hide()
    {
        if ($this->is_preview == false) {
            throw new DomainException('Портфолио уже не покаызвается на главной странице');
        }
        $this->is_preview = false;
    }
}
