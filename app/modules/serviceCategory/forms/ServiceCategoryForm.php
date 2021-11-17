<?php

namespace app\modules\serviceCategory\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\serviceCategory\models\ServiceCategory;
use app\modules\seo\forms\SeoForm;
use yii\web\UploadedFile;

/**
 * @property SeoForm $seo
 */
class ServiceCategoryForm extends CompositeForm
{
    public $title;
    public $description;
    public $alias;
    public $parentId;
    public $image;
    private $category;

    public function __construct(?ServiceCategory $category = null)
    {
        if (!empty($category)) {
            $this->title = $category->title;
            $this->description = $category->description;
            $this->alias = $category->alias;
            $this->parentId = $category->parent_id;

            $this->category = $category;
        }

        $this->seo = new SeoForm($category->seo ?? null);

        parent::__construct();
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'image' => 'Картинка',
            'parentId' => 'Подкатегория',
            'alias' => 'Алиас',
            'meta_t' => 'Заголовок страницы',
            'meta_d' => 'Описание страницы',
            'meta_k' => 'Ключевые слова',
        ];
    }

    public function rules()
    {
        return [
            [['title', 'alias', 'parentId'], 'required'],
            [['title', 'alias', 'description'], 'string', 'max' => 255],
            [['parentId'], 'integer'],
            [['alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/', 'message' => 'Только латинские буквы и знак "-"'],
        ];
    }

    public function canMove()
    {
        if (empty($this->category)) {
            return true;
        }

        if ($this->category->depth == 1) {
            return $this->category->isLeaf();
        }

        return true;
    }

    public function getCategoriesDropDown()
    {
        if (!$this->canMove()) {
            return [];
        }

        if (empty($this->category)) {
            return ServiceCategory::find()
                ->andWhere(['depth' => [0, 1]])
                ->orderBy('lft')
                ->select('title')
                ->indexBy('id')
                ->column();
        }

        if ($this->category->depth == 2) {
            return ServiceCategory::find()
                ->andWhere(['depth' => 1])
                ->orderBy('lft')
                ->select('title')
                ->indexBy('id')
                ->column();
        }

        return ServiceCategory::find()
            ->andWhere(['depth' => [0, 1]])
            ->orderBy('lft')
            ->select('title')
            ->indexBy('id')
            ->column();
    }

    public function getCategoriesDisabledDropDown()
    {
        $result = [];
        $result['options'][$this->category->id]['disabled'] = true;

        return $result;
    }

    protected function internalForms(): array
    {
        return ['seo'];
    }

    public function beforeValidate(): bool
    {
        $this->image = UploadedFile::getInstance($this, 'image');
        return parent::beforeValidate();
    }

}