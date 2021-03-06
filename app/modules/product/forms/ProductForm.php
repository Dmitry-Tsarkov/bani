<?php

namespace app\modules\product\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\admin\helpers\NestedSetsHelper;
use app\modules\category\models\Category;
use app\modules\product\models\Product;
use app\modules\seo\forms\SeoForm;

/**
 * @property SeoForm $seo
 * @property ImagesForm $images
 * @property KitEditForm $kits
 */
class ProductForm extends CompositeForm
{
    public $id;
    public $categoryId;
    public $title;
    public $alias;
    public $description;
    public $bottom_description;
    public $image;
    public $price;
    public $price_type;
    public $unit;
    public $preview_description;

    /**
     * @var Product|null
     */
    private $product;

    public function __construct(?Product $product = null)
    {
        if (!empty($product)) {
            $this->categoryId = $product->category_id;
            $this->title = $product->title;
            $this->alias = $product->alias;
            $this->description = $product->description;
            $this->bottom_description = $product->bottom_description;
            $this->price = $product->price;
            $this->price_type = $product->price_type;
            $this->unit = $product->unit;
            $this->preview_description = $product->preview_description;
        }

//        $this->kits = new KitEditForm($product ? $product : null);
        $this->seo = new SeoForm($product ? $product->seo : null);

        parent::__construct();
    }

    protected function internalForms(): array
    {
        return ['seo', 'images'];
    }

    public function rules()
    {
        return [
            [['title', 'categoryId', 'unit', 'price'], 'required'],
            [['title', 'description', 'bottom_description', 'alias', 'preview_description', 'unit'], 'string'],
            [['id', 'categoryId', 'price_type'], 'integer'],
            [['price'], 'double'],
            ['image', 'image', 'extensions' => ['png', 'jpg', 'jpeg'], 'checkExtensionByMimeType' => false],
        ];
    }

    public function attributeLabels()
    {
        return ([
            'description' => '???????????????? ????????????',
            'bottom_description' => '???????????????? ???????????? ??????????',
            'title' => '??????????????????',
            'alias' => '??????????',
            'categoryId' => '????????????????????????',
            'created_at' => '???????? ????????????????',
            'updated_at' => '???????? ????????????????????',
            'price' => '????????',
            'price_type' => '?????? ????????',
            'preview_description' => '???????????? ????????????????',
            'unit' => '?????????????? ??????????????????',
        ]);
    }

    public function getCategoriesDropDown()
    {
        $rows = Category::find()
            ->select(['title', 'depth', 'id'])
            ->orderBy('lft')
            ->indexBy('id')
            ->andWhere(['>', 'depth', 0])
            ->asArray()
            ->all();

        return array_map(function ($row) {
            return NestedSetsHelper::depthTitle($row['title'], $row['depth']);
        }, $rows);
    }

    public function getCategoriesDropDownOptions()
    {
        $ids = Category::find()
            ->select('id')
            ->indexBy('id')
            ->andWhere(['>', 'depth', 0])
            ->andWhere("NOT(`rgt` - `lft` = 1)")
            ->column();

        return array_map(function ($id) {
            return ['disabled' => true];
        }, $ids);
    }
}