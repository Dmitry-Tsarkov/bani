<?php

namespace app\modules\product\models;

use app\modules\admin\behaviors\SlugBehavior;
use app\modules\admin\traits\QueryExceptions;
use app\modules\category\models\Category;
use app\modules\characteristic\models\Value;
use app\modules\kit\models\Kit;
use app\modules\seo\behaviors\SeoBehavior;
use app\modules\seo\valueObjects\Seo;
use DomainException;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii2tech\ar\linkmany\LinkManyBehavior;
use yii2tech\ar\position\PositionBehavior;

/**
 * @property array $kitIds
 *
 * @mixin SeoBehavior
 * @mixin SlugBehavior
 * @mixin PositionBehavior
 *
 * @property ProductImage $mainImage
 * @property ProductImage[] $images
 * @property Category $category
 * @property Value[] $values
 * @property Kit[] $kits
 * @property Addition[] $additions
 *
 * @property int $id [int(11)]
 * @property int $category_id [int(11)]
 * @property int $image_id [int(11)]
 * @property int $position [int(11)]
 * @property int $status [int(11)]
 * @property int $created_at [int(11)]
 * @property int $updated_at [int(11)]
 * @property int $price_type [int(11)]
 * @property string $price [decimal(10)]
 * @property string $title [varchar(255)]
 * @property string $alias [varchar(255)]
 * @property string $description
 * @property string $bottom_description
 * @property string $meta_t [varchar(255)]
 * @property string $meta_d [varchar(255)]
 * @property string $meta_k [varchar(255)]
 * @property string $h1 [varchar(255)]
 */

class Product extends ActiveRecord
{
    use QueryExceptions;

    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    const TYPE_STATIC = 0;
    const TYPE_RANGE = 1;

    /**
     * @var Seo
     */
    public $seo;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            SlugBehavior::class,
            SeoBehavior::class,
            [
                'class' => PositionBehavior::class,
                'groupAttributes' => ['category_id']
            ],
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['images', 'values'],
            ],
            [
                'class' => LinkManyBehavior::class,
                'relation' => 'kits',
                'relationReferenceAttribute' => 'kitIds',
            ],
        ];
    }

    public static function tableName()
    {
        return 'products';
    }

    public static function create($category_id, $title, $price_type, $price, $description, $bottom_description, ?Seo $seo = null): self
    {
        $self = new self();

        $self->category_id = $category_id;
        $self->price_type = $price_type;
        $self->price = $price;
        $self->status = self::STATUS_ACTIVE;
        $self->title = $title;
        $self->description = $description;
        $self->bottom_description = $bottom_description;

        $self->seo = $seo ?? Seo::blank();

        return $self;
    }

    public function edit($category_id, $price_type, $price, $title, $description, $bottom_description, ?Seo $seo = null): void
    {
        $this->category_id = $category_id;
        $this->price_type = $price_type;
        $this->price = $price;
        $this->title = $title;
        $this->description = $description;
        $this->bottom_description = $bottom_description;
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

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getMainImage()
    {
        return $this->hasOne(ProductImage::class, ['id' => 'image_id']);
    }

    public function getAdditions()
    {
        return $this->hasMany(Addition::class, ['product_id' => 'id'])->orderBy('position');
    }

    public function getImages()
    {
        return $this->hasMany(ProductImage::class, ['product_id' => 'id'])->orderBy('position');
    }

    public function getKits()
    {
        return $this->hasMany(Kit::class, ['id' => 'kit_id'])
            ->viaTable('products_kits', ['product_id' => 'id']);
    }

    public function getValues()
    {
        return $this->hasMany(Value::class, ['product_id' => 'id']);
    }

    public function updateKits($kitIds)
    {
        $this->kitIds = $kitIds;
    }

    public function activate(): void
    {
        if ($this->isActive()) {
            throw new DomainException('Товар уже активный');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function deactivate(): void
    {
        if (!$this->isActive()) {
            throw new DomainException('Товар уже неактивный');
        }
        $this->status = self::STATUS_DRAFT;
    }

    public function addImage(ProductImage $image)
    {
        $images = $this->images;
        $images[] = $image;
        $this->updateImages($images);
    }

    private function updateImages(array $images)
    {
        foreach ($images as $i => $image) {
            $image->setPosition($i + 1);
        }
        $this->images = $images;
        $this->populateRelation('mainImage', reset($images));
    }

    public function sortImages(int $oldIndex, int $newIndex)
    {
        $images = $this->images;
        $tmp = $images[$oldIndex];
        array_splice($images, $oldIndex, 1);
        array_splice($images, $newIndex, 0, [$tmp]);
        $this->updateImages($images);
    }

    public function deleteImage($photoId)
    {
        $images = $this->images;
        foreach ($images as $i => $image) {
            if ($image->id == $photoId) {
                unset($images[$i]);
                $this->updateImages($images);
                return;
            }
        }
        throw new DomainException('Картинка не найдена');
    }

    public function findValueByCharacteristic($characteristicId): ?Value
    {
        $values = $this->values;
        foreach ($values as $value) {
            if ($value->characteristic_id == $characteristicId) {
                return $value;
            }
        }
        return null;
    }

    public function removeValue($valueId)
    {
        $values = $this->values;
        foreach ($values as $i => $value) {
            if ($value->id == $valueId) {
                unset($values[$i]);
                $this->values = $values;
                return;
            }
        }
        throw new DomainException('Значение не найдено');
    }

    public function setValue(Value $value)
    {
        $values = $this->values;
        foreach ($values as $i => $current) {
            if ($current->characteristic_id == $value->characteristic_id) {
                $values[$i] = $value;
                $this->values = $values;
                return;
            }
        }
        $values[] = $value;
        $this->values = $values;
    }

    public function getPriceType()
    {
        return $this->price_type == self::TYPE_RANGE ? 'от' : '';
    }

    public function getFirstImage()
    {
        $images = $this->images;

        return !empty($images) ? Url::to($images[0]->getImageFileUrl('image'), true) : null;
    }
}