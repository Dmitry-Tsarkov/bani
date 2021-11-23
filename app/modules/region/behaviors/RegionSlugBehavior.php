<?php

namespace app\modules\region\behaviors;

use app\modules\admin\behaviors\SlugBehavior;
use dosamigos\transliterator\TransliteratorHelper;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;

class RegionSlugBehavior extends SlugBehavior
{
    public $in_attribute_for_region = 'district';
    public $out_attribute_for_region = 'district_alias';
    public $in_attribute = 'city';
    public $out_attribute = 'city_alias';
    public $translit = true;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'getSlug'
        ];
    }

    public function getSlug($event)
    {
        if (empty($this->owner->{$this->out_attribute}) && empty($this->owner->{$this->out_attribute_for_region})) {
            $this->owner->{$this->out_attribute} = $this->generateSlug($this->owner->{$this->in_attribute});
            $this->owner->{$this->out_attribute_for_region} = $this->generateSlug($this->owner->{$this->in_attribute_for_region});
        } else {
            $this->owner->{$this->out_attribute} = $this->generateSlug($this->owner->{$this->out_attribute});
            $this->owner->{$this->out_attribute_for_region} = $this->generateSlug($this->owner->{$this->out_attribute_for_region});
        }
    }

    private function generateSlug($slug)
    {
        $slug = $this->slugify($slug);
        if ($this->checkUniqueSlug($slug)) {
            return $slug;
        } else {
            for ($suffix = 2; !$this->checkUniqueSlug($new_slug = $slug . '-' . $suffix); $suffix++) {
            }
            return $new_slug;
        }
    }

    private function slugify($slug)
    {
        if ($this->translit) {
            return Inflector::slug(TransliteratorHelper::process($slug, '', 'en'), '-', true);
        } else {
            return $this->slug($slug, '-', true);
        }
    }

    private function slug($string, $replacement = '-', $lowercase = true)
    {
        $string = preg_replace('/[^\p{L}\p{Nd}]+/u', $replacement, $string);
        $string = trim($string, $replacement);
        return $lowercase ? strtolower($string) : $string;
    }

    private function checkUniqueSlug($slug)
    {
        $pk = $this->owner->primaryKey();
        $pk = $pk[0];

        $condition = $this->out_attribute . ' = :out_attribute';
        $params = [':out_attribute' => $slug];
        if (!$this->owner->isNewRecord) {
            $condition .= ' and ' . $pk . ' != :pk';
            $params[':pk'] = $this->owner->{$pk};
        }

        return !$this->owner->find()
            ->where($condition, $params)
            ->one();
    }
}