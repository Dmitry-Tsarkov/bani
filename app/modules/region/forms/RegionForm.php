<?php

namespace app\modules\region\forms;

use app\modules\admin\forms\CompositeForm;
use app\modules\region\models\Region;
use app\modules\seo\forms\SeoForm;

/**
 * @property SeoForm $seo
 */
class RegionForm extends CompositeForm
{
    public $title;
    public $title_alias;
    public $district;
    public $district_alias;
    public $description;
    public $status;

    /**
     * @var Region|null
     */
    private $region;

    public function __construct(?Region $region = null)
    {
        if  (!empty($region)) {
            $this->title = $region->title;
            $this->title_alias = $region->title_alias;
            $this->district = $region->district;
            $this->district_alias = $region->district_alias;
            $this->description = $region->description;
            $this->status = $region->status;
        }

        $this->seo = new SeoForm($region ? $region->seo : null);

        parent::__construct();
    }

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title_alias', 'district_alias', 'description'], 'string'],
            [['status'], 'integer'],
            [['title_alias', 'district_alias'], 'match', 'pattern' => '/^[0-9a-z-]+$/','message'=>'Только латинские буквы и знак "-"'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Город',
            'title_alias' => 'Алиас города',
            'district' => 'Регион',
            'district_alias' => 'Алиас региона',
            'description' => 'Контент',
            'status' => 'Статус',
        ];
    }

    protected function internalForms(): array
    {
        return ['seo'];
    }
}