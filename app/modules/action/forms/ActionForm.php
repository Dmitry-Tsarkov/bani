<?php

namespace app\modules\action\forms;

use app\modules\action\models\Action;
use app\modules\admin\forms\CompositeForm;
use app\modules\seo\forms\SeoForm;

/**
 * @property SeoForm $seo
 */
class ActionForm extends CompositeForm
{
    public $id;
    public $alias;
    public $title;
    public $description;
    public $preview_title;
    public $preview_description;
    public $image;
    public $activity_period;
    public $active_from;
    public $active_to;
    public $status;

    /**
     * @var Action|null
     */
    private $action;

    public function __construct(?Action $action = null)
    {
        if (!empty($action)) {
            $this->alias = $action->alias;
            $this->title = $action->title;
            $this->preview_title = $action->preview_title;
            $this->description = $action->description;
            $this->preview_title = $action->preview_title;
            $this->preview_description = $action->preview_description;
            $this->activity_period = $action->activity_period;
            $this->activity_period = $action->activity_period;
            $this->activity_period = $action->activity_period;
            $this->active_from = $action->active_from;
            $this->active_to = $action->active_to;
            $this->status = $action->status;
        }

        $this->seo = new SeoForm($action ? $action->seo : null);

        parent::__construct();
    }

    protected function internalForms(): array
    {
        return ['seo'];
    }

    public function rules()
    {
        return[
            [['title'], 'required'],
            [['alias', 'title', 'description', 'preview_title', 'preview_description'], 'string'],
            [['id'], 'integer'],
            ['image', 'image', 'extensions' => ['png', 'jpg', 'jpeg'], 'checkExtensionByMimeType' => false],
            [['activity_period', 'active_from', 'active_to'], 'safe']
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
}