<?php

namespace app\modules\service\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\admin\helpers\NestedSetsHelper;
use app\modules\service\models\Service;
use app\modules\seo\forms\SeoForm;
use app\modules\serviceCategory\models\ServiceCategory;

/**
 * @property SeoForm $seo
 * @property ServiceImagesForm $images
 */
class ServiceForm extends CompositeForm
{
    public $id;
    public $categoryId;
    public $title;
    public $alias;
    public $description;
    public $image;
    public $price;
    public $price_type;

    /**
     * @var Service|null
     */
    private $service;

    public function __construct(?Service $service = null)
    {
        if (!empty($service)) {
            $this->categoryId = $service->category_id;
            $this->title = $service->title;
            $this->alias = $service->alias;
            $this->description = $service->description;
            $this->price = $service->price;
            $this->price_type = $service->price_type;
        }

        $this->seo = new SeoForm($service ? $service->seo : null);

        parent::__construct();
    }

    protected function internalForms(): array
    {
        return ['seo', 'images'];
    }

    public function rules()
    {
        return[
            [['title', 'categoryId'], 'required'],
            [['title', 'description', 'alias'], 'string'],
            [['id', 'categoryId', 'price_type'], 'integer'],
            [['price'], 'double'],
            ['image', 'image', 'extensions' => ['png', 'jpg', 'jpeg'], 'checkExtensionByMimeType' => false],
        ];
    }

    public function attributeLabels()
    {
        return([
            'description' => 'Описание услуги',
            'title' => 'Заголовок',
            'alias' => 'Алиас',
            'categoryId' => 'Подкатегория',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'price' => 'Цена',
            'price_type' => 'Тип цены',
        ]);
    }

    public function getCategoriesDropDown()
    {
        $rows = ServiceCategory::find()
            ->select(['title', 'depth', 'id'])
            ->orderBy('lft')
            ->indexBy('id')
            ->andWhere(['>', 'depth', 0])
            ->asArray()
            ->all();

        return array_map(function($row) {
            return NestedSetsHelper::depthTitle($row['title'], $row['depth']);
        }, $rows);
    }

    public function getCategoriesDropDownOptions()
    {
        $ids = ServiceCategory::find()
            ->select('id')
            ->indexBy('id')
            ->andWhere(['>', 'depth', 0])
            ->andWhere("NOT(`rgt` - `lft` = 1)")
            ->column();

        return array_map(function($id) {
            return ['disabled' => true];
        }, $ids);
    }
}