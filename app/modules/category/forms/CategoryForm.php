<?php

namespace app\modules\category\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\category\models\Category;
use app\modules\seo\forms\SeoForm;
use yii\web\UploadedFile;

/**
 * @property SeoForm $seo
 */
class CategoryForm extends CompositeForm
{
    public $status;
    public $title;
    public $description;
    public $bottom_description;
    public $alias;
    public $parentId;
    public $image;
    private $category;

    public function __construct(?Category $category = null)
    {
        if (!empty($category)) {
            $this->status = $category->status;
            $this->title = $category->title;
            $this->description = $category->description;
            $this->bottom_description = $category->bottom_description;
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
            'status' => 'Статус',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'bottom_description' => 'Описание снизу',
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
            [['title', 'alias'], 'required'],
            [['description', 'bottom_description'], 'string'],
            [['title', 'alias'], 'string', 'max' => 255],
            [['parentId'], 'integer'],
            [['status'], 'boolean'],
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
            return Category::find()
                ->andWhere(['depth' => [0, 1]])
                ->orderBy('lft')
                ->select('title')
                ->indexBy('id')
                ->column();
        }

        if ($this->category->depth == 2) {
            return Category::find()
                ->andWhere(['depth' => 1])
                ->orderBy('lft')
                ->select('title')
                ->indexBy('id')
                ->column();
        }

        return Category::find()
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