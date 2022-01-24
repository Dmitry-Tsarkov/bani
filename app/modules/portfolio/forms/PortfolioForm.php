<?php

namespace app\modules\portfolio\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\portfolio\models\Portfolio;
use app\modules\seo\forms\SeoForm;
use yii\web\UploadedFile;

/**
 * @property SeoForm $seo
 */
class PortfolioForm extends CompositeForm
{
    public $title;
    public $alias;
    public $description;
    public $image;
    public $is_preview;
    public $preview_text;

    public function __construct(?Portfolio $portfolio = null)
    {
        if  (!empty($portfolio)) {
            $this->title = $portfolio->title;
            $this->alias = $portfolio->alias;
            $this->is_preview = $portfolio->is_preview;
            $this->description = $portfolio->description;
            $this->preview_text = $portfolio->preview_text;
        }

        $this->seo = new SeoForm();
        parent::__construct();
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'alias', 'description', 'preview_text'], 'string'],
            [['is_preview'], 'boolean'],
            [['alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/','message'=>'Только латинские буквы и знак "-"'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'alias' => 'Алиас',
            'description' => 'Описание',
            'image' => 'Картинка',
            'is_preview' => 'Показывать на главной',
            'preview_text' => 'Превью текст',
        ];
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
