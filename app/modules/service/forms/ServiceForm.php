<?php

namespace app\modules\service\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\service\models\Service;
use app\modules\seo\forms\SeoForm;

/**
 * @property SeoForm $seo
 * @property ServiceImagesForm $images
 */
class ServiceForm extends CompositeForm
{
    public $id;
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
            [['title'], 'required'],
            [['title', 'description', 'alias'], 'string'],
            [['id', 'price_type'], 'integer'],
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
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'price' => 'Цена',
            'price_type' => 'Тип цены',
        ]);
    }
}