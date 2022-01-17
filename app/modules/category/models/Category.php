<?php

namespace app\modules\category\models;

use app\modules\admin\behaviors\ImageBehavior;
use app\modules\admin\behaviors\SlugBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\product\models\Product;
use app\modules\seo\behaviors\SeoBehavior;
use app\modules\seo\valueObjects\Seo;
use creocoder\nestedsets\NestedSetsBehavior;
use PHPThumb\GD;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @mixin NestedSetsBehavior
 * @mixin SeoBehavior
 * @mixin ImageBehavior
 *
 * @property Product[] $products
 *
 * @property int $id [int(11)]
 * @property int $parent_id [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property int $lft [int(11)]
 * @property int $rgt [int(11)]
 * @property int $depth [int(11)]
 * @property string $title [varchar(255)]
 * @property string $alias [varchar(255)]
 * @property string $meta_t [varchar(255)]
 * @property string $meta_d [varchar(255)]
 * @property string $meta_k [varchar(255)]
 * @property string $h1 [varchar(255)]
 * @property string $description [varchar(255)]
 * @property string $image [varchar(255)]
 * @property string $image_hash [varchar(255)]
 * @property string $bottom_description [varchar(255)]
 * @property bool $status [tinyint(1)]
 *
 */

class Category extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @var Seo
     */
    public $seo;

    public static function tableName()
    {
        return 'categories';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            NestedSetsBehavior::class,
            SlugBehavior::class,
            SeoBehavior::class,
            [
                'class' => ImageBehavior::class,
                'folder' => 'services',
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

    public static function create(
        $parentId,
        $title,
        $description,
        $bottom_description,
        $alias,
        ?UploadedFile $image,
        ?Seo $seo = null
    ): self
    {
        $self = new self();
        $self->title = $title;
        $self->status = self::STATUS_ACTIVE;
        $self->image = $image;
        $self->alias = $alias;
        $self->description = $description;
        $self->bottom_description = $bottom_description;
        $self->parent_id = $parentId;
        $self->seo = $seo ?? Seo::blank();

        return $self;
    }

    public function edit(
        $parentId,
        $title,
        $status,
        $description,
        $bottom_description,
        $alias,
        ?UploadedFile $image,
        ?Seo $seo = null
    ): void
    {
        $this->parent_id = $parentId;
        $this->title = $title;
        $this->status = $status;
        $this->description = $description;
        $this->bottom_description = $bottom_description;
        $this->alias = $alias;
        $this->image = $image;

        $this->seo = $seo ?? Seo::blank();
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

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateAttributes(['parent_id' => $this->parents(1)->one()->id]);
        parent::afterSave($insert, $changedAttributes);
    }

    public function getParent()
    {
        return $this->hasOne(Category::class, ['id' => 'parent_id']);
    }

    public function getProducts()
    {
        return  $this->hasMany(Product::class, ['category_id' => 'id']);
    }

    public function getImageSrc()
    {
        return $this->hasImage() ? $this->getUploadedFileUrl('image') : '';
    }
}